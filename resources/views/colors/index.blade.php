@extends('template.layout')

@section('titulo', 'Colors')

@section('subtitulo')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol> --}}
@endsection

@section('main')

    <div class="container">
        <p>
            <a class="btn btn-success" href="{{ route('colors.create') }}"><i class="fas fa-plus"></i> &nbsp;Create
                Color</a>
        </p>
        <hr>
        @include('colors.shared.formFilter')
        @include('colors.shared.table')
        <div class="mt-4">
            {{ $colors->withQueryString()->links() }}
        </div>
    </div>

@endsection
