<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Number</th>
            <th>Status</th>
            <th>Date</th>
            <th>Price</th>
            <th>Receipt</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->date }}</td>
                <td>{{ number_format($order->total_price, 2) }}€</td>
                <td></td>
                <td class="button-icon-col"><a class="btn btn-secondary"
                        href="{{ route('orders.show', ['order' => $order->id]) }}">
                        <i class="fas fa-eye"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
