<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>@yield('title')</title>
    <style>
        .nav {
            width: 14%;
        }

        .logo {
            width: 100%;
        }

        .logo a img {
            width: 100%;
        }

        .tab-content {
            width: 85%;
        }

        .tab-pane {
            overflow-x: auto;
        }

        table {
            table-layout: fixed
        }

        table tr th {
            text-align: center;
        }

        table tr td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        table tr th a {
            text-decoration: none;
            color: black;
        }

        table tr th a:hover {
            text-decoration: underline;
            color: green;
        }

        .func a:hover,
        .func button:hover {
            color: #0015ff !important;
        }

        .dialog {
            display: none;
            background-color: rgba(69, 69, 69, 0.5);
        }

        #progress {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            white-space: pre-wrap;
            text-align: center;
            background: #373737;
            width: fit-content;
            ;
        }

        .total {
            min-width: 180px;
            height: 180px;
        }

        .go:hover .bi-chevron-double-right {
            transform: translateX(.25rem);
        }

        a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>

<body class="overflow-hidden">
    <div class="d-flex align-items-start vh-100 vw-100 position-relative">
        @include('clients.admin.blocks.nav')
        <div class="tab-content overflow-y-auto overflow-x-hidden vh-100" id="v-pills-tab Content">
            {{-- @include('clients.admin.') --}}
            <div class="header d-flex align-items-center mt-2 mb-2">
                <div class="title">
                    <h1 class="fs-1 text fw-bold ">@yield('title')</h1>
                </div>
                @yield('add')
            </div>

            @yield('content')


            {{-- <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab"
                 tabindex="0">ba</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"
                 tabindex="0">bon</div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"
                 tabindex="0">nam</div> --}}
        </div>
        @yield('dialog')
    </div>
    @yield('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
