@extends('template.layout')

@section('titulo', '')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-light">{{ __('Register') }}</div>

                    <div class="card-body">
                        {{-- "novalidate" - When publishing the application, we should remove this attribute. --}}
                        <form method="POST" action="{{ route('register') }}" novalidate>
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            {{-- NIF Client --}}
                            <div class="row mb-3">
                                <label for="nif" class="col-md-4 col-form-label text-md-end">NIF</label>
                                <div class="col-md-6">
                                    <input id="nif" type="text"
                                        class="form-control @error('nif') is-invalid @enderror" name="nif"
                                        value="{{ old('nif') }}">
                                    @error('nif')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Default Payment Type --}}
                            <div class="row mb-3">
                                <label for="default_payment_type" class="col-md-4 col-form-label text-md-end">Payment
                                    Type</label>
                                <div class="col-md-6">
                                    <select id="default_payment_type"
                                        class="form-select @error('default_payment_type') is-invalid @enderror"
                                        name="default_payment_type" required>
                                        <option value="MC"
                                            {{ old('default_payment_type', 'MC') == 'MC' ? 'selected' : '' }}>MC
                                        </option>
                                        <option value="PAYPAL"
                                            {{ old('default_payment_type', 'PAYPAL') == 'PAYPAL' ? 'selected' : '' }}>
                                            PAYPAL
                                        </option>
                                        <option value="VISA"
                                            {{ old('default_payment_type', 'VISA') == 'VISA' ? 'selected' : '' }}>VISA
                                        </option>
                                        <option value=""
                                            {{ old('default_payment_type', '') == '' ? 'selected' : '' }}>Not specified
                                        </option>
                                    </select>
                                    @error('default_payment_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Payment ref --}}
                            <div class="row mb-3">
                                <label for="default_payment_ref"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Payment ref') }}</label>

                                <div class="col-md-6">
                                    <input id="default_payment_ref" type="text"
                                        class="form-control @error('default_payment_ref') is-invalid @enderror" name="default_payment_ref"
                                        value="{{ old('default_payment_ref') }}" autocomplete="default_payment_ref" autofocus>

                                    @error('default_payment_ref')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
