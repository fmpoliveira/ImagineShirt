@extends('template.layout')

@section('titulo', 'Customers')

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
                <th>Nif</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->nif }}</td>
                    <td>{{ $customer->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
