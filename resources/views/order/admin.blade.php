@extends('template.layout')

@section('titulo', 'Order Manager')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Manager</li>
        <li class="breadcrumb-item active">Order Manager</li>
    </ol>
@endsection

@section('main')
    @include('order.shared.formFilter')
    @include('order.shared.table_order')
    <div class="mt-4">
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection
