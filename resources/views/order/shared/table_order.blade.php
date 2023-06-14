<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            {{-- <th>Size</th>
            <th>Color</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Sub-total</th>
            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif --}}
        </tr>
    </thead>

    <tbody>
        @foreach ($orders as $order)
            @if ($order->status == 'pending')
                <tr>
                    <td>{{ $order->id }}</td>
                    {{-- <td>
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
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('tshirts.show', ['tshirt' => $tshirt]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('cart.remove', ['tshirt' => $tshirt]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td> --}}
                </tr>
            @endif
        @endforeach
    </tbody>
</table>

<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            {{-- <th>Size</th>
            <th>Color</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Sub-total</th>
            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif --}}
        </tr>
    </thead>

    <tbody>
        @foreach ($orders as $order)
            @if ($order->status != 'pending')
                <tr>
                    <td>{{ $order->id }}</td>
                    {{-- <td>
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
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('tshirts.show', ['tshirt' => $tshirt]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('cart.remove', ['tshirt' => $tshirt]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td> --}}
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
