@extends('template.layout')

@section('titulo', 'OrderItems')

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
                <th>Order Id</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Sub total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $orderItem)
                <tr>
                    <td>{{ $orderItem->order_id }}</td>
                    <td>{{ $orderItem->size }}</td>
                    <td>{{ $orderItem->qty }}</td>
                    <td>{{ $orderItem->unit_price }}</td>
                    <td>{{ $orderItem->sub_total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
