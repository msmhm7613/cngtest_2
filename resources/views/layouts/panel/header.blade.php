<div class="navbar mb-4">
    <div class="navbar-brand">
        <div>
            {{ env('APP_NAME') }}
        </div>
        <div class="welcome">
            <small>
                شما به عنوان
            </small>
            <small>
                @yield('name')
            </small>
            <small>
                وارد شده‌اید.
            </small>

        </div>
    </div>

    <div class="title">
        <h1 class="text-center">
            <i class="fas fa-user-shield"></i>
            {{ Auth::user()->title }}
        </h1>
    </div>

    <div class="logout" id="logout">
        <a href="logout" class="btn btn-danger" id="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            خروج
        </a>
    </div>

</div>
