<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Price::class, 'price');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = Price::all();
        return view('price.index')->with('prices', $prices);
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
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        return view('price.edit')->with('price', $price);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PriceRequest $request, Price $price)
    {
        $price->update($request->validated());
        $htmlMessage = "Price updated successfully!";
        return redirect()->route('prices.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
        //
    }
}
