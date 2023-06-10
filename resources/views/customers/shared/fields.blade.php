@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp


<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="inputAddress"
        {{ $disabledStr }} value="{{ old('address', $customer->address) }}">
    <label for="inputAddress" class="form-label">Address</label>
    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="d-flex justify-content-between">
    <div class="mb-3 form-floating flex-grow-1">
        <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" id="inputNif" {{ $disabledStr }} value="{{ old('nif', $customer->nif) }}">
        <label for="inputNif" class="form-label">NIF</label>
        @error('nif')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>


    <div class="mb-3 form-floating flex-grow-1 ms-2">
        <select class="form-select @error('default_payment_type') is-invalid @enderror" name="default_payment_type" id="paymentType" {{ $disabledStr }}>
            <option {{ old('default_payment_type', $customer->default_payment_type) == 'VISA' ? 'selected' : '' }} value="VISA">VISA
            </option>
            <option {{ old('default_payment_type', $customer->default_payment_type) == 'MC' ? 'selected' : '' }} value="MC">MC
            </option>
            <option {{ old('default_payment_type', $customer->default_payment_type) == 'PAYPAL' ? 'selected' : '' }} value="PAYPAL">PAYPAL
            </option>
        </select>
        <label for="paymentType" class="form-label">Default payment type</label>
        @error('default_payment_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 form-floating flex-grow-1 ms-2">
        <input type="text" class="form-control @error('default_payment_ref') is-invalid @enderror" name="default_payment_ref" id="paymentRef" {{ $disabledStr }} value="{{ old('default_payment_ref', $customer->default_payment_ref) }}">
        <label for="paymentRef" class="form-label">Payment ref</label>
        @error('default_payment_ref')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
