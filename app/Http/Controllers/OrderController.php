<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Mail\OrderClosedMail;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
// PDF creator
use PDF;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{

    public function indexPrivate(Request $request): View
    {
        $this->authorize('viewPrivate', Order::class);

        $userId = Auth::id();
        $filterByStatus = $request->status ?? '';
        $orderQuery = DB::table('orders')->where('customer_id', $userId);
        $allOrderStatus = array_column(OrderStatus::cases(), 'value');

        if ($filterByStatus !== '') {
            $orderQuery->where('status', strtolower($filterByStatus));
        }
        $orders = $orderQuery->orderBy('date', 'desc')->paginate(10);

        return view('privateOrder.index')
            ->with('allOrderStatus', $allOrderStatus)
            ->with('filterByStatus', $filterByStatus)
            ->with('orders', $orders);
    }

    public function indexAdmin(Request $request)
    {
        $this->authorize('viewAdminAndEmployee', Order::class);

        $filterByStatus = $request->status ?? '';
        $filterByCustomer = $request->customerId ?? '';
        $orderQuery = DB::table('orders');
        $allOrderStatus = array_column(OrderStatus::cases(), 'value');
        $allCustomersIdWithOrders = Order::distinct()->pluck('customer_id');

        $allCustomersWithOrders = DB::table('customers')
            ->join('users', 'customers.id', '=', 'users.id')
            ->whereIn('customers.id', $allCustomersIdWithOrders)
            ->get();

        if ($filterByStatus !== '') {
            $orderQuery->where('status', strtolower($filterByStatus));
        }
        if ($filterByCustomer !== '') {
            $orderQuery->where('customer_id', $filterByCustomer);
        }
        $orders = $orderQuery->paginate(10);

        return view('orders.admin')
            ->with('allOrderStatus', $allOrderStatus)
            ->with('allCustomersWithOrders', $allCustomersWithOrders)
            ->with('filterByStatus', $filterByStatus)
            ->with('filterByCustomer', $filterByCustomer)
            ->with('orders', $orders);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $this->authorize('viewAdminAndEmployee', Order::class);

        return view('orders.show', compact('order'));
    }

    public function getPrivateOrder(Order $order)
    {
        $this->authorize('viewPrivate', Order::class);

        $login = Auth::user();
        $user = Customer::find($login->id);

        if ($order->customer_id !== $user->id) {
            $htmlMessage = "You can't access this order!";
            $alertType = 'danger';


            return back()
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', $alertType);
        }

        return view('privateOrder.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $this->authorize('update', Order::class);

        $login = Auth::user();
        $user = User::find($login->id);

        return view('orders.edit')
            ->with('order', $order)
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $this->authorize('update', Order::class);

        $validatedData = $request->validate([
            'nif' => ['required', 'numeric', 'digits:9'],
            'address' => ['required'],
            'status' => 'required|in:"Closed","Pending","Paid","Canceled"',
            'payment_type' => [
                'required',
                function () use ($request) {
                    $paymentType = $request->input('payment_type');
                    return in_array($paymentType, array_column(PaymentType::cases(), 'value'));
                }
            ],
            'payment_ref' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $paymentType = $request->input('payment_type');

                    if ($paymentType === PaymentType::PAYPAL->name) {
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $fail('The ' . $attribute . ' must be a valid email address.');
                        }
                    } else {
                        if (!is_numeric($value) || strlen($value) !== 16) {
                            $fail('The ' . $attribute . ' must be numeric and have 16 digits.');
                        }
                    }
                }
            ]
        ]);

        $order->update($validatedData);

        if ($order->status == 'Closed') {

            // Create the pdf
            $pdf = PDF::loadView('pdf.index', compact('order'));

            // Store the PDF in private folder (pdf_receipts)
            $pdfFilename = 'receipt_' . $order->id . '.pdf';
            $pdf->save(storage_path('/app/pdf_receipts/' . $pdfFilename));

            // Save the receipt_url on DB
            $order->receipt_url = $pdfFilename;
            $order->save();

            $pathToPDF = 'pdf_receipts/' . $pdfFilename;
            // TODO
            $email = Auth::user()->email;
            Mail::to($email)->send(new OrderClosedMail($order, Auth::user(), $pathToPDF));
        }

        $url = route('orders.show', ['order' => $order]);
        $htmlMessage = "Order <a href='$url'>{$order->id}</a> was successfully updated!";
        return redirect()->route('orders.admin')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function getReceipt($orderID)
    {
        $order = Order::find($orderID);
        $this->authorize('getReceipt', $order);

        $path = 'pdf_receipts/' . $order->receipt_url;

        if (Storage::exists($path)) {
            $content = Storage::get($path);
            $mime = Storage::mimeType($path);
            $pdf = response($content)->header('Content-Type', $mime);

            return $pdf;
        }

        abort(404);
    }
}
