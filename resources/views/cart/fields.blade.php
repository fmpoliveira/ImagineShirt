@php
    $disabledStr = '';
@endphp
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
        {{ $disabledStr }} value="{{ old('name', $login->name) }}">
    <label for="inputName" class="form-label">Name</label>
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" id="inputNIF"
        {{ $disabledStr }} value="{{ old('nif', $userDetails->nif) }}">
    <label for="inputNIF" class="form-label">NIF</label>
    @error('nif')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <select class="form-select @error('payment') is-invalid @enderror" name="payment" id="inputType"
        {{ $disabledStr }}>
        @foreach ($paymentTypes as $key => $paymentType)
            <option value="{{ $key }}" @if ($key === $userDetails->default_payment_type) selected @endif>
                {{ $paymentType }}</option>
        @endForeach
    </select>

    <label for="inputType" class="form-label">Payment type</label>
    @error('payment')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('reference') is-invalid @enderror" name="reference" id="inputReference"
        {{ $disabledStr }} value="{{ old('reference', $userDetails->default_payment_ref ?? '') }}">
    <label for="inputreference" class="form-label">Payment reference</label>
    @error('reference')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="inputAddress"
        {{ $disabledStr }} value="{{ old('address', $userDetails->address ?? '') }}">
    <label for="inputAddress" class="form-label">Destination address</label>
    @error('address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <textarea class="form-control height-lg @error('notes') is-invalid @enderror" name="notes" id="inputNotes"
        {{ $disabledStr }}>
        {{ old('notes', $userDetails->notes) }}
    </textarea>
    <label for="inputNotes" class="form-label">Notes</label>
    @error('notes')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
