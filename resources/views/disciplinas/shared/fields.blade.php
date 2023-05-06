@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('abreviatura') is-invalid @enderror" name="abreviatura" id="inputAbr"
        {{ $disabledStr }} value="{{ old('abreviatura', $disciplina->abreviatura) }}">
    <label for="inputAbr" class="form-label">Abreviatura</label>
    @error('abreviatura')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $disciplina->nome) }}">
    <label for="inputNome" class="form-label">Nome</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <select class="form-control @error('curso') is-invalid @enderror" name="curso" id="inputCurso"
        {{ $disabledStr }}>
        @foreach ($cursos as $curso)
            <option {{ $curso->abreviatura == old('curso', $disciplina->curso) ? 'selected' : '' }}
                value="{{ $curso->abreviatura }}">
                {{ $curso->nome }}</option>
        @endforeach
    </select>
    <label for="inputCurso" class="form-label">Curso</label>
    @error('curso')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('ano') is-invalid @enderror" name="ano" id="inputAno"
        {{ $disabledStr }} value="{{ old('ano', $disciplina->ano) }}">
    <label for="inputAno" class="form-label">Ano</label>
    @error('ano')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('semestre') is-invalid @enderror" name="semestre"
        id="inputSemestre" {{ $disabledStr }} value="{{ old('semestre', $disciplina->semestre) }}">
    <label for="inputSemestre" class="form-label">Semestre</label>
    @error('semestre')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('ECTS') is-invalid @enderror" name="ECTS" id="inputECTS"
        {{ $disabledStr }} value="{{ old('ECTS', $disciplina->ECTS) }}">
    <label for="inputECTS" class="form-label">ECTS</label>
    @error('ECTS')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('horas') is-invalid @enderror" name="horas" id="inputHoras"
        {{ $disabledStr }} value="{{ old('horas', $disciplina->horas) }}">
    <label for="inputHoras" class="form-label">Horas</label>
    @error('horas')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3">
    <div class="form-check form-switch">
        <input type="hidden" name="opcional" value="0">
        <input type="checkbox" class="form-check-input @error('opcional') is-invalid @enderror" name="opcional"
            id="inputOpcional" {{ $disabledStr }} {{ old('opcional', $disciplina->opcional) ? 'checked' : '' }}
            value="1">
        <label for="inputOpcional" class="form-check-label">Opcional</label>
        @error('opcional')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
