<div class="row">
    <div class="col-md-4">
        <div class="mycard outset">
            <div class="number">
                <h1>
                    <?php $stuffs = new App\Models\Stuff() ?>
                    <?php echo e($stuffs->all()->count()); ?>

                </h1>
            </div>
            <div class="desc">
                تعداد کل کالا
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mycard outset">
            <div class="number">
                <h1>
                    <?php $stuffpacks = new App\Models\Stuffpack() ?>
                    <?php echo e($stuffpacks->all()->count()); ?>

                </h1>
            </div>
            <div class="desc">
                تعداد کل مجموعه کالا
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mycard outset">
            <div class="number">
                <h1>
                    <?php $temp_rec = \App\Models\TempReciept::count() ?>
                    <?php echo e($temp_rec); ?>

                </h1>
            </div>
            <div class="desc">
                تعداد رسید موقت
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp\www\cngtest_2\resources\views/new-store/store.blade.php ENDPATH**/ ?>