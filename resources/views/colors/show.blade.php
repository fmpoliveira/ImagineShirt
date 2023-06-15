@extends('template.layout')

@section('titulo', 'Color')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item"><a href="{{ route('colors.index') }}">Color Manager</a></li>
        <li class="breadcrumb-item"><strong>{{ $color->name }}</strong></li>
        <li class="breadcrumb-item active">View</li>
    </ol>
@endsection

@section('main')

    <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
        <div class="flex-grow-1 pe-2">
            @include('colors.shared.fields', ['color' => $color, 'readonlyData' => true])
            <div class="my-1 d-flex justify-content-end">
                <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#confirmationModal"
                    data-msgLine1="Do you really want to delete the color <strong>&quot;{{ $color->name }}&quot;</strong>?"
                    data-action="{{-- {{ route('colors.destroy', ['color' => $color]) }} --}} ">
                    Delete Color
                </button>
                <a href="{{ route('colors.edit', ['color' => $color]) }}" class="btn btn-secondary ms-3">
                    Change Color
                </a>
                <a href="{{ route('colors.index') }}" class="btn btn-primary ms-3">Back</a>
            </div>
        </div>
    </div>


    @include('shared.confirmationDialog', [
        'title' => 'Delete Color',
        'confirmationButton' => 'Delete',
        'formMethod' => 'DELETE',
    ])


@endsection
