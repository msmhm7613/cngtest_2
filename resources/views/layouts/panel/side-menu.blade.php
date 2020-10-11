<nav class="navbar navbar-expand-md text-right bg-light navbar-light side-menu">
    <div class=" navbar-brand w-100 d-flex justify-content-between">
        <b>
            <i class="fas fa-user">
            </i>
            @if (Auth::user())
                {{ Auth::user()->username }}
            @endif
        </b>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="logout" class="text-danger ml-3" id="logout-btn">
            <i class="fas fa-sign-out-alt" title="خروج"></i>
        </a>
    </div>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse w-100 " id="collapsibleNavbar">
        <ul class="navbar-nav flex-column w-100 p-0 align-top">
            <li class="nav-item ">
                <a class="nav-link " href="#">
                    <i class="fas fa-home "></i>
                    پیشخوان
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" data-target="#store-submenu" href="#">
                    <i class="fas fa-store "></i>
                    انبار و کالا
                </a>
                <div class="collapse" id="store-submenu">
                    <ul class="navbar-nav flex-column w-100">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                معرفی کالا
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                ثبت سریال
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                رسید موقت
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                انتقال کالا بین انبارها
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" data-target="#car-submenu" href="#">
                    <i class="fas fa-car "></i>
                    خودرو </a>
                <div class="collapse" id="car-submenu">
                    <ul class="navbar-nav flex-column w-100">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                خودروهای در صف </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                ورود از طریق فایل </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item text-warning">
                <a class="nav-link" data-toggle="collapse" data-target="#workshop-submenu" href="#">
                    <i class="fas fa-wrench"></i>
                    کارگاه </a>
                <div class="collapse" id="workshop-submenu">
                    <ul class="navbar-nav flex-column w-100">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                ثبت اطلاعات نصب </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                صدور صورت وضعیت</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item text-pink">
                <a class="nav-link" data-toggle="collapse" data-target="#reports-submenu" href="#">
                    <i class="fas fa-chart-bar"></i>
                    گزارشات </a>
                <div class="collapse" id="reports-submenu">
                    <ul class="navbar-nav flex-column w-100">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                گزارش عملکرد کارگاه </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                گزارش موجودی انبارها</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                گزارش صورت وضعیت</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#settings-submenu" href="#">
                    <i class="fas fa-cog"></i>
                    امکانات </a>
                <div class="collapse" id="settings-submenu">
                    <ul class="navbar-nav flex-column w-100">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                کاربران </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                سطوح دسترسی</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                پشتیبانی اطلاعات</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                پشتیبانی نرم‌‍افزار</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                درباره نرم‌‍افزار</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
