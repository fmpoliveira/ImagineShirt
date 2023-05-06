@extends('template.layout')

@section('titulo', 'Alterar Disciplina')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('disciplinas.index') }}">Disciplinas</a></li>
        <li class="breadcrumb-item"><strong>{{ $disciplina->nome }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('disciplinas.update', ['disciplina' => $disciplina]) }}">
        @csrf
        @method('PUT')
        @include('disciplinas.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('disciplinas.edit', ['disciplina' => $disciplina]) }}"
                class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
