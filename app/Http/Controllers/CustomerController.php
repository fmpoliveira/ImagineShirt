<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $allCustomers = Customer::all();
    //     return view('customers.index')->with('customers', $allCustomers);
    // }
    public function index(Request $request)
    {
        $filterByNome = $request->nome ?? '';

        $customerQuery = Customer::query();
        if ($filterByNome !== '') {
            $userIds = User::where('name', 'like', "%$filterByNome%")->pluck('id');
            $customerQuery->whereIntegerInRaw('id', $userIds);
        }
        $customers = $customerQuery->with('user')->paginate(10);
        //$customers = Customer::with('user')->get();
        return view('customers.index', compact('customers','filterByNome'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $customer = new Customer();
        $customer->user = $user;
        return view('customers.create', compact('customer'));
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
    public function show(Customer $customer): View
    {
        $customerQuery = Customer::query();
        $customers = $customerQuery->with('user')->get();
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View
    {

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
