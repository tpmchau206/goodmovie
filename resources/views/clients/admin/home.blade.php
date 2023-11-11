@extends('layouts.clientAdmin')
@section('title')
    {{ $title }}
@endsection

@section('active-home')
    active
@endsection

@section('content')
    <div class="tab-pane fade show active overflow-x-auto" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"
        tabindex="0">
        <div class="d-flex flex-wrap">
            <div class="card total border-info-subtle mb-4 me-4 shadow">
                <span class="fs-5 p-2 fw-bold text-light bg-info rounded-top">Total Movies</span>
                <div class="card-body">
                    {{-- <h5 class="card-title">Card title</h5> --}}
                    <p class="fs-1 fw-bold text-info text-center">{{ $movies }}</p>
                    <div class="d-flex align-items-center justify-content-center go">
                        <a href="{{ route('admin.movies.index') }}" class="text-decoration-none text-black">List
                            Movies</a>
                        <i class="bi bi-chevron-double-right"></i>
                    </div>
                </div>
            </div>

            <div class="card total border-info-subtle mb-4 me-4 shadow">
                <span class="fs-5 p-2 fw-bold text-light bg-info rounded-top">Total Users</span>
                <div class="card-body">
                    {{-- <h5 class="card-title">Card title</h5> --}}
                    <p class="fs-1 fw-bold text-info text-center">{{ $users }}</p>
                    <div class="d-flex align-items-center justify-content-center go">
                        <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-black">List Users</a>
                        <i class="bi bi-chevron-double-right"></i>
                    </div>
                </div>
            </div>
            <div class="card total border-info-subtle shadow mb-4 me-4 ">
                <span class="fs-5 p-2 fw-bold text-light bg-info rounded-top" id="access_times">Total Access Times</span>


                <div class="card-body">
                    {{-- <h5 class="card-title">Card title</h5> --}}
                    <p class="fs-1 fw-bold text-info text-center" id="access_visit">{{ $visits }}</p>
                    <div class="d-flex align-items-center justify-content-center go">
                        <a href="{{ route('admin.visits.index') }}" class="text-decoration-none text-black">List Visits</a>
                        <i class="bi bi-chevron-double-right"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center w-100 mb-3">
            <div class="card border-info-subtle shadow w-75">
                <form action="" method="POST"
                    class="bg-info rounded-top text-center text-light d-flex justify-content-center align-items-center">
                    @csrf
                    <div class="fw-bold fs-3 ">Lượt truy cập năm:</div>
                    <select class="form-select m-1" style="width: 100px;" name="year" id="year">
                        @foreach ($visitstoyear as $year)
                            <option value="{{ $year->year }}" {{ $year->year == date('Y') ? 'selected' : '' }}>
                                {{ $year->year }}
                            </option>
                        @endforeach

                    </select>
                </form>
                <canvas id="myChart" class="myChart"></canvas>
            </div>
        </div>

        <div class="d-flex justify-content-center w-100 mb-3">
            <div class="card border-info-subtle shadow w-75">
                <div class="fw-bold fs-3 bg-info rounded-top text-center text-light"> Top 10 lượt xem nhiều nhất</div>
                <table class="table" style="width: 100%;">
                    <thead>
                        <tr style="width: 100%;">
                            <th scope="col" style="width: 4rem;">Top</th>
                            <th scope="col" style="width: 30%">Poster</th>
                            <th scope="col" style="width: ;">Name</th>
                            <th scope="col" style="width: 8rem;">View</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topviews as $key => $item)
                            <tr>
                                <td class="fw-bold fs-3 text-center align-middle" title="{{ $key + 1 }}">
                                    {{ $key + 1 }}</td>
                                <td class="d-flex justify-content-center" title="">
                                    <div class="overflow-hidden" style="width: 250px;height: 140px;">
                                        <img class="object-fit-cover w-100 h-100"
                                            src="{{ asset('asset/clients/images/' . $item->poster) }}"
                                            alt="{{ $item->name }}">
                                    </div>
                                </td>
                                <td class="text-wrap align-middle fw-bold fs-6" title="{{ $item->name }}">
                                    {{ $item->name }}</td>
                                <td class="text-end align-middle fw-bold fs-6" title="{{ $item->view }}">
                                    {{ $item->view }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Hàm để vẽ biểu đồ mặc định
        function drawDefaultChart(defaultData) {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4',
                        'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8',
                        'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ],
                    datasets: [{
                        label: false,
                        data: defaultData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Ẩn legend
                        }
                    }
                }
            });
            return myChart;
        }

        $(document).ready(function() {
            // Gửi yêu cầu ban đầu và vẽ biểu đồ mặc định
            year = $('#year').val();
            $.ajax({
                url: '/admin/chart',
                type: 'GET',
                dataType: 'json',
                data: {
                    year: year
                },
                success: function(defaultData) {
                    var myChart = drawDefaultChart(defaultData['data']);

                    // Xử lý sự kiện khi người dùng chọn một mục khác
                    $('#year').change(function() {
                        // Xóa biểu đồ hiện tại trước khi vẽ biểu đồ mới
                        myChart.destroy();

                        // Lấy dữ liệu mới dựa trên sự lựa chọn của người dùng
                        var selectedValue = $(this).val();
                        $.ajax({
                            url: '/admin/chart',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: "{{ csrf_token() }}",
                                year: selectedValue

                            },
                            success: function(selectedData) {
                                // Vẽ biểu đồ mới với dữ liệu mới
                                var ctx = document.getElementById('myChart')
                                    .getContext('2d');
                                myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: [
                                            'Tháng 1', 'Tháng 2',
                                            'Tháng 3', 'Tháng 4',
                                            'Tháng 5', 'Tháng 6',
                                            'Tháng 7', 'Tháng 8',
                                            'Tháng 9', 'Tháng 10',
                                            'Tháng 11', 'Tháng 12'
                                        ],
                                        datasets: [{
                                            label: 'New Chart',
                                            data: selectedData[
                                                'data'],
                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: false // Ẩn legend
                                            }
                                        }
                                    }
                                });
                            }
                        });
                    });
                }
            });
        });
    </script>
@endsection
