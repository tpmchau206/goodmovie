@extends('layouts.clientAdmin')

@section('title')
    {{ $title }}
@endsection

@section('active-movies')
    active
@endsection

@section('add')
    <div class="add m-2">
        <a href="{{ route('admin.movies.add') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i>
            Thêm mới
        </a>
    </div>
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success text-center">{{ session('msg') }}</div>
    @endif
    <div class="tab-pane fade show active overflow-x-scroll" id="v-pills-profile" role="tabpanel"
        aria-labelledby="v-pills-profile-tab" tabindex="0">
        <table class="table" style="width: 100%;">
            <thead>
                <tr style="width: 100%;">
                    <th scope="col" style="width: 5rem;">#</th>
                    <th scope="col" style="width: 4rem;">id</th>
                    <th scope="col" style="width: 7rem;">name</th>
                    <th scope="col" style="width: 6rem;">poster</th>
                    <th scope="col" style="width: 5rem;">image</th>
                    <th scope="col" style="width: 5rem;">trailer</th>
                    <th scope="col" style="width: 5rem;">movieLink</th>
                    <th scope="col" style="width: 20rem;">content</th>
                    <th scope="col" style="width: 5rem;">year</th>
                    <th scope="col" style="width: 7rem;">performer</th>
                    <th scope="col" style="width: 7rem;">nation</th>
                    <th scope="col" style="width: 5rem;">length</th>
                    <th scope="col" style="width: 5rem;">episode</th>
                    <th scope="col" style="width: 7rem;">category</th>
                    <th scope="col" style="width: 5rem;">view</th>
                    <th scope="col" style="width: 5rem;">create_at</th>
                    <th scope="col" style="width: 5rem;">update_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $key => $movie)
                    <tr>
                        <td scope="row" class="text-nowrap">
                            <a href="{{ route('admin.movies.edit', $movie->id) }}" class="text-success"><i
                                    class="bi bi-pencil-square"></i></a>
                            &nbsp;
                            <button class="delete-button text-danger bg-transparent border border-0" type="button"
                                data-id="{{ $movie->id }}" data-name="{{ $movie->name }}"><i
                                    class="bi bi-trash"></i></button>
                            {{-- <a href="{{ route('admin.movies.delete', [$movie->id]) }}" class="text-danger"><i class="bi bi-trash"></i></a> --}}
                        </td>
                        <td scope="row">{{ $key + 1 }}</td>
                        <td title="{{ $movie->name }}">{{ $movie->name }}</td>
                        <td title="{{ $movie->poster }}">{{ $movie->poster }}</td>
                        <td title="{{ $movie->image }}">{{ $movie->image }}</td>
                        <td title="{{ $movie->trailer }}">{{ $movie->trailer }}</td>
                        <td title="{{ $movie->movieLink }}">{{ $movie->movieLink }}</td>
                        <td title="{{ $movie->content }}">{{ $movie->content }}</td>
                        <td title="{{ $movie->year }}">{{ $movie->year }}</td>
                        <td title="{{ $movie->performer }}">{{ $movie->performer }}</td>
                        <td title="{{ $movie->nation }}">{{ $movie->nation }}</td>
                        <td title="{{ $movie->length }}">{{ $movie->length }}</td>
                        <td title="{{ $movie->episode }}">{{ $movie->episode }}</td>
                        <td title="{{ $movie->name_category }}">{{ $movie->name_category }}</td>
                        <td title="{{ $movie->view }}">{{ $movie->view }}</td>
                        <td title="{{ $movie->create_at }}">{{ $movie->create_at }}</td>
                        <td title="{{ $movie->update_at }}">{{ $movie->update_at }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center perpage">
        {{ $movies->links() }}
    </div>

    <script>
        $(document).ready(function() {
            $('.delete-button').click(function() {
                var userId = $(this).data('id');
                var nameMV = $(this).data('name');
                // console.log(userId);
                var confirmation = confirm('Bạn có chắc chắn muốn bộ phim có tên là ' + nameMV + ' không?');
                if (confirmation) {
                    $.ajax({
                        url: '/admin/movies/delete/' + userId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload()
                            // Thực hiện cập nhật DOM hoặc tải lại trang (tùy ứng dụng của bạn)
                        },
                        error: function() {
                            alert('Có lỗi xảy ra khi xóa người dùng.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
