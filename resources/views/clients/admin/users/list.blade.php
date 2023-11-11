@extends('layouts.clientAdmin')

@section('title')
    {{ $title }}
@endsection

@section('active-users')
    active
@endsection

@section('add')
    <div class="add m-2">
        <a href="{{ route('admin.users.add') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i>
            Thêm mới
        </a>
    </div>
@endsection

@section('content')
    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
        tabindex="0">
        @if (session('msg'))
            <div class="alert alert-{{ session('stt') }} text-center">{{ session('msg') }}</div>
        @endif

        <form action="" method="get" class="mb-3">
            <div class="row w-100" style="">
                <div class="col-3">
                    <select class="form-control" name="status">
                        <option value="0">Tất cả trạng thái</option>
                        <option value="active" {{ request()->status == 'active' ? 'selected' : false }}>Kích hoạt</option>
                        <option value="inactive" {{ request()->status == 'active' ? 'inactive' : false }}>Chưa kích hoạt
                        </option>
                    </select>
                </div>
                <div class="col-3">
                    <select name="group_id" class="form-control">
                        <option value="0">Tất cả nhóm</option>
                        @if (!empty(getAllGroups()))
                            @foreach (getAllGroups() as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->group_id == $item->id ? 'selected' : false }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-4">
                    <input type="search" name="keywords" value="{{ request()->keywords }}" class="form-control"
                        placeholder="Từ khóa tìm kiếm...">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
        </form>

        <table class="table" style="width: 100%;">
            <thead>
                <tr style="width: 100%;">
                    <th scope="col" style="width: 3rem">STT</th>
                    <th scope="col" style="width: 8rem"><a
                            href="?sort-by=username&sort-type={{ $sortType }}">Username</a></th>
                    <th scope="col" style="width: 8rem"><a href="?sort-by=email&sort-type={{ $sortType }}">Email</a>
                    </th>
                    </th>
                    <th scope="col" style="width: 5rem"><a href="?sort-by=fullname&sort-type={{ $sortType }}">Họ
                            Tên</a></th>
                    <th scope="col" style="width: 5rem"><a href="?sort-by=group_id&sort-type={{ $sortType }}">Quyền
                            Truy Cập</a></th>
                    <th scope="col" style="width: 12%"><a href="?sort-by=status&sort-type={{ $sortType }}">Trạng
                            Thái</a></th>
                    <th scope="col" style="width: 5rem"><a href="?sort-by=update_at&sort-type={{ $sortType }}">Ngày
                            Cập nhật</a></th>
                    <th scope="col" style="width: 5rem"><a href="?sort-by=create_at&sort-type={{ $sortType }}">Ngày
                            Tạo</a></th>
                    <th scope="col" class="text-center" style="width: 5rem;">#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td scope="row">{{ $key + 1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td class="text-center">{{ $user->group_name }}</td>
                        <td class="text-center">
                            {!! $user->status == 0
                                ? '<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>'
                                : '<button class="btn btn-success btn-sm">Kích hoạt</button>' !!}
                        </td>
                        <td>{{ $user->update_at }}</td>
                        <td>{{ $user->create_at }}</td>
                        <td scope="row" class="text-nowrap text-center func">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-success"><i
                                    class="bi bi-pencil-square"></i></a>
                            &nbsp;
                            <button type="button" class="delete-button text-danger bg-transparent border border-0"><i
                                    class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center perpage">
        {{ $users->links() }}
    </div>

@endsection
