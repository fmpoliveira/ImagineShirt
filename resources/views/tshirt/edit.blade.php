@extends('template.layout')

@section('titulo', 'Change Tshirt ')

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
    <form id="form_tshirt" novalidate class="needs-validation" method="POST"
        action="{{ route('tshirts.update', ['tshirt' => $tshirt]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="tshirt_id" value="{{ $tshirt->id }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('tshirt.shared.fields', ['tshirt' => $tshirt, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_tshirt">Save Changes</button>
                    <a href="{{ route('tshirts.admin') }}" class="btn btn-secondary ms-3">Cancel</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                <img src="{{ asset('storage/tshirt_images/' . $tshirt->image_url) }}" alt="Avatar" class="img-thumbnail">
            </div>
        </div>
    </form>
@endsection
