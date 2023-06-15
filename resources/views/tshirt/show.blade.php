@extends('template.layout')

@section('titulo', 'Tshirt')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item"><a href="{{ route('tshirts.admin') }}">Tshirt Manager</a></li>
        <li class="breadcrumb-item"><strong>{{ $tshirt->name }}</strong></li>
        <li class="breadcrumb-item active">View</li>
    </ol>
@endsection

@section('main')

    <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
        <div class="flex-grow-1 pe-2">
            @include('tshirt.shared.fields', [
                'tshirt' => $tshirt,
                'readonlyData' => true,
                'showCategory' => true,
            ])
            <div class="my-1 d-flex justify-content-end">
                <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#confirmationModal"
                    data-msgLine1="Do you really want to delete the tshirt <strong>&quot;{{ $tshirt->name }}&quot;</strong>?"
                    data-action="{{ route('tshirts.destroy', ['tshirt' => $tshirt]) }}">
                    Delete Tshirt
                </button>
                <a href="{{ route('tshirts.edit', ['tshirt' => $tshirt]) }}" class="btn btn-secondary ms-3">
                    Change Tshirt
                </a>
                <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">Back</a>
            </div>
        </div>
        <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
            style="min-width:260px; max-width:260px;">
            <img src="{{ asset('storage/tshirt_images/' . $tshirt->image_url) }}" alt="Avatar"
                class="img-thumbnail bg-image">
        </div>
    </div>

    @include('shared.confirmationDialog', [
        'title' => 'Delete tshirt',
        'confirmationButton' => 'Delete',
        'formMethod' => 'DELETE',
    ])


@endsection
