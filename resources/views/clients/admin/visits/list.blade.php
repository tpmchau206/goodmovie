@extends('layouts.clientAdmin')

@section('title')
    {{ $title }}
@endsection

@section('active-visits')
    active
@endsection

{{-- @section('add')
    <div class="add m-2">
        <a href="{{ route('admin.movies.add') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i>
            Thêm mới
        </a>
    </div>
@endsection --}}

@section('content')
    @if (session('msg'))
        <div class="alert alert-success text-center">{{ session('msg') }}</div>
    @endif
    <div class="tab-pane fade show active overflow-x-auto" id="v-pills-profile" role="tabpanel"
        aria-labelledby="v-pills-profile-tab" tabindex="0">
        <table class="table" style="width: 100%;">
            <thead>
                <tr style="width: 100%;">
                    <th scope="col" style="width: 5%">STT</th>
                    <th scope="col" style="">IP</th>
                    <th scope="col" style="width: 50%">User Agent</th>
                    <th scope="col" style="">Created At</th>
                    <th scope="col" style="">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visits as $key => $visit)
                    <tr>
                        <td scope="row">{{ $key + 1 }}</td>
                        <td title="{{ $visit->ip_address }}">{{ $visit->ip_address }}</td>
                        <td title="{{ $visit->user_agent }}">{{ $visit->user_agent }}</td>
                        <td title="{{ $visit->created_at }}">{{ $visit->created_at }}</td>
                        <td title="{{ $visit->updated_at }}">{{ $visit->updated_at }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    {{-- <div class="d-flex justify-content-center perpage">
        {{ $visits->links() }}
    </div> --}}
@endsection
