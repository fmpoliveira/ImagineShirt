@extends('template.layout')

@section('titulo', 'Price')

@section('main')

    @foreach ($prices as $price)
        <p>
            <a class="btn btn-success" href="{{ route('prices.edit', ['price' => $price]) }}"><i class="fas fa-plus"></i>
                &nbsp;Update
                Prices</a>
        </p>
        <hr>
        <table class="table">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Shop Tshirt Price</th>
                    <th>Private Tshirt Price</th>
                    <th>Price Shop Tshirt with Discount</th>
                    <th>Price Private Tshirt with Discount</th>
                    <th>Qty Tshirts to Discount</th>
                </tr>
            </thead>
            <tbody>

                <tr class="text-center">
                    <td>{{ $price->unit_price_catalog }}</td>
                    <td>{{ $price->unit_price_own }}</td>
                    <td>{{ $price->unit_price_catalog_discount }}</td>
                    <td>{{ $price->unit_price_own_discount }}</td>
                    <td>{{ $price->qty_discount }}</td>
                </tr>
            </tbody>
        </table>
    @endforeach


@endsection
