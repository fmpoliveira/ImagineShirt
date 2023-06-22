<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $order->id }}</title>
    @vite('resources/sass/app.scss')
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


</head>

<body>

    <div class="container">
        <div class="row">
            {{-- <div class="col-md-6"> --}}
            <img src="{{ asset('/img/plain_white.png') }}" alt="Company Logo" style="width: 100px; height: 100px;">
            <h3 class="mt-3">ImagineShirt</h3>
            <hr>
            <h6>Buyer Information:</h6>
            <p>Name: {{ $order->customer->user->name }}</p>
            <p>NIF: {{ $order->nif }}</p>
            <p>Date: {{ $order->date }}</p>
            <hr>
            {{-- </div> --}}

            {{-- <div class="col-md-6"> --}}
            <!-- Purchase Details -->
            <h6>Purchase Details:</h6>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Size</th>
                        <th scope="col">Color</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $orderItem)
                        <tr>
                            <td>{{ $orderItem->tshirtImage->name }}</td>
                            <td>{{ $orderItem->size }}</td>
                            <td>{{ $orderItem->color->name }}</td>
                            <td>{{ $orderItem->qty }}</td>
                            <td>{{ number_format($orderItem->unit_price, 2) }}€</td>
                            <td>{{ $orderItem->qty * number_format($orderItem->unit_price, 2) }} €</td>

                        </tr>
                    @endforeach
                    <br>
                    <tr>
                        <td style="text-align: right" colspan="5">
                            <strong>Total:&nbsp;&nbsp;</strong>
                        </td>
                        <td style="text-align: left" colspan="2">{{ number_format($order->total_price, 2) }}€
                        </td>
                    </tr>
                </tbody>

            </table>
            {{-- </div> --}}
        </div>
    </div>

</body>

</html>
