@extends('template.layout')

@section('titulo', 'Nova Disciplina')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('disciplinas.index') }}">Disciplinas</a></li>
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('disciplinas.store') }}">
        @csrf
        @include('disciplinas.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar nova disciplina</button>
            <a href="{{ route('disciplinas.create') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
