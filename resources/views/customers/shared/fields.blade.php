@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

{{-- <div class="mb-3 form-floating">
    <select class="form-select @error('departamento') is-invalid @enderror" name="departamento" id="inputDepartamento"
        {{ $disabledStr }}>
        @foreach ($departamentos as $departamento)
            <option {{ $departamento->abreviatura == old('departamento', $customer->departamento) ? 'selected' : '' }}
                value="{{ $departamento->abreviatura }}">
                {{ $departamento->nome }}</option>
        @endforeach
    </select>
    <label for="inputDepartamento" class="form-label">Departamento</label>
    @error('departamento')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div> --}}

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
        <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif"
            id="inputNif" {{ $disabledStr }} value="{{ old('nif', $customer->nif) }}">
        <label for="inputNif" class="form-label">NIF</label>
        @error('nif')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>



    {{-- <div class="mb-3 form-floating flex-grow-1 ms-2">
        <input type="text" class="form-control @error('extensao') is-invalid @enderror" name="extensao"
            id="inputExtensao" {{ $disabledStr }} value="{{ old('extensao', $customer->default_payment_type) }}">
        <label for="inputExtensao" class="form-label">Payment type</label>
        @error('extensao')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div> --}}

    <div class="mb-3 form-floating flex-grow-1 ms-2">
        <select class="form-select @error('paymentType') is-invalid @enderror" name="paymentType" id="inputPaymentType"
            {{ $disabledStr }}>
            <option {{ old('paymentType', $customer->default_payment_type) == 'VISA' ? 'selected' : '' }} value="VISA">VISA
            </option>
            <option {{ old('paymentType', $customer->default_payment_type) == 'MC' ? 'selected' : '' }} value="MC">MC
            </option>
            <option {{ old('paymentType', $customer->default_payment_type) == 'PAYPAL' ? 'selected' : '' }} value="PAYPAL">PAYPAL
            </option>
        </select>
        <label for="inputPaymentType" class="form-label">Default payment type</label>
        @error('paymentType')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 form-floating flex-grow-1 ms-2">
        <input type="text" class="form-control @error('paymentRef') is-invalid @enderror" name="paymentRef" id="inputPaymentRef"
            {{ $disabledStr }} value="{{ old('paymentRef', $customer->default_payment_ref) }}">
        <label for="inputPaymentRef" class="form-label">Payment ref</label>
        @error('paymentRef')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
