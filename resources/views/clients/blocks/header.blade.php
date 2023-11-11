<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="{{ asset('asset/clients/images/logo/logo_movie.png') }}"
                width="100" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item px-2">
                    <a class="nav-link active" aria-current="page" href="/">Trang chủ</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="#">Phim T.hình</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="#">Phim</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="#">Mới & Phổ biến</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="#">Danh sách của tôi</a>
                </li>
            </ul>

            <div class="navbar-nav-right d-flex align-items-center">
                <form method="GET" action="/search" class="search px-2 d-flex align-items-center justify-content-end">
                    <input class="me-2" name="search" type="search" placeholder="Tên phim, diễn viên,..."
                        aria-label="Search">
                    <button type="submit" class='fs-3 icon bx bx-search'></button>
                    <div class="cenbutton"></div>
                </form>

                @if (session()->has('username'))
                    <div class="bell px-2 ">
                        <div class="bell dropdown">
                            <div class=" fs-3 bx bxs-bell" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            </div>
                            <span class="notify-number fs-8">{{ $notifys->count() }}</span>
                            <ul class="dropdown-menu dropdown-account translate-start-x"
                                style="left: unset; right: -5rem;">
                                <li class="text-center fs-3 p-2 text-light">Thông Báo</li>
                                @foreach ($notifys as $item)
                                    <li class="border-bottom pt-2 pb-2">
                                        <a class="dropdown-item " href="#">{{ $item->content }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="user px-2 position-relative">
                        <div class="dropdown">
                            <div class="dropdown-toggle p-0 position-relative rounded-circle overflow-hidden"
                                href="#" role="button" style="width: 50px; height: 50px;"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="position-absolute w-100 object-fit-cover"
                                    src="{{ asset('asset/clients/images/avatar/avatar-doraemon.png') }}" alt="">
                            </div>

                            <ul class="dropdown-menu dropdown-account translate-middle-x">
                                <li class="text-center p-2 text-light">
                                    {{ session('username') }}
                                </li>
                                <li><a class="dropdown-item" href="#">Tài khoản</a></li>
                                @if (getUser(session('id'))[0]->group_id == 1)
                                    <li><a class="dropdown-item" href="{{ route('admin.index') }}">Dashboard</a>
                                    </li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                            </ul>
                        </div>

                    </div>
                @else
                    <a href="{{ route('user.login') }}" class="fs-3 bx bxs-user text-white"></a>
                @endif
            </div>
        </div>

    </div>
</nav>
