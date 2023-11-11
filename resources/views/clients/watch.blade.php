<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <link rel="shortcut icon" href="{{ asset('asset/clients/images/logo/icon_logo_movie.png') }}">
    <link rel="stylesheet" href="{{ asset('asset/clients/css/watch.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>{{ $title }}</title>

</head>

<body class="bg-black vh-100"> {{-- bg-black vh-100 --}}
    <div id="element-to-fullscreen" class="player vh-100 w-100 position-relative">
        <div class="vh-100">
            <video id="myVideo" class="viewer h-100 w-100" autoplay>
                <source src="{{ asset('asset/clients/video/' . $movie[0]->movieLink) }}" type="video/mp4">
            </video>
        </div>
        {{-- @csrf --}}
        <div class="position-absolute top-0 w-100" style="height: -webkit-fill-available;">
            <div class="title-movie p-3 d-flex flex-nowrap">
                <i class="back bi bi-chevron-left fs-3"></i>
                <h2>{{ $movie[0]->name }}</h2>
            </div>
            <div class="player__controls w-100 position-absolute bottom-0">
                <div class="progresss">
                    <div class="progresss__filled"></div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <button class="pause fs-1"><i class="bi bi-pause"></i></button>
                        <button class="player__button rewind fs-4" data-skip="-10"><i
                                class="bi bi-arrow-counterclockwise"></i></button>
                        <button class="player__button fast fs-4" data-skip="10"><i
                                class="bi bi-arrow-clockwise"></i></i></button>
                        <span class="time">00:00:00 / 00:00:00</span>
                        <button type="button" class="full fs-4" id="update-time-btn"><i
                                class="bi bi-fullscreen"></i></button>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="volume-on d-flex align-items-center fs-4"><i class="bi bi-volume-off-fill"></i>
                            <input type="range" name="volume" class="player__slider" min="0" max="1"
                                step="0.05" value="1">
                        </button>
                        <button type="button" class="full fs-4" id="fullscreen-btn"><i
                                class="bi bi-fullscreen"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('asset/clients/js/watch.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var currentTime = document.querySelector('#myVideo').currentTime;
            console.log(video);
            // Thời gian hiện tại của video

            $("#update-time-btn").click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('updateVideoTime') }}',
                    data: {
                        currentTime: video.currentTime,

                    },
                    success: function(data) {
                        var newTime = data.newTime;
                        video.currentTime = newTime;
                        video.play();
                        console.log('Thời gian video đã được cập nhật thành công');
                    },
                    error: function(data) {
                        console.log(data);
                        console.log('Đã xảy ra lỗi trong quá trình cập nhật thời gian video');
                    }
                });
            });
        });
    </script>

</body>
