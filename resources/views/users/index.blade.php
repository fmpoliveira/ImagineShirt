@extends('template.layout')

@section('titulo', 'Users')

{{-- @section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Customers</li>
    </ol>
@endsection --}}

@section('main')
    <p><a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-plus"></i> &nbsp;Add new user</a></p>
    <hr>
    <form method="GET" action="{{ route('users.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">

                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 mb-3 form-floating">
                        <select class="form-select" name="user_type" id="inputUser_type">
                            <option {{ old('user_type', $filterByUser_type) === '' ? 'selected' : '' }} value="">All users </option>
                            <option {{ old('user_type', $filterByUser_type) === 'A' ? 'selected' : '' }} value="A">Administrators </option>
                            <option {{ old('user_type', $filterByUser_type) === 'E' ? 'selected' : '' }} value="E">Employees </option>
                            <option {{ old('user_type', $filterByUser_type) === 'C' ? 'selected' : '' }} value="C">Customers </option>
                        </select>
                        <label for="inputUser_type" class="form-label">User Type</label>
                    </div>
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
                <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Reset</a>
            </div>
        </div>
    </form>
    @include('users.shared.table', [
        'users' => $users,
        'showFoto' => true,
        'showContatos' => true,
        'showDetail' => true,
        'showEdit' => true,
        'showDelete' => true,
    ])
    <div>
        {{ $users->withQueryString()->links() }}
    </div>
@endsection
