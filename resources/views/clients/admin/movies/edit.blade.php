@extends('layouts.clientAdmin')

@section('title')
    {{$title}}
@endsection

@section('active-movies')
    active
@endsection
@section('dialog')
<div id="dialog" class="dialog position-absolute vh-100 vw-100" style="display: none;">
    <div id="progress" class="position-relative d-flex flex-column align-items-center rounded-2 text-light p-5 " >
        <span class="mb-3">Đang Uploads...</span>
        <progress style="width: 30vh;" value="0" max="100"></progress>
        <span id="progress-text">0%</span>
        <span>Vui lòng không thoát hoặc đóng trình duyệt...</span>
    </div>
</div>
@endsection
@section('content')
<div class="tab-pane fade show active overflow-x-hidden overflow-y-auto" style="height: 90vh" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
@if (session('msg'))
    <div class="alert alert-success text-center">{{session('msg')}}</div>
@endif

{{-- @if ($errors->any())   
<div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ! Vui lòng kiểm tra lại.</div>
    
@endif --}}
    <form action="{{ route('admin.movies.post-edit') }}" class="d-flex flex-column" id="form" method="post" enctype="multipart/form-data">
        {{-- @method('POST') --}}
        <div class="mb-1 col-12">
            <label for="">Tên bộ phim</label>
            <input type="text" class="form-control" name="name" placeholder="Tên bộ phim" value="{{$movieDetail[0]->name}}">
            @error('name')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-1 col-12">
            <div class="d-flex flex-column float-start">
                <label for="">Poster(ảnh ngang)</label>
                <input type="file" class="form-control" name="poster" placeholder="Poster" accept="image/*">
            </div>
            <img src="{{asset('asset/clients/images/'.$movieDetail[0]->poster)}}" class="m-2" height="100" alt="{{asset('asset/clients/images/'.$movieDetail[0]->poster)}}">
            {{-- @dd(asset('asset/clients/images/'.$movieDetail[0]->poster)) --}}
            @error('poster')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-1 col-12">
            <div class="d-flex flex-column float-start">
                <label for="">Image(ảnh dọc)</label>
                <input type="file" class="form-control" name="image" placeholder="Image" accept="image/*">
            </div>
            <img src="{{asset('asset/clients/images/'.$movieDetail[0]->image)}}" class="m-2" height="100" alt="">
            
            @error('image')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="col-12 d-flex">

            <div class="p-1 col-6" style="">
                <div class="d-flex flex-column">
                    <label for="">Trailer</label>
                    <input type="file" class="form-control" name="trailer" placeholder="Trailer" accept="video/*">
                    <video src="{{asset('asset/clients/video/'.$movieDetail[0]->trailer)}}" style="width: 100%" controls></video>
                </div>
                @error('trailer')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="p-1 col-6" style="">
                <div class="d-flex flex-column">
                    <label for="">Movie</label>
                    <input type="file" class="form-control" name="movie" placeholder="Movie" accept="video/*">
                    <video src="{{asset('asset/clients/video/'.$movieDetail[0]->movieLink)}}" style="width: 100%" controls>Null</video>
                </div>
                @error('movie')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="mb-1">
            <label for="">Nội dung</label>
            {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
            <textarea type="text" class="form-control" style="height:150px" name="content" placeholder="Nội dung">{{$movieDetail[0]->content}}</textarea>
            @error('content')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-1">
            <label for="">Diễn viên</label>
            <input type="text" class="form-control" name="performer" placeholder="Diễn viên" value="{{$movieDetail[0]->performer}}">
            @error('performer')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="d-flex">
            <div class="p-1 col-6">
                <label for="">Năm xuất bản</label>
                <select name="year" class="form-control">
                    {{-- <option value="{{$movieDetail[0]->year}}" selected disabled>{{$movieDetail[0]->year}}</option> --}}
                    @for ($i = date('Y'); $i > 1980; $i--)
                        <option value="{{$i}}" {{$i==$movieDetail[0]->year?'selected':''}}>{{$i}}</option>
                    @endfor    
                </select>
                {{-- <input type="" class="form-control" name="year" placeholder="Năm xuất bản" value="{{old('year')}}"> --}}
                @error('year')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="p-1 col-6">
                <label for="">Quốc gia</label>
                <input type="text" class="form-control" name="nation" placeholder="Quốc gia" value="{{$movieDetail[0]->nation}}">
                @error('nation')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="d-flex">
            <div class="p-1 col-6">
                <label for="">Thời lượng</label>
                <input type="number" class="form-control" name="length" placeholder="Thời lượng" value="{{$movieDetail[0]->length}}">
                @error('length')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="p-1 col-6">
                <label for="">Số tập</label>
                <input type="number" class="form-control" name="episode" placeholder="Số tập" value="{{$movieDetail[0]->episode}}">
                @error('episode')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="d-flex">
            <div class="p-1 col-6">
                <label for="">Thể loại</label>
                <select type="text" class="form-control" name="category">
                    <option value="0" selected disabled>--Chọn thể loại---</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}" {{$item->id==$movieDetail[0]->id_category?'selected':''}}>{{$item->name}}</option> 
                    @endforeach
                </select>
                @error('category')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="p-1 col-6">
                <label for="">Độ tuổi</label>
                <select type="text" class="form-control" name="age">
                    <option value="0" selected disabled>---Chọn độ tuổi---</option>
                    @for ($i = 18; $i >= 10; $i--)
                        <option value="{{$i}}+" {{$i.'+'==$movieDetail[0]->age?'selected':''}}>{{$i}}+</option>
                    @endfor
                    <option value="">Không giới hạn</option>
                </select>
                @error('age')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.movies.index') }}" class="btn btn-warning col-3 m-1">Quay lại</a>
            <button type="submit" id="uploadButton" class="btn btn-primary col-3 m-1">Cập nhật</button>
        </div>
        @csrf
    </form>
</div>

@endsection

@section('javascript')


    <script type="module" src="{{asset('asset/clients/js/admin.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
@endsection