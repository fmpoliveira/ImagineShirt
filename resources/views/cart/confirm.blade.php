@extends('template.layout')
@section('titulo', 'Cofirm your Cart')
@section('subtitulo')
    {{-- <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active">Cart</li>
    </ol> --}}
@endsection
@section('main')
    <div>
        <h3>Confirm/fill your user details</h3>
    </div>
    <form id="formStore" method="POST" action="{{ route('cart.store') }}">
        @csrf
        @include('cart.fields')
    </form>
    <div>
        <h3>Confirm your order details</h3>
    </div>
    @include('cart.table', [
        'tshirts' => $cart,
        'total' => $total,
        'showDetail' => true,
    ])
    <div class="my-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary" name="ok" form="formStore">
            Confirm Order</button>
    </div>
@endsection
