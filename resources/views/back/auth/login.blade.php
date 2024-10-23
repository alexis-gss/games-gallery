@extends('back.layout')

@section('title', __('bo_other_back_office_login'))
@section('description', __('bo_other_back_office_login_desc'))

@section('content')
    <h1 class="title-font-regular position-relative px-sm-5 mx-auto mb-3 w-fit p-0 py-1 text-center">
        {{ config('app.name') }}
        <span class="d-none d-sm-block angles"></span>
    </h1>
    <div class="card-auth row justify-content-center mx-auto pb-4 w-100">
        <div class="col-12 p-0">
            {{-- Show a message when an action is performed --}}
            <x-back.flash-messages />
        </div>
        <div class="col-12 p-0">
            <form class="bg-body-tertiary card p-sm-4 p-3" method="POST" action="{{ route('bo.login') }}">
                @csrf
                <div class="row mb-3">
                    <h2 class="h2 fw-bold m-0 text-center">{{ __('auth.login') }}</h2>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-8 mx-auto">
                        <label class="col-form-label" for="email">
                            <b>{{ __('auth.login_mail') }}</b>
                        </label>
                        <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email"
                            value="{{ old('email') }}" placeholder="{{ __('auth.placeholder_email') }}" autocomplete="email" autofocus>
                        <x-back.input-error inputName="email"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-8 mx-auto">
                        <label class="col-form-label" for="password">
                            <b>{{ __('auth.login_password') }}</b>
                        </label>
                        <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password"
                            placeholder="{{ __('auth.placeholder_password') }}" autocomplete="current-password">
                        <x-back.input-error inputName="password"/>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" data-bs-tooltip="tooltip" data-bs-placement="top" type="submit"
                        title="{{ __('auth.login_btn') }}">
                        {{ __('auth.login') }}
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
