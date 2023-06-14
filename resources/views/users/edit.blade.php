@extends('template.layout')

@section('titulo', 'Edit User')

{{-- @section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
        <li class="breadcrumb-item"><strong>{{ $customer->user->name }}</strong></li>
        <li class="breadcrumb-item active">Change</li>
    </ol>
@endsection --}}

@section('main')
    <form id="form_user" novalidate class="needs-validation" method="POST"
        action="{{ route('users.update', ['user' => $user]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $user, 'readonlyData' => false, 'showUserType' => true,])

                @if ($user->user_type=='C')
                @include('customers.shared.fields', [
                    'customer' => $user->customer,
                    'readonlyData' => false,

                ])
                @endif

                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_user">Saves Changes</button>
                    <a href="{{ route('users.show', ['user' => $user]) }}" class="btn btn-secondary ms-3">Cancel</a>
                </div>
            </div>

            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $user,
                    'allowUpload' => true,
                    'allowDelete' => true,
                ])
            </div>

        </div>
    </form>
    {{-- <form id="form_delete_photo"
        action="{{ route('users.foto.destroy', ['user' => $user]) }}"
        method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form> --}}


    {{-- @include('shared.confirmationDialog', [
        'title' => 'Quer realmente apagar a foto?',
        'msgLine1' => 'As alterações efetuadas ao dados do docente vão ser perdidas!',
        'msgLine2' => 'Clique no botão "Apagar" para confirmar a operação.',
        'confirmationButton' => 'Apagar',
        'formActionRoute' => 'docentes.foto.destroy',
        'formActionRouteParameters' => ['docente' => $docente],
        'formMethod' => 'DELETE',
    ]) --}}

@endsection
