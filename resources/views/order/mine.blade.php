@extends('template.layout')

@section('titulo', 'My Orders')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active">Minhas encomendas</li>
    </ol>
@endsection

@section('main')
    @include('order.shared.formFilterMine')
    @include('order.shared.table_order')
    <div class="mt-4">
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection
