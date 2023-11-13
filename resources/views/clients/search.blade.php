@extends('layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="search-page">
        <div class="d-flex flex-nowrap align-items-baseline">
            <h1>{{ $title }}</h1>
            <i class="back bi bi-chevron-right fs-3 ms-1"></i>
            <h2 title="Từ khóa">{{ $searchTerm }}</h2>
        </div>
    </div>
    <div class="table-search d-flex flex-wrap">
        @foreach ($search as $item)
            <div class="movies">
                <a href="{{ route('popup', $item->id) }}" type="btn" class="popup-click"
                    data-custom-attribute="{{ $item->id }}" data-toggle="collapse" data-target="#demo">
                    <div class="boxart-size">
                        <img class="card-img-top" src="{{ asset('asset/clients/images/' . $item->poster) }}" alt="">
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <hr>
    <div class="movies-list">
        <h2 class="title-content">
            <a class="skeleton text-light" href="#">Gợi ý cho bạn</a>
        </h2>
        <div class="top-movie">
            @foreach ($suggest as $popular)
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
@endsection
@section('javascript')
    <script src="{{ asset('asset\clients\js\search.js') }}"></script>
@endsection
