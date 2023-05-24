<?php $sizes = json_decode($sizes, true); ?>
<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Nome</th>
            <th>Tamanho</th>
            <th>Cor</th>
            <th>Quantidade</th>
            <th>Preço unitário</th>
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
                <td>
                    <select name="sizes" id="sizes">
                        @foreach ($sizes as $size)
                            <option value="{{ $size["size"] }}">{{ $size["size"] }}</option>
                        @endForeach
                    </select>
                </td>
                <td>
                    <select name="colors" id="colors">
                        @foreach ($colors as $color)
                            <option value="{{ $color->code }}">{{ $color->name }}</option>
                        @endForeach
                    </select>
                </td>
                <td>
                    <input type="number" id="quantity" name="quantity" min="1" max="100" value="1">
                </td>
                <td>
                    {{ $tshirt->unit_price }}
                </td>
                <td>
                    {{ $tshirt->unit_price * 2 }}
                    
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
            <td style="text-align: left" colspan="2">10</td>
        </tr>
    </tbody>
</table>
