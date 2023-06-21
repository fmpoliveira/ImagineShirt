<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ColorRequest;

class ColorController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Color::class, 'color');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $colors = Color::all();
        $colorQuery = Color::query();

        $filterByText = $request->text ?? '';

        if ($filterByText !== '') {
            $colorsID = Color::where('name', 'like', "%$filterByText%")->pluck('code');
            $colorQuery->whereIn('code', $colorsID);
        }

        $colors = $colorQuery->paginate(10);
        return view('colors.index', compact('colors', 'filterByText'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $color = new Color();
        return view('colors.create')->with('color', $color);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        $color = Color::create($request->validated());
        $url = route('colors.index', ['color' => $color]);
        $htmlMessage = "Color <a href='$url'>{$color->code}</a> <strong>\"{$color->name}\"</strong> created successfully!";
        return redirect()->route('colors.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color): View
    {
        // $color->load('tshirtImages.category');
        return view('colors.show')->with('color', $color);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color): View
    {
        return view('colors.edit')->with('color', $color);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, Color $color): RedirectResponse
    {

        $color->update($request->validated());
        $url = route('colors.show', ['color' => $color]);
        $htmlMessage = "Color <a href='$url'>{$color->code}</a>
                        <strong>\"{$color->name}\"</strong> updated successfully!";
        return redirect()->route('colors.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        try {
            DB::transaction(function () use ($color) {
                $color->delete();
            });

            $htmlMessage = "Color #{$color->code}
                        <strong>\"{$color->name}\"</strong> was successfully deleted!";
            return redirect()->route('colors.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('colors.show', ['color' => $color]);
            $htmlMessage = "It wasn't possible to delete <a href='$url'>#{$color->code}</a>
                        <strong>\"{$color->name}\"</strong> because there was an error!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
}
