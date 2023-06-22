{{-- @extends('template.layout')

@section('titulo', 'Customers')



@section('main')

    <form method="GET" action="{{ route('customers.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">

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
@endsection --}}
