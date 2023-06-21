@extends('template.layout')
@section('titulo', 'Cart')
@section('subtitulo')

@endsection
@section('main')
    <div>
        <h3>Tshirts on the cart</h3>
    </div>
    @if ($cart)
        @include('orders.shared.table', [
            'tshirts' => $cart,
            'sizes' => $sizes,
            'colors' => $colors,
            'total' => $total,
            'showDetail' => true,
            'showDelete' => true,
        ])
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok" form="formConfirm">
                Confirm Items</button>
            <button type="submit" class="btn btn-danger ms-3" name="clear" form="formClear">
                Clear Cart</button>
        </div>
        <form id="formConfirm" method="POST" action="{{ route('cart.confirm') }}" class="d-none">
            @csrf
        </form>
        <form id="formClear" method="POST" action="{{ route('cart.destroy') }}" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endsection
