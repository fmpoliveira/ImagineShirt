@extends('template.layout')

@section('titulo', 'shoppingCart')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol>
@endsection

{{-- @section('main')
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Status</th>
                <th>Customer Id</th>
                <th>Date</th>
                <th>Total Price</th>
                <th>NIF</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->customer_id }}</td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->nif }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection --}}
