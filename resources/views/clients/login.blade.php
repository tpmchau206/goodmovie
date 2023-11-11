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
            <h1 class="text-center mb-3">Đăng nhập</h1>
            <form action="{{ route('user.post-login') }}" method="post" id="login-form">
                <div class="mb-3">
                    <input type="text" name="email" placeholder="Email hoặc số điện thoại" value="{{ old('email') }}">
                    @error('email')
                        <p class="email_error error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Mật Khẩu">
                    @error('password')
                        <p class="password_error error">{{ $message }}</p>
                    @enderror
                </div>
                @csrf
                <div class="mb-3">
                    <input type="submit" value="Đăng Nhập" class="btnLogin">
                </div>
                <div class="d-flex mb-3 justify-content-between">
                    <div class="d-flex">
                        <input type="checkbox" class="checkbox">
                        <span>Ghi nhớ tôi</span>
                    </div>
                    <a href="{{ route('user.get-forgetPass') }}">Quên mật khẩu?</a>

                </div>
                @if (session('msg'))
                    <p class="error msg text-center" style=" ">{{ session('msg') }}</p>
                @endif
            </form>

            <div>
                <p class="text-center">
                    Bạn chưa có tài khoản? <a href="{{ route('user.register') }}">Đăng ký ngay</a>
                </p>
            </div>
            <hr>
            <div class="text-center">
                <a href="{{ route('user.loginGoogle') }}" class="text-decoration-none">
                    <div class="border rounded-2 d-flex align-items-center btn-gg">
                        <img class="" src="{{ asset('asset/clients/images/logo/7611770.png') }}" width="60"
                            alt="">
                        <span class="ms-5 fw-semibold text-light">Đăng nhập với Google</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        // $(document).ready(function () {
        //     $('#login-form').on('submit',function(e){
        //         e.preventDefault();

        //         let loginEmail = $('input[name="login_email"]').val().trim();
        //         let loginPassword = $('input[name="login_password"]').val().trim();
        //         let actionUrl = $(this).attr('action');
        //         let csrfToken = $(this).find('input[name="_token"]').val();
        //         $('.error').text('');
        //         // console.log(actionUrl)
        //         $.ajax({
        //             url:actionUrl,
        //             type:'POST',
        //             data:{
        //                 login_email:loginEmail,
        //                 login_password:loginPassword,
        //                 _token:csrfToken
        //             },
        //             dataType:'json',
        //             success: function(response){
        //                 if(response.success){
        //                     window.location.href = '/home'

        //                 }
        //             },
        //             error:function(error,e){
        //                 console.log(error);
        //                 $('.msg').show();
        //                 let responseJSON = error.responseJSON.errors;
        //                 if(Object.keys(responseJSON.length>0)){
        //                     $('.msg').text(responseJSON.msg)
        //                     for (let key in responseJSON) {
        //                         $('.msg').text(responseJSON.msg)

        //                         $('.'+key+'_error').text(responseJSON[key][0]);
        //                     }
        //                 }
        //             }
        //         });
        //     });
        // });
    </script>
@endsection
