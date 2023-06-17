@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" id="inputid"
        {{ $disabledStr }} value="{{ old('id', $order->id) }}">
    <label for="inputid" class="form-label">ID</label>
    @error('id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" id="inputstatus"
        {{ $disabledStr }} value="{{ old('status', $order->status) }}">
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
        <input type="text" class="form-control @error('payment_type') is-invalid @enderror" name="payment_type"
            id="inputpayment_type" {{ $disabledStr }} value="{{ old('payment_type', $order->payment_type) }}">
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
