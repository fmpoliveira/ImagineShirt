@extends('template.layout')

@section('titulo', 'Alterar Curso')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
        <li class="breadcrumb-item"><strong>{{ $curso->nome }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('cursos.update', ['curso' => $curso]) }}">
        @csrf
        @method('PUT')
        @include('cursos.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('cursos.edit', ['curso' => $curso]) }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
