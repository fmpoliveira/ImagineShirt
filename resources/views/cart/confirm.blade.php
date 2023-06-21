@extends('template.layout')
@section('titulo', 'Confirm your Order')
@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('cart.show') }}">Cart</a></li>
        <li class="breadcrumb-item active">Confirm</li>
    </ol>
@endsection
@section('main')
    <div>
        <h3>Confirm your order details</h3>
    </div>
    @include('cart.table', [
        'tshirts' => $cart,
        'total' => $total,
        'showDetail' => true,
    ])
    <div>
        <h3>Confirm/fill your user details</h3>
    </div>
    <form method="POST" action="{{ route('cart.store') }}">
        @csrf
        @include('cart.fields')
        <div class="my-4 d-flex justify-content-end">
            <a href="{{ route('cart.show') }}" class="btn btn-secondary ms-3">Back</a>
            <button type="submit" class="btn btn-primary ms-3" name="ok">
                Confirm Order
            </button>
        </div>
    </form>


@endsection
