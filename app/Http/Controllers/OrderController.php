<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function myOrders(Request $request): View
    {
        $userId = Auth::id();
        $filterByStatus = $request->status ?? '';
        $orderQuery = DB::table('orders')->where('customer_id', $userId);
        $allOrderStatus = array_column(OrderStatus::cases(), 'value');

        if ($filterByStatus !== '') {
            $orderQuery->where('status', strtolower($filterByStatus));
        }
        $orders = $orderQuery->orderBy('date', 'desc')->paginate(10);

        return view('order.mine')
            ->with('allOrderStatus', $allOrderStatus)
            ->with('filterByStatus', $filterByStatus)
            ->with('orders', $orders);
    }

    public function indexAdmin(Request $request)
    {
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

        return view('order.admin')
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

        $orderItems = OrderItem::where('order_id', $order->id)
            ->get();
        
        return view('order.show', compact('order'))
            ->with('orderItems', $orderItems);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('order.edit')
            ->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
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

                    if ($paymentType === PaymentType::PAYPAL) {
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $fail('The ' . $attribute . ' must be a valid email address.');
                        }
                    } else {
                        if (!is_numeric($value) || strlen($value) !== 16) {
                            $fail('The ' . $attribute . ' must be numeric and have 16 digits.');
                        }

                    }
                }
            ],
            'total_price' => 'required'
        ]);

        $order->update($validatedData);

        $url = route('orders.show', ['order' => $order]);
        $htmlMessage = "Order <a href='$url'>{$order->id}</a> was successfully updated!";
        return redirect()->route('order.admin')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }
}