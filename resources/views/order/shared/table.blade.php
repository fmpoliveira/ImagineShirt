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
            <input form="refresh" type="hidden" name={{ 'tshirts[]' }} value={{ $tshirt->id }}>
            <tr>
                <td>{{ $tshirt->name }}</td>
                <td>
                    <select form="refresh" name={{ 'sizes[]' }} id="sizes">
                        @foreach ($sizes as $size)
                            <option value="{{ $size->size }}" @if ($size->size === $tshirt->size) selected @endif>
                                {{ $size->size }}</option>
                        @endForeach
                    </select>
                </td>
                <td>
                    <select form="refresh" name={{ 'colors[]' }} id="colors">
                        @foreach ($colors as $color)
                            <option value="{{ $color->code }}" @if ($color->code === $tshirt->color) selected @endif>
                                {{ $color->name }}</option>
                        @endForeach
                    </select>
                </td>
                <td>
                    <input form="refresh" type="number" id="quantity" name={{ 'quantities[]' }} min="1"
                        max="100" value={{ $tshirt->qty }}>
                </td>
                <td>
                    {{ number_format($tshirt->price, 2) }}€
                </td>
                <td id="sub_total">
                    {{ number_format($tshirt->sub_total, 2) }}€
                </td>
                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('tshirts.show', ['tshirt' => $tshirt]) }}">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showDelete)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('cart.remove', ['tshirt' => $tshirt]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        <tr>
            <td style="text-align: right" colspan="5"><b>TOTAL</b></td>
            <td style="text-align: left" colspan="2">{{ number_format($total, 2) }}€</td>
        </tr>
    </tbody>

</table>
<div class="my-4 d-flex justify-content-end">
    <button class="btn btn-secondary" form="refresh" type="submit">Update total</button>
</div>
<form id="refresh" action="{{ route('cart.refresh') }}" method="POST" class="d-none">
    @csrf
    <input type="hidden" name="refresh" value="true">
</form>
