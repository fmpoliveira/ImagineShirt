<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allOrders = Order::all();
        // $ordersQuery = Order::query();
        //debug($allorders);
        // Log::debug('Cursos has been loaded on the controller.', ['$allorders' => $allorders]);
        // $allorders = $ordersQuery->paginate(5);
        return view('order.index')->with('orders', $allOrders);
    }

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // $total
        // $orderItems

        $orderItems = OrderItem::where('order_id', $order->id)
            ->get();

        // print_r($orderItems[0]->color->name);

        // return view('order.show')
        //     ->with('order')
        //     ->with('orderItems');
        return view('order.show', compact('order'))
            ->with('orderItems', $orderItems);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}