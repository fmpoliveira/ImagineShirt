@extends('template.layout')

@section('titulo', 'Shop')

@section('subtitulo')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol> --}}
@endsection

@section('main')

    @auth
        <p>
            <a class="btn btn-success" href="{{ route('tshirts.create') }}"><i class="fas fa-plus"></i> &nbsp;Add Tshirt</a>
        </p>
        <hr>
    @endauth
    @include('tshirt.shared.formFilter')
    @include('tshirt.shared.cards')

    <div class="mt-4">
        {{ $tshirts->withQueryString()->links() }}
    </div>

@endsection
