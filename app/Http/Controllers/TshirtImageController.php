<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TshirtImage;

class TshirtImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allTshirts = TshirtImage::all();
        $tshirtsQuery = TshirtImage::query();
        //debug($allTshirts);
        // Log::debug('Cursos has been loaded on the controller.', ['$allTshirts' => $allTshirts]);
        $allTshirts = $tshirtsQuery->paginate(5);
        return view('tshirt.index')->with('tshirts', $allTshirts);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}