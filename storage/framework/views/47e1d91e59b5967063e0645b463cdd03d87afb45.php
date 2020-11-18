<?php
use App\Models\User as user;
use App\Models\Kit as kit;
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>
<?php if(auth()->guard()->guest()): ?>
    <?php echo e(redirect('/login')); ?>

<?php endif; ?>



<?php if(!Auth::user()): ?>
    <script>
        window.location = "/login";

    </script>
<?php endif; ?>

<?php $__env->startSection('name', Auth::user()->username ?? ''); ?>
<?php $__env->startSection('page-title', 'پنل مدیریت'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-3">
            <?php echo $__env->make('layouts.panel.side-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-md-9" >
            <div class="" id="preloader">
                <div class="spinner-grow text-success"></div>
                <p class="loading-text text-light">
                    بارگذاری...
                </p>

                <lottie-player src="<?php echo e(asset('storage/images/loader/1.json')); ?>" background="" speed="1"
                    style="width: 100px; height: 100px;" loop autoplay></lottie-player>

            </div>
            <div id="content-box">

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('/js/side-menu.js')); ?>"></script>
    
    <script src="<?php echo e(asset('/js/modal.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\MAMP\htdocs\cngtest6\resources\views/new-panel.blade.php ENDPATH**/ ?>