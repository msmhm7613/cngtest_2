<nav class="navbar navbar-expand-md text-right bg-light navbar-light side-menu">
    <?php echo csrf_field(); ?>
    <div class=" navbar-brand w-100 d-flex justify-content-between">
        <b id="title">
            <i class="fas fa-user">
            </i>
            <?php if(Auth::user()): ?>
                <?php echo e(Auth::user()->username); ?>

            <?php endif; ?>
            <?php
                $access = \Illuminate\Support\Facades\Auth::user()->access;
                $access_array = explode(",", $access);
            ?>
        </b>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="logout" class="text-danger ml-3" id="logout-btn">
            <i class="fas fa-sign-out-alt" title="خروج"></i>
        </a>
    </div>
    <!-- ACCORDION -->
    <div id="accordion">
        <div class="collapse navbar-collapse w-100 " id="collapsibleNavbar">
            <ul class=" navbar-nav flex-column w-100 p-0 align-top">
                <li class="nav-item ">

                    <a class="nav-link active" href="#" data-toggle="collapse" data-controller="dashboard"
                       id="dashboard-btn" data-target="#dashboard">
                        <i class="fas fa-home "></i>
                        پیشخوان
                    </a>
                    <div class="collapse" id="dashboard" data-parent="#accordion">
                    </div>
                </li>
                <li class="nav-item ">
                    <?php if(in_array(1, $access_array)): ?>
                        <a class="nav-link" data-toggle="collapse" data-target="#store-submenu" href="" id="store-btn"
                           data-controller="store">
                            <i class="fas fa-store "></i>
                            انبار و کالا
                        </a>
                    <?php endif; ?>
                    <div class="collapse" id="store-submenu" data-parent="#accordion">
                        <ul class="navbar-nav flex-column w-100">
                            <?php if(in_array(2, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="define-stuff" data-controller="stuff">
                                        معرفی کالا
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(3, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="define-stuff-pack" data-controller="stuff-pack">
                                        معرفی مجموعه کالا
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(4, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="temp-reciept-side-menu-btn"
                                       data-controller="temp-reciept">
                                        ثبت رسید موقت
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(5, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="serial-side-menu-btn" data-controller="serial">
                                        ثبت سریال و وضعیت کالا
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(6, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-controller="transfer">
                                        انتقال کالا بین انبارها
                                    </a>
                                </li>
                        <?php endif; ?>
                        <!-- <li class="nav-item">
                                <a href="#" class="nav-link" id="unit-btn" data-controller="unit">
                                    تعریف واحد اندازه‌گیری
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <?php if(in_array(7, $access_array)): ?>
                        <a class="nav-link" data-toggle="collapse" data-target="#car-submenu" href="#">
                            <i class="fas fa-car "></i>
                            خودرو </a>
                    <?php endif; ?>
                    <div class="collapse" id="car-submenu" data-parent="#accordion">
                        <ul class="navbar-nav flex-column w-100">
                            <?php if(in_array(8, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-controller="car-queue">
                                        خودروهای در صف </a>
                                </li>
                        <?php endif; ?>
                        <!--  <li class="nav-item">
                                 <a href="#" class="nav-link">
                                     ورود از طریق فایل </a>
                             </li> -->
                        </ul>
                    </div>
                </li>
                <li class="nav-item text-warning">
                    <?php if(in_array(9, $access_array)): ?>
                        <a class="nav-link" data-toggle="collapse" data-target="#workshop-submenu" href="#">
                            <i class="fas fa-wrench"></i>
                            کارگاه </a>
                    <?php endif; ?>
                    <div class="collapse" id="workshop-submenu" data-parent="#accordion">
                        <ul class="navbar-nav flex-column w-100">
                            <?php if(in_array(10, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="define-workshop-btn"
                                       data-controller="define-workshop">
                                        تعریف کارگاه </a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(11, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        مرور اطلاعات نصب </a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(12, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        صدور صورت وضعیت</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <?php if(in_array(13, $access_array)): ?>
                        <a class="nav-link" data-toggle="collapse" data-target="#settings-submenu" href="#">
                            <i class="fas fa-cog"></i>
                            امکانات </a>
                    <?php endif; ?>
                    <div class="collapse" id="settings-submenu" data-parent="#accordion">
                        <ul class="navbar-nav flex-column w-100">
                            <?php if(in_array(14, $access_array)): ?>
                                <li class="nav-item" id="#nav-users-btn">
                                    <a href="#" class="nav-link" data-controller="users" id="side-menu-users-btn">
                                        معرفی کاربران</a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if(in_array(15, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        سطوح دسترسی</a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(16, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        مرکز دانلود</a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(17, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        پشتیبانی اطلاعات</a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(18, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        ورود اطلاعات از سامانه مرکز پخش</a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(19, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        پشتیبانی اطلاعات</a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(20, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        پشتیبانی نرم‌‍افزار</a>
                                </li>
                            <?php endif; ?>
                            <?php if(in_array(21, $access_array)): ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        درباره نرم‌‍افزار</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php /**PATH C:\wamp\www\cngtest_2\resources\views/layouts/panel/side-menu.blade.php ENDPATH**/ ?>