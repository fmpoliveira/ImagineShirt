<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Size</th>
            <th>Color</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Sub-total</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($tshirts as $tshirt)
            <tr>
                <td>{{ $tshirt->name }}</td>
                <td>{{ $tshirt->size }}</td>
                <td>{{ $tshirt->colorName }}</td>
                <td>{{ $tshirt->qty }}</td>
                <td>{{ number_format($tshirt->price, 2) }}€</td>
                <td id="sub_total">{{ number_format($tshirt->sub_total, 2) }}€</td>
            </tr>
        @endforeach
        <tr>
            <td style="text-align: right" colspan="5"><b>TOTAL</b></td>
            <td style="text-align: left" colspan="2">{{ number_format($total, 2) }}€</td>
        </tr>
    </tbody>
</table>

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
