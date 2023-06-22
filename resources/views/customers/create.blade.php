{{-- @extends('template.layout')

@section('titulo', 'New Customer')



@section('main')
    <form id="form_customer" method="POST" action="{{ route('customers.store') }}">
        @csrf
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $customer->user, 'readonlyData' => false])
                @include('customers.shared.fields_password_inicial')
                @include('customers.shared.fields', ['customer' => $customer, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_customer">Save new
                        customer</button>
                    <a href="{{ route('customers.create', ['customer' => $customer]) }}"
                        class="btn btn-secondary ms-3">Cancel</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $customer->user,
                    'allowUpload' => true,
                ])
            </div>
        </div>
    </form>
@endsection --}}
