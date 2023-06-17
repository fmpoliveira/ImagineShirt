@extends('template.layout')

@section('titulo', '')

@section('main')
    <div class="text-center">
        <div>
            <img src="{{ $image }}" alt="Canvas Image">
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-primary ms-3 mt-3">Back</a>
    </div>

@endsection
