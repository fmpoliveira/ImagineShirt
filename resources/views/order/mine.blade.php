@extends('template.layout')

@section('titulo', 'Encomendas')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active">Minhas encomendas</li>
    </ol>
@endsection

@section('main')
    {{-- <div>
        @if ($tipo == 'D')
            <h3>Disciplinas que leciono</h3>
        @elseif($tipo == 'A')
            <h3>Disciplinas a que estou inscrito</h3>
        @endif
    </div>
    @if ($disciplinas)
        @include('disciplinas.shared.table', [
            'disciplinas' => $disciplinas,
            'showCurso' => true,
            'showDetail' => true,
            'showEdit' => false,
            'showDelete' => false,
        ])
    @endif --}}
@endsection
