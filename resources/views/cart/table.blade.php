<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Size</th>
            <th>Color</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Sub-total</th>
            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif

        </tr>
    </thead>

    <tbody>
        @foreach ($tshirts as $tshirt)
            <tr>
                <td>{{ $tshirt->name }}</td>
                <td>{{ $tshirt->size }}</td>
                <td>{{ $tshirt->color }}</td>
                <td>{{ $tshirt->qty }}</td>
                <td>{{ number_format($tshirt->price , 2) }}€</td>
                <td id="sub_total">{{ number_format($tshirt->sub_total , 2) }}€</td>
            </tr>
        @endforeach
        <tr>
            <td style="text-align: right" colspan="5"><b>TOTAL</b></td>
            <td style="text-align: left" colspan="2">{{ number_format($total , 2) }}€</td>
        </tr>
    </tbody>

</table>
