<div class="navbar mb-4">
    <div class="navbar-brand">
        
            {{ env('APP_NAME') }}
            <div class="version">
                <small title=" {{ $Version[1] }} ">
                    {{ $Version[0] }}
                </small>
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
    @guest

    @endguest
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
        <div class="datetime pt-2">
            <small>
                {{ $Version[2] }}
            </small>

        </div>
    </div>

</div>
