<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $tipo = 'O';
        // if ($request->user()) {
        //     $tipo = $request->user()->tipo ?? 'O';
        // }
        // if ($tipo == 'D') {
        //     $disciplinas = $request->user()->docente->disciplinas;
        // } elseif ($tipo == 'A') {
        //     $disciplinas = $request->user()->aluno->disciplinas;
        // } else {
        //     $disciplinas = null;
        // }
        $userId = Auth::id();
        $user = Customer::find($userId);
        $orders = $user->orders;
        return view('order.mine')->with('orders', $user->orders);
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
        //
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
