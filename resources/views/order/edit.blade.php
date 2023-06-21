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
    <form method="POST" action="{{ route('orders.update', ['order' => $order]) }}">
        @csrf
        @method('PUT')
        @include('order.shared.fields', ['order' => $order, 'readonlyData' => false])
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Save changes</button>
            <a href="{{ route('orders.show', ['order' => $order]) }}" class="btn btn-secondary ms-3">Cancel</a>
        </div>
    </form>
@endsection
