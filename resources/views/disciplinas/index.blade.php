@extends('template.layout')

@section('titulo', 'Disciplinas')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Disciplinas</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('disciplinas.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar nova
            disciplina</a></p>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Abreviatura</th>
                <th>Nome</th>
                <th>Curso</th>
                <th>Ano</th>
                <th>Semestre</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplinas as $disciplina)
                <tr>
                    <td>{{ $disciplina->abreviatura }}</td>
                    <td>{{ $disciplina->nome }}</td>
                    <td>{{ $disciplina->curso }}</td>
                    <td>{{ $disciplina->ano }}</td>
                    <td>{{ $disciplina->semestre }}</td>
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('disciplinas.show', ['disciplina' => $disciplina]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('disciplinas.edit', ['disciplina' => $disciplina]) }}">
                            <i class="fas fa-edit"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('disciplinas.destroy', ['disciplina' => $disciplina]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $disciplinas->links() }}
    </div>
@endsection
