<table class="table">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Size</th>
            <th>Color</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Sub-total</th>
            <th class="button-icon-col"></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($orderItems as $orderItem)
            <tr>
                <td>{{ $orderItem->tshirt_image_id }}</td>
                <td>{{ $orderItem->size }}</td>
                <td>{{ $orderItem->color_code }}</td>
                <td>{{ $orderItem->qty }}</td>
                <td>{{ number_format($orderItem->unit_price, 2) }}€</td>
                <td id="sub_total">{{ number_format($orderItem->sub_total, 2) }}€</td>
                <td class="button-icon-col"><a class="btn btn-secondary"
                        href="{{ route('tshirts.show', ['tshirt' => $orderItem->tshirt_image_id]) }}">
                        <i class="fas fa-eye"></i></a></td>
            </tr>
        @endforeach
        <tr>
            <td style="text-align: right" colspan="5"><b>TOTAL</b></td>
            <td style="text-align: left" colspan="2">{{ number_format($order->total_price, 2) }}€</td>
        </tr>
    </tbody>

</table>
