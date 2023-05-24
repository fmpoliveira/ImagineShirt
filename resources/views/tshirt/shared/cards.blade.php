<div class="row">
    @foreach ($tshirts as $tshirt)
        <div class="col-6 col-md-3 mt-4">
            <div class="card h-100 bg-image">
                <div class="card-img-top">
                    <img src="{{ url('storage/tshirt_images/' . $tshirt->image_url) }}" alt="tshirt_logo" class="img-fluid"
                        style="max-height: 100%; width: 100%;">
                </div>
                <div class="card-body d-flex flex-column">
                    <hr>
                    <h5 class="card-title">{{ $tshirt->name }}</h5>
                    <p class="card-text">{{ $tshirt->description }}</p>
                    <div class="mt-auto text-center">
                        <form class="w-100 p-3" method="POST" {{-- action="{{ route('cart.add', ['tshirt' => $tshirt]) }}" --}}>
                            @csrf
                            <button type="submit" name="addToCart" class="btn btn-primary w-100">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
