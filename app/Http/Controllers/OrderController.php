<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Order;
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

    public function myOrders(Request $request)
    {
        $userId = Auth::id();
        $filterByStatus = $request->status ?? '';
        $orderQuery = DB::table('orders')->where('customer_id', $userId);
        $allOrderStatus = array_column(OrderStatus::cases(), 'value');

        if ($filterByStatus !== '') {
            $orderQuery->where('status', strtolower($filterByStatus));
        }
        $orders = $orderQuery->orderBy('date', 'desc')->paginate(12);

        return view('order.mine')
            ->with('allOrderStatus', $allOrderStatus)
            ->with('filterByStatus', $filterByStatus)
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
        $orderItems = DB::table('order_items')
            ->where('order_id', $order->id)
            ->get();

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