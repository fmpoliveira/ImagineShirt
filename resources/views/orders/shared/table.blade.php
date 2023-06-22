<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Size</th>
            <th>Color</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Sub-total</th>
            <th></th>
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
                    <select form="refresh" name={{ 'colors[]' }} id="colors-{{ $tshirt->id }}">
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

                <td class="button-icon-col">
                    <button type="button" class="btn btn-secondary" onclick="getImage('{{ $tshirt->id }}')">
                        <i class="fa-solid fa-magnifying-glass"><a href="#"></a></i>
                    </button>
                </td>

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

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
</script>
<script>
    function getImage(tshirtId) {
        var selectBox = document.querySelector("#colors-" + tshirtId);
        var selectedColor = selectBox.options[selectBox.selectedIndex].value;
        var url = "{{ route('canvas.image', ['color' => ':color', 'tshirt' => ':tshirt']) }}"
            .replace(':color', selectedColor)
            .replace(':tshirt', tshirtId);
        window.location.href = url;
    }
</script>
