<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Number</th>
            <th>Customer ID</th>
            <th>Status</th>
            <th>Date</th>
            <th>Price</th>
            <th>Receipt</th>
            @if ($showEdit)
                <th></th>
            @endif
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_id }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->date }}</td>
                <td>{{ number_format($order->total_price, 2) }}€</td>
                <td></td>
                @if ($showEdit)
                    <td class="button-icon-col">
                        <a class="btn btn-dark" href="{{ route('orders.edit', ['order' => $order->id]) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('orders.show', ['order' => $order->id]) }}">
                            <i class="fas fa-eye"></i></a>
                    </td>
                @else
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('privateOrder.showPrivate', ['order' => $order->id]) }}">
                            <i class="fas fa-eye"></i></a>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
