@extends('template.layout')

@section('titulo', 'Order')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Private Space</li>
        <li class="breadcrumb-item"><a href="{{ route('privateOrder.indexPrivate') }}">My Orders</a></li>
        <li class="breadcrumb-item"><strong>#{{ $order->id }}</strong></li>
        <li class="breadcrumb-item active">View</li>
    </ol>
@endsection

@section('main')
    <div>
        @include('orders.shared.fields', ['order' => $order, 'readonlyData' => true])
        @include('orders.shared.table_view')
        <div class="my-4 d-flex justify-content-end">
            <a href="{{ route('privateOrder.indexPrivate') }}" class="btn btn-primary ms-3">Back</a>
        </div>
    </div>
@endsection
