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

    {{-- @foreach ($tshirts as $tshirt)
        <tr>
            <div class="container-md">
                <div class="row">
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img src="/storage/app/public/tshirt_images/{{ $tshirt->image_url }}" class="card-img-top"
                                alt="123">
                            <div class="card-body">
                                <h5 class="card-title">{{ $tshirt->name }}</h5>
                                <p class="card-text">{{ $tshirt->description }}</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </tr>
    @endforeach --}}


    {{-- @foreach ($tshirts as $tshirt)
            <div class="card" style="width: 18rem;">
                <img src="/storage/app/public/tshirt_images/{{ $tshirt->image_url }}" class="card-img-top" alt="123">
                <div class="card-body">
                    <h5 class="card-title">{{ $tshirt->name }}</h5>
                    <p class="card-text">{{ $tshirt->description }}</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach --}}


    <div class="row row-cols-1 row-cols-md-5 g-4">
        @foreach ($tshirts as $tshirt)
            <div class="col">
                <div class="card h-100" style="width: 18rem">
                    <img src="{{ url('storage/tshirt_images/' . $tshirt->image_url) }}" alt="123" title=""
                        class="card-img-top img-fluid" />
                    <div class="card-body">
                        <h5 class="card-title">{{ $tshirt->name }}</h5>
                        <p class="card-text">{{ $tshirt->description }}</p>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div>
        {{ $tshirts->withQueryString()->links() }}
    </div>



@endsection
