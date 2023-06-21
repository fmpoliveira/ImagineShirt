<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $categories = Category::all();
        $categoriesQuery = Category::query(); // returns empty query builder

        $filterByText = $request->text ?? '';

        if ($filterByText !== '') {
            $categoriesID = Category::where('name', 'like', "%$filterByText%")->pluck('id');
            $categoriesQuery->whereIntegerInRaw('id', $categoriesID);
        }

        $categories = $categoriesQuery->paginate(10);

        return view('categories.index', compact('categories', 'filterByText'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();
        return view('categories.create')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        $url = route('categories.index', ['category' => $category]);
        $htmlMessage = "Category <strong>\"{$category->name}\"</strong> created successfully!";
        return redirect()->route('categories.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        $category->load('tshirtImages.category');
        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $formData = $request->validated();

        $category = DB::transaction(function () use ($formData, $category) {
            $category->name = $formData['name'];
            $category->save();

            return $category;
        });

        $url = route('categories.show', ['category' => $category]);
        $htmlMessage = "Category <a href='$url'>#{$category->id}</a>
                            <strong>\"{$category->name}\"</strong> updated with success!";
        return redirect()->route('categories.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        try {
            DB::transaction(function () use ($category) {
                $category->delete();
            });

            $htmlMessage = "category #{$category->id}
                        <strong>\"{$category->name}\"</strong> was successfully deleted!";
            return redirect()->route('categories.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('categories.show', ['category' => $category]);
            $htmlMessage = "It wasn't possible to delete <a href='$url'>#{$category->id}</a>
                        <strong>\"{$category->name}\"</strong> because there was an error!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
