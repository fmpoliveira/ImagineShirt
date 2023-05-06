@extends('template.layout')

@section('titulo', 'Price')

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
                <th>unit_price_catalog</th>
                <th>unit_price_own</th>
                <th>unit_price_catalog_discount</th>
                <th>unit_price_own_discount</th>
                <th>qty_discount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prices as $price)
                <tr>
                    <td>{{ $price->unit_price_catalog }}</td>
                    <td>{{ $price->unit_price_own }}</td>
                    <td>{{ $price->unit_price_catalog_discount }}</td>
                    <td>{{ $price->unit_price_own_discount }}</td>
                    <td>{{ $price->qty_discount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
