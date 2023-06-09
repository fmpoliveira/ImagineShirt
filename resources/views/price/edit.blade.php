@extends('template.layout')

@section('titulo', 'Change Prices ')

@section('subtitulo')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
        <li class="breadcrumb-item"><strong>{{ $docente->user->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol> --}}
@endsection

@section('main')
    <form id="form_price" novalidate class="needs-validation" method="POST"
        action="{{ route('prices.update', ['price' => $price]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="price_code" value="{{ $price->code }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('price.shared.fields', ['price' => $price, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_price">Save Changes</button>
                    <a href="{{ route('prices.index') }}" class="btn btn-secondary ms-3">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection
