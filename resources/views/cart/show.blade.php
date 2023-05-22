@extends('template.layout')
@section('titulo', 'Carrinho')
@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active">Carrinho</li>
    </ol>
@endsection
@section('main')
    <div>
        <h3>Tshirts no carrinho</h3>
    </div>
    @if ($cart)
        @include('order.shared.table', [
            'tshirts' => $cart,
            'sizes' => $sizes,
            'colors' => $colors,
            'showDetail' => true,
            'showDelete' => true,
        ])
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok" form="formStore">
                Confirmar Itens</button>
            <button type="submit" class="btn btn-danger ms-3" name="clear" form="formClear">
                Limpar Carrinho</button>
        </div>
        <form id="formStore" method="POST" action="{{ route('cart.store') }}" class="d-none">
            @csrf
        </form>
        <form id="formClear" method="POST" action="{{ route('cart.destroy') }}" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endsection
