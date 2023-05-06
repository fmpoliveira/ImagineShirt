@extends('template.layout')

@section('titulo', 'Cursos')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol>
@endsection

@section('main')
    <p>
        {{-- <a class="btn btn-success" href="{{ route('cursos.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar novo curso</a> --}}
    </p>

    <td><img src="/img/avatar_unknown.png" alt="123" style="display: block; height:auto; width: auto"></td>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>id</th>
                {{-- <th>customer_id</th>
                <th>category_id</th> --}}
                <th>name</th>
                <th>description</th>
                <th>image</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->id }}</td>
                    {{-- <td>{{ $curso->customer_id ?? 'nao existe' }}</td>
                    <td>{{ $curso->category_id }}</td> --}}
                    <td>{{ $curso->name }}</td>
                    <td>{{ $curso->description }}</td>
                    {{-- <td>{{ $curso->image_url }}</td> --}}
                    <td><img src="/storage/app/public/tshirt_images/{{ $curso->image_url }}" alt="123"></td>
                    <td><img src="/storage/app/public/tshirt_images/100_64567cb7428fb.png" alt="123"></td>
                    {{-- <td><img src="/img/avatar_unknown.png" alt="123" style="display: block; height:auto; width: auto"></td> --}}
                    {{-- <td class="button-icon-col"><a href="{{ route('cursos.show', ['curso' => $curso]) }}" --}}
                    {{-- class="btn btn-secondary"><i class="fas fa-eye"></i></a></td> --}}
                    {{-- <td class="button-icon-col"><a href="{{ route('cursos.edit', ['curso' => $curso]) }}" --}}
                    {{-- class="btn btn-dark"><i class="fas fa-edit"></i></a></td> --}}
                    <td class="button-icon-col">
                        {{-- <form method="POST" action="{{ route('cursos.destroy', ['curso' => $curso]) }}"> --}}
                        @csrf
                        @method('DELETE')
                        {{-- <button type="submit" name="delete" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                        </button> --}}
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
