@extends('back.layout')
@section('title', __('Authentification'))
@section('description', __('Formulaire d\'authentification au back-office.'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-0">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-sm btn-primary" href="{{ route('bo.login') }}">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <span>{{ __('Reset Password') }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bo.password.update') }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end" for="email">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                        type="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end" for="password">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                        type="password" value="{{ old('password') }}" autocomplete="password" autofocus required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                    for="password_confirmation">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                        name="password_confirmation" type="password" value="{{ old('password_confirmation') }}"
                                        autocomplete="password_confirmation" autofocus required>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row d-none mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                    for="token">{{ __('Confirmation du mot de passe') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control disabled" id="token" name="token" type="text"
                                        value="{{ $token }}" autocomplete="token">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button class="btn btn-primary" type="submit">
                                        <span>{{ __('Envoyer') }}</span>
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