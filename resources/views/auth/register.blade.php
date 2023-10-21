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
                <h1 class="opacity">REGISTER</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <input
                            type="text" name="name" value="{{ old('name') }}" required
                            placeholder="username" autofocus autocomplete="name"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <input
                            type="email" name="email" value="{{ old('email') }}" required
                            placeholder="your email" autocomplete="username"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <input
                            type="password" name="password" id="password" placeholder="password"
                            required autocomplete="new-password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div>
                        <input
                            type="password" name="password_confirmation" id="password_confirmation"
                            required autocomplete="new-password" placeholder="password confirmation"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>


                    <div class=" flex items-center justify-end" style="margin-top:-23px;">
                        <a href="{{ route('login') }}" class="already_register underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500d d-block mb-2">
                            {{ __('Already registered?') }}
                        </a>
                        <x-primary-button class="ml-4 border-0 teblack">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class="circle circle-two"></div>
        </div>
    </div>

@endsection
