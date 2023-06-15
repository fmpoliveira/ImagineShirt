@extends('template.layout')

@section('titulo', 'Category')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category Manager</a></li>
        <li class="breadcrumb-item"><strong>{{ $category->name }}</strong></li>
        <li class="breadcrumb-item active">View</li>
    </ol>
@endsection

@section('main')
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('categories.shared.fields', ['category' => $category, 'readonlyData' => true])
                <div class="my-1 d-flex justify-content-end">
                    <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal"
                        data-msgLine1="Do you really want to delete the category <strong>&quot;{{ $category->name }}&quot;</strong>?"
                        data-action="{{ route('categories.destroy', ['category' => $category]) }}">
                        Delete Category
                    </button>
                    <a href="{{ route('categories.edit', ['category' => $category]) }}" class="btn btn-secondary ms-3">
                        Change Category
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary ms-3">Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">

        <h3>Tshirts with {{ $category->name }} category</h3>
        @include('tshirt.shared.table', [
            'tshirts' => $category->tshirtImages,
        ])
    </div>

    @include('shared.confirmationDialog', [
        'title' => 'Delete Category',
        'confirmationButton' => 'Delete',
        'formMethod' => 'DELETE',
    ])


@endsection
