<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\TshirtImage;
use Illuminate\View\View;

class TshirtImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $categories = Category::all(); // buscar todas as categorias para imprimir no form
        $tshirts = TshirtImage::all();
        $tshirtsQuery = TshirtImage::query(); // returns empty query builder

        $filterByCategory = $request->category ?? '';
        $filterByText = $request->text ?? '';

        // Checks the category passed through the request in the Category Table. If it exists, populates the tshirtQuery with the name.
        if ($filterByCategory !== '') {
            $tshirtsQuery->whereHas('category', function ($category) use ($filterByCategory) {
                $category->where('name', $filterByCategory);
            });
        }

        if ($filterByText !== '') {
            $tshirtIDs = TshirtImage::where('name', 'like', "%$filterByText%")->orWhere('description', 'like', "%$filterByText%")->pluck('id');
            $tshirtsQuery->whereIntegerInRaw('id', $tshirtIDs);
        }

        $tshirts = $tshirtsQuery->whereNot('category_id', null)->paginate(8); // Only sends the logos which have a value in costumer_id
        return view('tshirt.index', compact('categories', 'filterByCategory', 'tshirts', 'filterByText'));
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
