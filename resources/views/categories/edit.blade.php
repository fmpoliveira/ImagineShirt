@extends('template.layout')

@section('titulo', 'Change Category ')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category Manager</a></li>
        <li class="breadcrumb-item"><strong>{{ $category->name }}</strong></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('main')
    <form id="form_category" novalidate class="needs-validation" method="POST"
        action="{{ route('categories.update', ['category' => $category]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="category_id" value="{{ $category->id }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('categories.shared.fields', ['category' => $category, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_category">Save Changes</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-3">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection
