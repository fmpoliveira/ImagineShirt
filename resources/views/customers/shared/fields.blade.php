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

<div class="d-flex justify-content-between">
    <div class="mb-3 form-floating flex-grow-1">
        <input type="text" class="form-control @error('gabinete') is-invalid @enderror" name="gabinete"
            id="inputGabinete" {{ $disabledStr }} value="{{ old('gabinete', $customer->gabinete) }}">
        <label for="inputGabinete" class="form-label">Gabinete</label>
        @error('gabinete')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 form-floating flex-grow-1 ms-2">
        <input type="text" class="form-control @error('extensao') is-invalid @enderror" name="extensao"
            id="inputExtensao" {{ $disabledStr }} value="{{ old('extensao', $customer->extensao) }}">
        <label for="inputExtensao" class="form-label">Extensão</label>
        @error('extensao')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 form-floating flex-grow-1 ms-2">
        <input type="text" class="form-control @error('cacifo') is-invalid @enderror" name="cacifo" id="inputCacifo"
            {{ $disabledStr }} value="{{ old('cacifo', $customer->cacifo) }}">
        <label for="inputCacifo" class="form-label">Cacifo</label>
        @error('cacifo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
