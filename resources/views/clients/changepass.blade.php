@extends('layouts.clientLogin')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="position-relative vh-100 vw-100 p-3" style="box-sizing: border-box;">
        <div class="logo position-absolute z-3">
            <a href="{{ route('index.home') }}">
                <img width="200" src="{{ asset('asset/clients/images/logo/logo_movie.png') }}" alt="">
            </a>
        </div>

        <div class="form-login">
            <h1 class="text-center">Đổi mật khẩu</h1>
            <form action="{{ route('user.post-changePass') }}" method="post" id="login-form">
                <div class="text-center">Đổi mật khẩu cho {{ $user->email }}</div>
                <div>
                    <input type="password" name="password" placeholder="Mật Khẩu" autocomplete="off">
                    @error('password')
                        <p class="password_error error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="password" name="password_confirmation" placeholder="Nhập Lại Mật Khẩu" autocomplete="off">
                    @error('password_confirmation')
                        <p class="password_confirmation_error error">{{ $message }}</p>
                    @enderror
                </div>

                @csrf
                <div>
                    <input type="submit" value="Đổi mật khẩu" class="btnLogin">
                </div>
                {{-- @if (session('msg')) --}}
                <p class="error msg text-center" style=" "></p>
                {{-- @endif --}}
            </form>
            <div>
                <p class="text-center">
                    <a href="{{ route('user.login') }}">Đăng nhập</a>
                </p>
            </div>
        </div>
    </div>
@endsection
