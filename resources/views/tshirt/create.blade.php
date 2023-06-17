@extends('template.layout')

@section('titulo', 'Add Tshirt')

@section('subtitulo')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('disciplinas.index') }}">Disciplinas</a></li>
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol> --}}
@endsection

@section('main')

    <form id="form_tshirt" method="POST" action="{{ route('tshirts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('tshirt.shared.fields', [
                    'tshirt' => $tshirt,
                    'readonlyData' => false,
                    'showCategory' => false,
                ])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_tshirt">Save Tshirt</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary ms-3 me-3">Cancel</a>
                </div>
            </div>
            <div class="ps-2 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('tshirt.shared.fields_foto')
            </div>
        </div>
    </form>

@endsection
