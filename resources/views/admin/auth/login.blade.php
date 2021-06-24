@extends('admin.auth.layouts.app')

@section('content')
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ asset('admin/assets/media/bg/login-bg.jpg') }});">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="{{ route('admin.index') }}">
                                <img src="{{ asset('admin/assets/media/logos/logo.png') }}">
                            </a>
                        </div>
                        <div class="kt-login__signin">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title"></h3>
                            </div>
                            {{ html()->form('POST', route('admin.login'))->class(['kt-form'])->open() }}
                                <div class="input-group">
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="{{ __('text.email') }}" name="email" id="email" value="{{ old('email') }}" autocomplete="email" autofocus required>

                                    @error('email') <x-alert type="error" :message="$message"/> @enderror
                                </div>

                                <div class="input-group">
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="{{ __('text.common.password') }}" name="password" id="password" autocomplete="current-password" required>

                                    @error('password') <x-alert type="error" :message="$message"/> @enderror
                                </div>

                                <div class="row kt-login__extra">
                                    <div class="col">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('text.remember_me') }}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="kt-login__actions">
                                    <button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">{{ __('text.login') }}</button>
                                </div>
                            {{ html()->form()->close() }}
                        </div>

                        <div class="kt-login__account">
                            <span class="kt-login__account-msg"></span>
                            <a href="{{ env('APP_WEBSITE') }}" target="_blank" id="kt_login_signup" class="kt-login__account-link">{{ env('APP_NAME') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
