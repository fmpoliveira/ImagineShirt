@extends('template.layout')

@section('titulo', 'My Orders')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Private Space</li>
        <li class="breadcrumb-item active">My Orders</li>
    </ol>
@endsection

@section('main')
    @include('orders.shared.formFilterMine')
    @include('orders.shared.table_order', [
        'showEdit' => false
    ])
    <div class="mt-4">
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection
