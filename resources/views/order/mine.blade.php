@extends('template.layout')

@section('titulo', 'Encomendas')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active">Minhas encomendas</li>
    </ol>
@endsection

@section('main')
    <div>
        <h3>Your orders</h3>
    </div>
    @if ($orders)
        @include('order.shared.table_order', [
            'orders' => $orders
        ])
    @endif
@endsection
