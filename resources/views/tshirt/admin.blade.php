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


    <div class="container">
        <p>
            <a class="btn btn-success" href="#{{-- 1********** ROTA PARA ADD IMAGEM NOVA**********1 --}}"><i class="fas fa-plus"></i> &nbsp;Adicionar imagem</a>
        </p>
        <hr>
        @include('tshirt.shared.formFilter')
        @include('tshirt.shared.table')
        <div class="mt-4">
            {{ $tshirts->withQueryString()->links() }}
        </div>
    </div>
@endsection
