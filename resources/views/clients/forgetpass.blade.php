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
            <h1 class="text-center">Quên mật khẩu</h1>
            <form action="{{ route('user.post-forgetPass') }}" method="post" id="login-form">
                <div>
                    <input type="text" name="email" placeholder="Email hoặc số điện thoại" value="{{ old('email') }}">
                    @error('email')
                        <p class="email_error error">{{ $message }}</p>
                    @enderror
                </div>

                @csrf
                <div>
                    <input type="submit" value="Gửi cho tôi email" class="btnChange btnLogin">
                </div>
                <div class="msg_time text-center" style="display: block"> s</div>
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

@section('javascript')
    <script>
        const btnChange = document.getElementById('btnChange')
        $(document).ready(function() {
            $('#login-form').on('submit', function(e) {
                e.preventDefault();

                let email = $('input[name="email"]').val();
                let actionUrl = $(this).attr('action');
                let csrfToken = $(this).find('input[name="_token"]').val();


                $('.error').text('');
                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: {
                        email: email,
                        _token: csrfToken
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('.msg').show();
                        $('.msg').text(response.msg)

                        // btnChange.onclick = function() {
                        $('.btnChange').prop('disabled', true)
                        var seconds = 60; // Thời gian đếm ngược trong giây
                        var countdown = setInterval(function() {
                            $('.msg_time').text("Gửi lại sau " +
                                seconds +
                                " giây");
                            seconds--;
                            if (seconds < 0) {
                                clearInterval(countdown);
                                $('.msg_time').text("");
                                $('.btnChange').prop('disabled', false)
                            }
                        }, 1000); // Mỗi giây
                        // }

                    },
                    error: function(error, e) {
                        let responseJSON = error.responseJSON.errors;
                        $('.msg').show();
                        if (Object.keys(responseJSON.length > 0)) {
                            for (let key in responseJSON) {
                                $('.error').text(responseJSON[key]);
                            }
                        }

                    }
                });
            });
        });
    </script>
@endsection
