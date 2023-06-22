@extends('template.layout')

@section('titulo', 'User')



@section('main')
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', [
                    'user' => $user,
                    'readonlyData' => true,
                    'showUserType' => true,
                ])

                @if ($user->user_type=='C')
                @include('customers.shared.fields', [
                    'customer' => $user->customer,
                    'readonlyData' => true
                ])
                @endif

                <div class="my-1 d-flex justify-content-end">


                        <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal"
                        data-msgLine1="Do you really want to delete the user <strong>&quot;{{ $user->name }}&quot;</strong>?"
                        data-action="{{ route('users.destroy', ['user' => $user]) }}">
                        Delete User
                        </button>


                    </form>
                    <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-secondary ms-3">
                        Edit User
                    </a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $user,
                    'allowUpload' => false,
                    'allowDelete' => false,
                ])
            </div>
        </div>
    </div>



    @include('shared.confirmationDialog', [
        'title' => 'Delete user',
        'confirmationButton' => 'Delete',
        'formMethod' => 'DELETE',
    ])
@endsection
