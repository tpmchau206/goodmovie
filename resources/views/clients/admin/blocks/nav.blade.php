<div class="nav position-relative flex-column nav-pills me-3 bg-dark vh-100" id="v-pills-tab" role="tablist"
    aria-orientation="vertical">
    <div class="logo p-3">
        <a href="{{ route('index.home') }}">
            <img src="{{ asset('asset/clients/images/logo/logo_movie.png') }}" alt="">
        </a>
    </div>
    <a href="{{ route('admin.index') }}" class="nav-link @yield('active-home')" id="v-pills-home-tab"
        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
        aria-selected="true">Home</a>
    <a href="{{ route('admin.movies.index') }}" class="nav-link @yield('active-movies')" id="v-pills-profile-tab"
        data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
        aria-selected="false">Movies</a>
    <a href="{{ route('admin.users.index') }}" class="nav-link @yield('active-users')" id="v-pills-disabled-tab"
        data-bs-target="#v-pills-disabled" type="button" role="tab" aria-controls="v-pills-disabled"
        aria-selected="false">Users</a>
    <a href="{{ route('admin.visits.index') }}" class="nav-link @yield('active-visits')" id="v-pills-messages-tab"
        data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages"
        aria-selected="false">Visits</a>
    <a href="#" class="nav-link" id="v-pills-settings-tab" data-bs-target="#v-pills-settings" type="button"
        role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
    <div class="position-absolute bottom-0 p-3 text-light">
        <span class="">{{ session('username') }}</span> | <a class="text-decoration-none"
            style="color: rgb(255, 0, 0)" href="{{ route('logout') }}">Logout</a>
    </div>
</div>
