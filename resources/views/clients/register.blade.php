@extends('layouts.clientLogin')

@section('title')
    {{$title}}
@endsection

@section('content')
<div class="position-relative vh-100 vw-100 p-3" style="box-sizing: border-box;">
    <div class="logo position-absolute z-3">
        <a href="#">
            <img width="200" src="{{ asset('asset/clients/images/logo/logo_movie.png') }}" alt="">
        </a>
    </div>
    <div class="form-login">
        <h1 class="text-center">Đăng ký</h1>
        <form action="{{ route('user.post-register') }}" method="post" id="register-form">
            <div>
                <input type="text" name="username" placeholder="Tên người dùng" value="{{old('username')}}" autocomplete="off">
                @error('username')
                <p class="username_error error">{{$message}}</p>

                @enderror
            </div>
            <div>
                <input type="text" name="email" placeholder="Email hoặc số điện thoại" value="{{old('email')}}" autocomplete="off">
                @error('email')
                <p class="email_error error" >{{$message}}</p>
                    
                @enderror
            </div>
            <div>
                <input type="password" name="password" placeholder="Mật Khẩu" autocomplete="off">
                @error('password')
                <p class="password_error error">{{$message}}</p>
                @enderror
            </div>
            <div>
                <input type="password" name="password_confirmation" placeholder="Nhập Lại Mật Khẩu" autocomplete="off">
                @error('password_confirmation')
                <p class="password_confirmation_error error">{{$message}}</p>
                @enderror
            </div>
            @csrf
            <div>
                <input type="submit" value="Đăng Ký" class="btnLogin">
            </div>
            <div class="d-flex">
                <input type="checkbox" class="checkbox">
                <span>Ghi nhớ tôi</span>
            </div>
            @if (session('msg'))
            <p class="error msg text-center" style="">{{session('msg')}}</p>
                
            @endif
        </form>
        <div>
            <p class="text-center">
                Bạn đã có tài khoản? <a href="{{route('user.login')}}">Đăng nhập</a>
            </p>
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
