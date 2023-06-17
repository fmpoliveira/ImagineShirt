@extends('template.layout')

@section('titulo', 'Order')

@section('subtitulo')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">Orders</li>
        <li class="breadcrumb-item"><a href="{{ route('candidaturas.index') }}">Candidaturas</a></li>
        <li class="breadcrumb-item"><strong>#{{ $candidatura->id }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol> --}}
@endsection

@section('main')
    <div>
        @include('order.shared.fields', ['order' => $order, 'readonlyData' => true])
        @include('order.shared.table_view', ['order' => $order, 'orderItems' => $orderItems])
    </div>
@endsection
