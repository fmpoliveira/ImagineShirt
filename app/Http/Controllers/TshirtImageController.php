<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\TshirtImage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TshirtImageRequest;
use Illuminate\Support\Facades\DB;


class TshirtImageController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::all(); // buscar todas as categorias para imprimir no form
        $tshirts = TshirtImage::all();
        $tshirtsQuery = TshirtImage::query(); // returns empty query builder

        $filterByCategory = $request->category ?? '';
        $filterByText = $request->text ?? '';
        $display = $request->display ?? '';

        // Checks the category passed through the request in the Category Table. If it exists, populates the tshirtQuery with the name.
        if ($filterByCategory !== '') {
            if ($filterByCategory === 'No Category') {
                // if No Category selected, search for images with no category_id
                $tshirtsQuery->where('category_id', null);
            } else {
                $tshirtsQuery->whereHas('category', function ($category) use ($filterByCategory) {
                    $category->where('name', $filterByCategory);
                });
            }
        }

        if ($filterByText !== '') {
            $tshirtIDs = TshirtImage::where('name', 'like', "%$filterByText%")->orWhere('description', 'like', "%$filterByText%")->pluck('id');
            $tshirtsQuery->whereIntegerInRaw('id', $tshirtIDs);
        }

        // Only sends the logos which have a value in costumer_id
        $tshirts = $tshirtsQuery->where('customer_id', null)->paginate(8);

        $formView = 'index';
        return view('tshirt.index', compact('categories', 'filterByCategory', 'tshirts', 'filterByText', 'formView'));
    }

    public function indexAdmin(Request $request): View
    {
        $categories = Category::all(); // buscar todas as categorias para imprimir no form
        $tshirts = TshirtImage::all();
        $tshirtsQuery = TshirtImage::query(); // returns empty query builder

        $filterByCategory = $request->category ?? '';
        $filterByText = $request->text ?? '';
        $display = $request->display ?? '';

        // Checks the category passed through the request in the Category Table. If it exists, populates the tshirtQuery with the name.
        if ($filterByCategory !== '') {
            if ($filterByCategory === 'No Category') {
                // if No Category selected, search for images with no category_id
                $tshirtsQuery->where('category_id', null);
            } else {
                $tshirtsQuery->whereHas('category', function ($category) use ($filterByCategory) {
                    $category->where('name', $filterByCategory);
                });
            }
        }

        if ($filterByText !== '') {
            $tshirtIDs = TshirtImage::where('name', 'like', "%$filterByText%")->orWhere('description', 'like', "%$filterByText%")->pluck('id');
            $tshirtsQuery->whereIntegerInRaw('id', $tshirtIDs);
        }

        // Only sends the logos which have a value in costumer_id
        $tshirts = $tshirtsQuery->where('customer_id', null)->paginate(8);

        $formView = 'admin';
        return view('tshirt.admin', compact('categories', 'filterByCategory', 'tshirts', 'filterByText', 'formView'));
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
    public function show(TshirtImage $tshirt)
    {
        $categories = Category::all();
        return view('tshirt.show', compact('tshirt', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TshirtImage $tshirt)
    {
        $categories = Category::all();
        return view('tshirt.edit', compact('tshirt', 'categories'));
    }

    public function update(TshirtImageRequest $request, TshirtImage $tshirt): RedirectResponse
    {
        $formData = $request->validated();
        // dd($formData);
        $tshirt = DB::transaction(function () use ($formData, $tshirt, $request) {
            $tshirt->name = $formData['name'];
            $tshirt->description = $formData['description'];
            if ($formData['category'] === 'No Category') {
                $tshirt->category_id = null;
            } else {
                $tshirt->category_id = $formData['category'];
            }
            $tshirt->save();

            return $tshirt;
        });


        $url = route('tshirts.show', ['tshirt' => $tshirt]);
        $htmlMessage = "Tshirt <a href='$url'>#{$tshirt->id}</a>
                        <strong>\"{$tshirt->name}\"</strong> updated with success!";
        return redirect()->route('tshirts.admin')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function destroy(TshirtImage $tshirt): RedirectResponse
    {
        try {
            DB::transaction(function () use ($tshirt) {
                $tshirt->delete();
            });

            $htmlMessage = "Tshirt #{$tshirt->id}
                        <strong>\"{$tshirt->name}\"</strong> was successfully deleted!";
            return redirect()->route('tshirts.admin')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('tshirts.show', ['tshirt' => $tshirt]);
            $htmlMessage = "It wasn't possible to delete <a href='$url'>#{$tshirt->id}</a>
                        <strong>\"{$tshirt->name}\"</strong> because there was an error!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
