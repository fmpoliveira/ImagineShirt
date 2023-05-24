@extends('template.layout')

@section('titulo', 'Catalog')

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
            <a class="btn btn-success" href="#{{-- 1********** ROTA PARA ADD IMAGEM NOVA**********1 --}}"><i class="fas fa-plus"></i> &nbsp;Adicionar imagem</a>
        </p>
        <hr>
        @include('tshirt.shared.formFilter')
        @include('tshirt.shared.cards')

        {{-- @include('tshirt.shared.table', [
            'showFoto' => true,
            'showDetail' => true,
            'showEdit' => true,
            'showDelete' => true,
        ]) --}}
        <div class="mt-4">
            {{ $tshirts->withQueryString()->links() }}
        </div>
    </div>
@endsection
