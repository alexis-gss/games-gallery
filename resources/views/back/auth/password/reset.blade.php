@extends('back.layout')

@section('title', __('Authentification'))
@section('description', __('Formulaire d\'authentification au back-office.'))

@section('content')
    <h1 class="title-font-regular position-relative px-sm-5 mx-auto mb-3 w-fit p-0 py-1 text-center">
        {{ config('app.name') }}
        <span class="d-none d-sm-block angles"></span>
    </h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-0">
                <div class="bg-body-tertiary card p-sm-4 p-3">
                    <div class="row justify-content-center align-items-center mb-3">
                        <a class="btn btn-sm btn-primary w-fit" href="{{ route('bo.login') }}">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <h2 class="h2 fw-bold m-0 w-fit text-center">{{ __('auth.reset_password') }}</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bo.password.update') }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end" for="email">{{ __('auth.login_mail') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                        type="email" value="{{ old('email') }}" placeholder="{{ __('auth.placeholder_email') }}"
                                        autocomplete="email" autofocus required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end" for="password">{{ __('auth.login_password') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                        type="password" value="{{ old('password') }}" placeholder="{{ __('auth.placeholder_password') }}"
                                        autocomplete="password" autofocus required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end"
                                    for="password_confirmation">{{ __('auth.login_confirm_password') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                        name="password_confirmation" type="password" value="{{ old('password_confirmation') }}"
                                        placeholder="{{ __('auth.placeholder_confirm_password') }}" autocomplete="password_confirmation"
                                        autofocus required>
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
