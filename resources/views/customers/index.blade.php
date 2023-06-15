@extends('template.layout')

@section('titulo', 'Customers')

{{-- @section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Customers</li>
    </ol>
@endsection --}}

@section('main')
    {{-- <p><a class="btn btn-success" href="{{ route('customers.create') }}"><i class="fas fa-plus"></i> &nbsp;Add new customer</a></p> --}}
    {{-- <hr> --}}
    <form method="GET" action="{{ route('customers.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    {{-- <div class="flex-grow-1 mb-3 form-floating">
                        <select class="form-select" name="departamento" id="inputDepartamento">
                            <option {{ old('departamento', $filterByDepartamento) === '' ? 'selected' : '' }}
                                value="">Todos Departamentos </option>
                            @foreach ($departamentos as $departamento)
                                <option
                                    {{ old('departamento', $filterByDepartamento) == $departamento->abreviatura ? 'selected' : '' }}
                                    value="{{ $departamento->abreviatura }}">{{ $departamento->nome }}</option>
                            @endforeach
                        </select>
                        <label for="inputDepartamento" class="form-label">Departamento</label>
                    </div> --}}
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="nome" id="inputNome"
                            value="{{ old('nome', $filterByNome) }}">

                        <label for="inputNome" class="form-label">Name</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filter</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary mb-3 px-4 flex-shrink-1">Reset</a>
            </div>
        </div>
    </form>
    @include('customers.shared.table', [
        'customers' => $customers,
        'showFoto' => true,
        'showContatos' => true,
        'showDetail' => true,
        'showEdit' => true,
        'showDelete' => true,
        'showUserType' => false,
    ])
    <div>
        {{ $customers->withQueryString()->links() }}
    </div>
@endsection
