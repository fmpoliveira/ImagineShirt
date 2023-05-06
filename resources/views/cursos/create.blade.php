@extends('template.layout')

@section('titulo', 'Novo Curso')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
        <li class="breadcrumb-item active">Criar Novo</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('cursos.store') }}">
        @csrf
        @include('cursos.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar novo curso</button>
            <a href="{{ route('cursos.create') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
