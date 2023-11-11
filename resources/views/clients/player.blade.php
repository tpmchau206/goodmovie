<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('asset/clients/css/watch.css') }}">
    <link rel="shortcut icon" href="{{asset('asset/clients/images/logo/icon_logo_movie.png')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="player">
        <video class="player_video viewer">
            <source src="{{ asset('asset/clients/video/'.$movie[0]->trailer)}}">
        </video>
        <div class="player__controls">
            <div class="progress">
                <div class="progress__filled"></div>
            </div>
            <div class="player__controlsbottom">
                <button class="player__button toggle" title="Toggle Play" id="btnPlay">
                    <i class="bx bx-play"></i></button>
                <button class="volume-on"><i class="bi bi-volume-off-fill"></i>
                    <input type="range" name="volume" class="player__slider" min="0" max="1" step="0.05" value="1">
                </button>

                <button class="player__button" data-skip="-10"><i class="bi bi-arrow-counterclockwise"></i></button>
                <button class="player__button" data-skip="10"><i class="bi bi-arrow-clockwise"></i></button>

            </div>

            <!-- <output id="timeOut">Time: 0</output> -->

        </div>
        <script src="{{ asset('asset/clients/js/watch.js') }}"></script>
        <script>
            $('.volume-on').hover(function () {
                $('.player__slider').css('width', '200px')
                $('.player__slider').css('opacity', '1')
            }, function () {
                $('.player__slider').css('width', '0px')
                $('.player__slider').css('opacity', '0')

            });
        </script>
    </div>

</body>

</html>