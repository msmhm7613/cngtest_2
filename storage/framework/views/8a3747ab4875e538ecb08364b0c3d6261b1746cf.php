<?php echo $__env->make('workshop.workshop-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php

$tempstores = \App\Models\Tempstore::all();
?>
<?php if($tempstores->count() === 0): ?>
    <div class="row">
        <div class="alert alert-info">
            <?php echo e(' هــیچ کارگــاهی ثـبت نـشده اسـت . '); ?>

        </div>
    </div>
<?php else: ?>
    <?php $ind = 1; ?>
    <table class="table table-border table-striped" id="workshops-table">

        <thead>
            <tr class="table-primary">
                <th>
                    ردیف
                </th>
                <th>
                    کد کارگاه
                </th>
                <th>
                    نام کارگاه
                </th>
                <th>
                    نام مدیر
                </th>
                <th>
                    تلفن
                </th>
                <th>
                    موبایل
                </th>
                <th>
                    آدرس
                </th>
                <th>
                    توضیحات
                </th>
                <th>
                    عملیات
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $tempstores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tempstore): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php echo e($ind++); ?>

                    </td>
                    <td>
                        <?php echo e($tempstore->code); ?>

                    </td>
                    <td>
                        <?php echo e($tempstore->name); ?>

                    </td>
                    <td>
                        <?php echo e($tempstore->manager); ?>

                    </td>
                    <td>
                        <?php echo e($tempstore->phone); ?>

                    </td>
                    <td>
                        <?php echo e($tempstore->mobile); ?>

                    </td>
                    <td>
                        <?php echo e($tempstore->address); ?>

                    </td>
                    <td>
                        <?php echo e($tempstore->description); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr class="table-primary">
                <th>
                    ردیف
                </th>
                <th>
                    کد کارگاه
                </th>
                <th>
                    نام کارگاه
                </th>
                <th>
                    نام مدیر
                </th>
                <th>
                    تلفن
                </th>
                <th>
                    موبایل
                </th>
                <th>
                    آدرس
                </th>
                <th>
                    توضیحات
                </th>
                <th>
                    عملیات
                </th>
            </tr>
        </tfoot>
    </table>
<?php endif; ?>
<?php echo $__env->make('workshop.insert-new-workshop-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script src="<?php echo e(asset('js/workshop/insert-new-workshop.js')); ?>"></script><?php /**PATH C:\wamp\www\cngtest_2\resources\views/workshop/workshop-table.blade.php ENDPATH**/ ?>