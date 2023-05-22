@extends('template.layout')

@section('titulo', 'Tshirts')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol>
@endsection

@section('main')
    <p>
        {{-- <a class="btn btn-success" href="{{ route('cursos.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar novo curso</a> --}}
    </p>

    <hr>
    <form method="GET" action="{{ route('tshirts.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 mb-3 form-floating">

                        <select class="form-select" name="category" id="inputCategory">
                            <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value="">
                                All Categories </option>
                            @foreach ($categories as $category)
                                <option {{ old('category', $filterByCategory) == $category->name ? 'selected' : '' }}
                                    value="{{ $category->name }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="inputCategory" class="form-label">Category</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="text" id="inputText"
                            value="{{ old('text', $filterByText) }}">
                        <label for="inputText" class="form-label">Search</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('tshirts.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>

    <div class="container">
        <div class="row">
            <div class="row">
                @foreach ($tshirts as $tshirt)
                    <div class="col-6 col-md-3 mt-4">
                        <div class="card h-100">
                            <div class="card-img-top">
                                <img src="{{ url('storage/tshirt_images/' . $tshirt->image_url) }}" alt="tshirt_logo"
                                    class="img-fluid" style="object-fit: contain; max-height: 100%; width: 100%;">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <hr>
                                <h5 class="card-title">{{ $tshirt->name }}</h5>
                                <p class="card-text">{{ $tshirt->description }}</p>
                                {{-- <a href="{{ route('cart.add', ['tshirt' => $tshirt]) }}"
                                    class="btn btn-primary mt-auto">Add to Cart</a> --}}
                                <form class="w-100 p-3" method="POST" action="{{ route('cart.add', ['tshirt' => $tshirt]) }}">
                                    @csrf
                                    <button type="submit" name="addToCart" class="btn btn-primary mt-auto w-100">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-4">
            {{ $tshirts->withQueryString()->links() }}
        </div>
    </div>





@endsection
