@extends('template.layout')

@section('titulo', 'Curso')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
        <li class="breadcrumb-item"><strong>{{ $curso->nome }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('cursos.shared.fields', ['readonlyData' => true])
    </div>
    <div class="my-4 d-flex justify-content-end">
        <a href="{{ route('cursos.edit', ['curso' => $curso]) }}" class="btn btn-secondary ms-3">Alterar Curso</a>
    </div>
@endsection
