@extends('template.layout')

@section('titulo', 'Colors')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol>
@endsection

@section('main')
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->code }}</td>
                    <td>{{ $color->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
