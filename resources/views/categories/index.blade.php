@extends('template.layout')

@section('titulo', 'Categories')

@section('subtitulo')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol> --}}
@endsection

@section('main')
    <p>
        <a class="btn btn-success" href="{{ route('categories.create') }}"><i class="fas fa-plus"></i> &nbsp;Add
            Category</a>
    </p>
    <hr>
    @include('categories.shared.formFilter')
    @include('categories.shared.table')
    <div class="mt-4">
        {{ $categories->withQueryString()->links() }}
    </div>
@endsection
