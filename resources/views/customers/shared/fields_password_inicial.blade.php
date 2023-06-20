<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('password_inicial') is-invalid @enderror" name="password_inicial"
        id="inputGabinete" value="{{ old('password_inicial', '123') }}">
    <label for="inputGabinete" class="form-label">Initial Password</label>
    @error('password_inicial')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>