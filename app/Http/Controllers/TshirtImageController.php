<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\TshirtImage;
use App\Models\Category;
use App\Http\Requests\TshirtImagePrivateRequest;
use App\Http\Requests\TshirtImageRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// Preview image manipulation
use Intervention\Image\Facades\Image;

class TshirtImageController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(TshirtImage::class, 'tshirt');
    }

    public function index(Request $request): View
    {
        $categories = Category::all(); // buscar todas as categorias para imprimir no form
        $tshirts = TshirtImage::all();
        $tshirtsQuery = TshirtImage::query(); // returns empty query builder

        $filterByCategory = $request->category ?? '';
        $filterByText = $request->text ?? '';

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
        $this->authorize('viewAdmin', TshirtImage::class);

        $categories = Category::all(); // buscar todas as categorias para imprimir no form
        $tshirts = TshirtImage::all();
        $tshirtsQuery = TshirtImage::query(); // returns empty query builder

        $filterByCategory = $request->category ?? '';
        $filterByText = $request->text ?? '';

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
        if (Auth::check()) {
            $tshirt = new TshirtImage();
            $categories = Category::all(); // to be able to reuse the form
            return view('tshirt.create', compact('tshirt', 'categories'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TshirtImagePrivateRequest $request)
    {

        $formData = $request->validated();
        $user = Auth::user();
        $tshirt = DB::transaction(function () use ($formData, $request, $user) {
            $newTshirt = new TshirtImage();
            $newTshirt->name = $formData['name'];
            $newTshirt->description = $formData['description'];
            $newTshirt->customer_id = $user->customer->id;

            $image = $request->file('tshirt_image');
            $path = Storage::putFile('tshirt_images_private', $image);
            $image_name = basename($path);
            $newTshirt->image_url = $image_name;

            $newTshirt->save();

            return $newTshirt;
        });

        $url = route('tshirts.show', ['tshirt' => $tshirt]);
        $htmlMessage = "Tshirt <a href='$url'>#{$tshirt->id}</a>
                        <strong>\"{$tshirt->name}\"</strong> successfully created!";
        return redirect()->route('tshirts.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(TshirtImage $tshirt): View
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
        $tshirt = DB::transaction(function () use ($formData, $tshirt) {
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

    // --------------------------------- Private image management ---------------------------------

    public function indexPrivate()
    {
        $user = Auth::user();
        $this->authorize('viewCustomer', TshirtImage::class);

        if (Auth::check()) {
            $tshirts = TshirtImage::all();
            $tshirtsQuery = TshirtImage::query(); // returns empty query builder

            $user = Auth::user();
            $user_id = $user->customer->id;

            // Only sends the tshirts where customer_id is equal to the user_id
            $tshirts = $tshirtsQuery->where('customer_id', $user_id)->paginate(8);
            return view('privateTshirt.index', compact('tshirts'));
        } else {
            return redirect()->route('login');
        }
    }

    public function getPrivateImage($imagePath)
    {
        $path = 'tshirt_images_private/' . $imagePath;

        // imprime em todo o lado menos no show - o show está a passar o id
        if (Storage::exists($path)) {
            $content = Storage::get($path);
            $mime = Storage::mimeType($path);
            $image = response($content)->header('Content-Type', $mime);

            return $image;
        }

        abort(404);
    }

    public function showPrivate(TshirtImage $tshirt)
    {
        $this->authorize('viewPrivateImages', $tshirt);
        return view('privateTshirt.show', compact('tshirt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPrivate(TshirtImage $tshirt)
    {
        $this->authorize('updatePrivate', $tshirt);
        return view('privateTshirt.edit', compact('tshirt'));
    }

    public function updatePrivate(TshirtImagePrivateRequest $request, TshirtImage $tshirt): RedirectResponse
    {
        $this->authorize('updatePrivate', $tshirt);

        $formData = $request->validated();
        $tshirt = DB::transaction(function () use ($formData, $tshirt) {
            $tshirt->name = $formData['name'];
            $tshirt->description = $formData['description'];
            $tshirt->save();

            return $tshirt;
        });


        $url = route('privateTshirt.showPrivate', ['tshirt' => $tshirt]);
        $htmlMessage = "Tshirt <a href='$url'>#{$tshirt->id}</a>
                        <strong>\"{$tshirt->name}\"</strong> updated with success!";
        return redirect()->route('privateTshirt.indexPrivate')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function destroyPrivate(TshirtImage $tshirt): RedirectResponse
    {
        $this->authorize('deletePrivate', $tshirt);
        try {
            DB::transaction(function () use ($tshirt) {
                $tshirt->delete();
            });

            $htmlMessage = "Tshirt #{$tshirt->id}
                        <strong>\"{$tshirt->name}\"</strong> was successfully deleted!";
            return redirect()->route('privateTshirt.indexPrivate')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
        } catch (\Exception $error) {
            $url = route('privateTshirt.showPrivate', ['tshirt' => $tshirt]);
            $htmlMessage = "It wasn't possible to delete <a href='$url'>#{$tshirt->id}</a>
                        <strong>\"{$tshirt->name}\"</strong> because there was an error!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

    // Preview image manipulation
    public function placeCanvasOnView(Color $color, TshirtImage $tshirt)
    {
        // dd($color, $tshirt);
        $colorCode = $color->code;
        $tshirtUrl = $tshirt->image_url;

        // Load the base image (view) using Intervention Image
        $tshirtBase = Image::make(asset('storage/tshirt_base/' . $colorCode . '.jpg'));

        // Load the t-shirt logo image
        if ($tshirt->customer_id === null) {
            $tshirtLogo = Image::make(asset('storage/tshirt_images/' . $tshirtUrl));
        } else {
            $path = 'tshirt_images_private/' . $tshirt->image_url;
            $content = Storage::get($path);
            $base64privateImage = base64_encode($content);
            $tshirtLogo = Image::make($base64privateImage);
        }
        // Create a new canvas with desired dimensions
        $canvasWidth = $tshirtBase->width();
        $canvasHeight = $tshirtBase->height();
        $canvas = Image::canvas($canvasWidth, $canvasHeight);

        // Place the t-shirt base image onto the canvas
        $canvas->insert($tshirtBase, 'center');

        // Resize the logo
        $tshirtLogo->resize(200, 200);
        // Calculate the position to place the logo on the t-shirt
        $tshirtLogoX = ($canvasWidth - $tshirtLogo->width()) / 2;
        $tshirtLogoY = ($canvasHeight - $tshirtLogo->height()) / 2;

        // Place the logo on top of the t-shirt base image
        $canvas->insert($tshirtLogo, 'top-right', $tshirtLogoX, $tshirtLogoY);

        // $canvas->resize(500, 500);
        // Generate the base64-encoded image data
        $image = $canvas->encode('data-url')->encoded;

        return view('preview.canvas', ['image' => $image]);
    }
}
