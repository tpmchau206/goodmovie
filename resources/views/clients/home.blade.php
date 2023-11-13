@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="video d-flex justify-content-center">
        <video class="videoPlay" autoplay>
            <source src="{{ asset('asset/clients/video/' . $moviesTrailer->trailer) }}" type="video/mp4">
        </video>
        <div class="position-absolute vw-100 vh-100 overflow-hidden">
            <img class="poster" src="{{ asset('asset/clients/images/' . $moviesTrailer->poster) }}" alt="">
        </div>
        <script>
            var poster = {!! json_encode($moviesTrailer->poster) !!};
        </script>
        <div class="bottom-bar"></div>
    </div>
    <div class="bill-board">
        <div class="container1 d-flex">
            <div class="left d-flex flex-column justify-content-end ">
                <span class="title">{{ $moviesTrailer->name }}</span>
                <span class="content"> {{ $moviesTrailer->content }}</span>
                <div class="button-content d-flex align-items-center">
                    <a href="/watch/movie/{{ $moviesTrailer->id }}" class="button-play d-flex align-items-center">
                        <i class='bx bx-play'></i>
                        Phát
                    </a>
                    <a class="popup-click-main button-info d-flex align-items-center"
                        data-custom-attribute="{{ $moviesTrailer->id }}">
                        <i class="bx bx-info-circle"></i>
                        Thông tin khác
                    </a>
                </div>
            </div>
            <div class="right">
                <div class="re-mu d-flex">
                    <button class="button-refresh" type="button"><i class="bx bx-play"></i></button>
                    <button class="button-mute" type="button"><i class="bx bx-volume-full"></i></button>
                </div>
                <span>{{ $moviesTrailer->age }}</span>
            </div>
        </div>
    </div>
    <div class="movies-series">
        <div class="movies-list">
            <h2 class="title-content">
                <a href="#" class="skeleton text-light">Top 10 Movie hay tại Việt Nam</a>
            </h2>
            <div class="top-movie">
                @php
                    $i = 0;
                @endphp
                @while ($i <= 9)
                    <div class="top-rank skeleton">
                        {{-- <form action="{{ url('popups')}}" method="post"> --}}
                        <a href="{{ route('popup', $dataRankMovie['view'][$i]->id) }}" type="btn" class="popup-click"
                            data-custom-attribute="{{ $dataRankMovie['view'][$i]->id }}">
                            <div class="boxart-size">
                                {!! $dataRankMovie['top'][$i] !!}
                                <img src="{{ asset('asset/clients/images/' . $dataRankMovie['view'][$i]->image) }}"
                                    alt="">
                            </div>
                        </a>
                        {{-- </form> --}}
                    </div>
                    @php
                        $i++;
                    @endphp
                @endwhile
            </div>
        </div>

        <!-- --------------------------------------------------------------------------------->

        <div class="movies-list">
            <h2 class="title-content">
                <a class="skeleton text-light" href="#">Hiện đang thịnh hành</a>
            </h2>
            <div class="top-movie">
                @foreach ($popularMovie as $popular)
                    <div class="movie skeleton">
                        <a href="{{ route('popup', $popular->id) }}" type="btn" class="popup-click"
                            data-custom-attribute="{{ $popular->id }}" data-toggle="collapse" data-target="#demo">
                            <div class="boxart-size">
                                <img class="card-img-top" src="{{ asset('asset/clients/images/' . $popular->poster) }}"
                                    alt="">
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- --------------------------------------------------------------------------------->

        <div class="movies-list ">
            <h2 class="title-content">
                <a class="skeleton text-light" href="#">Hiện đang thịnh hành</a>
            </h2>
            <div class="top-movie">
                @foreach ($popularMovie as $popular)
                    <div class="movie skeleton">
                        <a a href="{{ route('popup', $popular->id) }}" type="btn" class="popup-click"
                            data-custom-attribute="{{ $popular->id }}" data-toggle="collapse" data-target="#demo">
                            <div class="boxart-size" aria-hidden="true">
                                <img class="card-img-top" src="{{ asset('asset/clients/images/' . $popular->poster) }}"
                                    alt="">
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('asset\clients\js\index.js') }}"></script>
@endsection
