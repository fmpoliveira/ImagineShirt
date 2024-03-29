@extends('template.layout')

@section('titulo', 'Create Category')

@section('subtitulo')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('disciplinas.index') }}">Disciplinas</a></li>
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol> --}}
@endsection

@section('main')
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        @include('categories.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Save new category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-3">Cancel</a>
        </div>
    </form>
@endsection
