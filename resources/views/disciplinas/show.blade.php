@extends('template.layout')

@section('titulo', 'Disciplina')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('disciplinas.index') }}">Disciplinas</a></li>
        <li class="breadcrumb-item"><strong>{{ $disciplina->nome }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('disciplinas.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <a href="{{ route('disciplinas.edit', ['disciplina' => $disciplina]) }}" class="btn btn-secondary ms-3">Alterar
            Disciplina</a>
    </div>
@endsection
