@extends('template.layout')
@section('subtitulo')
    <p>Tshirt Stamp Store Web Application</p>
@endsection
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-light">Homepage</div>
                    <div class="card-body">
                        @auth
                            <p>{{ Auth::user()->name }}</p>
                        @else
                            <p>Welcome!</p>
                            <p>You can login
                                <a href="{{ route('login') }}">here</a>.
                            </p>
                        @endauth
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
