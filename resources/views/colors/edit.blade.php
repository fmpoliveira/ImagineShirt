@extends('template.layout')

@section('titulo', 'Change Color ')

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
    <form id="form_color" novalidate class="needs-validation" method="POST"
        action="{{ route('colors.update', ['color' => $color]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="color_id" value="{{ $color->id }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('colors.shared.fields', ['color' => $color, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_color">Save Changes</button>
                    <a href="{{ route('colors.index') }}" class="btn btn-secondary ms-3">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection
