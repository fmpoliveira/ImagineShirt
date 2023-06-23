@extends('template.layout')

@section('titulo', 'Order')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Manager</li>
        <li class="breadcrumb-item"><a href="{{ route('orders.admin') }}">Order Manager</a></li>
        <li class="breadcrumb-item"><strong>#{{ $order->id }}</strong></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('orders.update', ['order' => $order]) }}">
        @csrf
        @method('PUT')
        @if ($order->status === 'closed' || $order->status === 'canceled')
            @include('orders.shared.fields', [
                'order' => $order,
                'user' => $user,
                'readonlyData' => true,
            ])
        @else
            @include('orders.shared.fields', [
                'order' => $order,
                'user' => $user,
                'readonlyData' => false,
            ])
        @endif
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Save changes</button>
            <a href="{{ route('orders.admin') }}" class="btn btn-secondary ms-3">Cancel</a>
        </div>
    </form>
@endsection
