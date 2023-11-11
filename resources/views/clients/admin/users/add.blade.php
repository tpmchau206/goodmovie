@extends('layouts.clientAdmin')

@section('title')
    {{$title}}
@endsection

@section('active-users')
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
    <div class="alert alert-{{session('stt')}}">{{session('msg')}}</div>
    @endif

    {{-- @if ($errors->any())   
        <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ! Vui lòng kiểm tra lại.</div>
    @endif --}}

    <form action="{{ route('admin.users.post-add') }}" class="d-flex flex-column" id="form" method="post" enctype="multipart/form-data">
        {{-- @method('POST') --}}
        <div class="p-1 col-6">
            <label for="">Tên người dùng</label>
            <input type="text" class="form-control" name="username" placeholder="Tên người dùng" value="{{old('username')}}">
            @error('username')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="p-1 col-6" style="">
            <div class="d-flex flex-column">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
            </div>
            @error('email')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        
        <div class="p-1 col-6">
            <label for="">Mật khẩu</label>
            <input type="password" class="form-control" name="password" placeholder="Mật khẩu" value="">
            @error('password')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="p-1 col-6">
            <label for="">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" value="">
            @error('password_confirmation')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="p-1 col-6">
            <label for="">Họ và Tên</label>
            <input type="text" class="form-control" name="fullname" placeholder="Họ và tên" value="{{old('fullname')}}">
            @error('fullname')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="p-1 col-6">
            <label for="">Ngày sinh</label>
            <input type="date" class="form-control" name="dateofbirth" placeholder="Ngày sinh" value="{{old('dateofbirth')}}">
            @error('dateofbirth')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="d-flex col-6">
            <div class="p-1 col-6">
                <label for="">Phân quyền</label>
                <select class="form-control" name="group_id">
                    <option value="2">---Chọn quyền truy cập---</option>
                    @foreach ($allgroups as $item)
                    <option value="{{$item->id}}" {{old('group_id')==$item->id?'selected':false}}>{{$item->name}}</option>
                    @endforeach
                </select>
                @error('group_id')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="p-1 col-6">
                <label for="">Trạng thái</label>
                <select class="form-control" name="status" id="">
                    <option value="0" selected>Chưa kích hoạt</option>
                    <option value="1">Kích hoạt</option>
                </select>
                @error('status')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-between col-6">
            <a href="{{ route('admin.movies.index') }}" class="btn btn-warning col-3 m-1">Quay lại</a>
            <button type="submit" id="uploadButton" class="btn btn-primary col-3 m-1">Thêm mới</button>
        </div>
        @csrf
    </form>
</div>

@endsection

@section('javascript')


    <script type="module" src="{{asset('asset/clients/js/admin.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
@endsection