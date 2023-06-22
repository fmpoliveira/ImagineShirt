@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <select class="form-select @error('status') is-invalid @enderror" name="status" id="inputstatus" {{ $disabledStr }}>
        @if (isset($user))
            @if ($user->user_type === 'A')
                <option {{ $order->status == 'closed' ? 'selected' : '' }}>Closed</option>
                <option {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            @elseif($user->user_type === 'E')
                @if ($order->status == 'pending')
                    <option {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                @endif
                @if ($order->status == 'paid')
                    <option {{ $order->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    <option {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                @endif
            @endif
        @else
            <option {{ $order->status == 'closed' ? 'selected' : '' }}>Closed</option>
            <option {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
            <option {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
        @endif
    </select>


    <label for="inputstatus" class="form-label">Status</label>
    @error('status')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" id="inputdate"
        {{ $disabledStr }} value="{{ old('date', $order->date) }}">
    <label for="inputdate" class="form-label">Date</label>
    @error('date')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" id="inputnif"
        {{ $disabledStr }} value="{{ old('nif', $order->nif) }}">
    <label for="inputnif" class="form-label">NIF</label>
    @error('nif')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="inputaddress"
        {{ $disabledStr }} value="{{ old('address', $order->address) }}">
    <label for="inputaddress" class="form-label">Address</label>
    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="d-flex justify-content-between">
    <div class="mb-3 form-floating flex-grow-1">
        {{-- <input type="text" class="form-control @error('payment_type') is-invalid @enderror" name="payment_type"
            id="inputpayment_type" {{ $disabledStr }} value="{{ old('payment_type', $order->payment_type) }}"> --}}
        <select class="form-select @error('payment_type') is-invalid @enderror" name="payment_type"
            id="inputpayment_type" {{ $disabledStr }}>
            <option value='VISA' {{ $order->payment_type == 'VISA' ? 'selected' : '' }}>Visa</option>
            <option value='MC' {{ $order->payment_type == 'MC' ? 'selected' : '' }}>Master Card</option>
            <option value='PAYPAL' {{ $order->payment_type == 'PAYPAL' ? 'selected' : '' }}>Paypal</option>
        </select>
        <label for="inputpayment_type" class="form-label">Payment Type</label>
        @error('payment_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3 form-floating flex-grow-1">
        <input type="text" class="form-control @error('payment_ref') is-invalid @enderror" name="payment_ref"
            id="inputpayment_ref" {{ $disabledStr }} value="{{ old('payment_ref', $order->payment_ref) }}">
        <label for="inputpayment_ref" class="form-label">Payment Reference</label>
        @error('payment_ref')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
