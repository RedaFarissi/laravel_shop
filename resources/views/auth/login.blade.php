@extends('layout')

@section('title','MyShop')

@section('head')
    <link rel="stylesheet" href="{{ url('css/auth/login.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <input
                            type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="email" placeholder="email"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <input
                            type="password" name="password" id="password"
                            required autocomplete="current-password" placeholder="password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="d-flex align-items-center" style="height:30px; margin-top:-20px;margin-bottom:10px">
                        <span class="me-2 mb-1">{{ __('Remember me') }}</span>
                        <input id="remember_me" type="checkbox" checked name="remember">
                    </div>

                    <button type="submit" class="opacity rose">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                    <a href="{{ route('register') }}">REGISTER</a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">FORGOT PASSWORD</a>
                    @endif
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
    </div>
@endsection
