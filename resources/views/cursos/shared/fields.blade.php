@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control" name="abreviatura" id="inputAbr" {{ $disabledStr }}
        value="{{ $curso->abreviatura }}">
    <label for="inputAbr" class="form-label">Abreviatura</label>
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control" name="nome" id="inputNome" {{ $disabledStr }}
        value="{{ $curso->nome }}">
    <label for="inputNome" class="form-label">Nome</label>
</div>
<div class="mb-3 form-floating">
    <select class="form-control" name="tipo" id="inputTipo" {{ $disabledStr }}>
        <option {{ $curso->tipo == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
        <option {{ $curso->tipo == 'Mestrado' ? 'selected' : '' }}>Mestrado</option>
        <option {{ $curso->tipo == 'Curso Técnico Superior Profissional' ? 'selected' : '' }}>Curso Técnico
            Superior Profissional</option>
    </select>
    <label for="inputTipo" class="form-label">Tipo de Curso</label>
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control" name="semestres" id="inputSemestres" {{ $disabledStr }}
        value="{{ $curso->semestres }}">
    <label for="inputSemestres" class="form-label">Semestres</label>
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control" name="ECTS" id="inputECTS" {{ $disabledStr }}
        value="{{ $curso->ECTS }}">
    <label for="inputECTS" class="form-label">ECTS</label>
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control" name="vagas" id="inputVagas" {{ $disabledStr }}
        value="{{ $curso->vagas }}">
    <label for="inputVagas" class="form-label">Vagas</label>
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control" name="contato" id="inputContato" {{ $disabledStr }}
        value="{{ $curso->contato }}">
    <label for="inputContato" class="form-label">Contato</label>
</div>
<div class="mb-3 form-floating">
    <textarea class="height-lg form-control" name="objetivos" id="inputObjetivos" {{ $disabledStr }} rows=10>{{ $curso->objetivos }}</textarea>
    <label for="inputObjetivos" class="form-label">Objetivos</label>
</div>
