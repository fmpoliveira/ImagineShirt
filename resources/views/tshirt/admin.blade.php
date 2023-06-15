@extends('template.layout')

@section('titulo', 'Tshirt Manager')

@section('subtitulo')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol> --}}
@endsection

@section('main')

    @include('tshirt.shared.formFilter')
    @include('tshirt.shared.table')
    <div class="mt-4">
        {{ $tshirts->withQueryString()->links() }}
    </div>

@endsection
