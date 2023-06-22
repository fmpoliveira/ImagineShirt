<table class="table">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Size</th>
            <th>Color</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Sub-total</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($order->orderItems as $orderItem)
            <tr>
                <td>{{ $orderItem->tshirtImage->name }}</td>
                <td>{{ $orderItem->size }}</td>
                <td>{{ $orderItem->color->name ?? 'Not Available' }}</td>
                <td>{{ $orderItem->qty }}</td>
                <td>{{ number_format($orderItem->unit_price, 2) }}€</td>
                <td id="sub_total">{{ number_format($orderItem->sub_total, 2) }}€</td>
            </tr>
        @endforeach
        <tr>
            <td style="text-align: right" colspan="5"><b>TOTAL</b></td>
            <td style="text-align: left" colspan="2">{{ number_format($order->total_price, 2) }}€</td>
        </tr>
    </tbody>

</table>
