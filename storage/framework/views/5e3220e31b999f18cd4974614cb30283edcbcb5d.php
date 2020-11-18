<?php if(auth()->guard()->guest()): ?>
    <script>
        window.location('login')
    </script> ;
<?php endif; ?>

<?php echo $__env->make('stuff.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php

use \App\Http\Controllers\stuff\StuffController;
use \App\Models\Stuff;

    $stuffs = Stuff::all();

   if ( $stuffs->isEmpty() )

        {
            ?>
            <div class="row">
                <div class="alert alert-info">
                    هنوز هیچ کالایی ثبت نشده است.
                </div>
            </div>

            <?php

        }else{
?>
    <?php
    $ind = 1 ?>
        
        <table class="table table-striped table-bordered " id="stuffs-table">
            <thead>
                <tr class="table-primary">
                    <th>ردیف</th>
                    <th>کد کالا</th>
                    <th>نام کالا</th>
                    <th>نام لاتین</th>
                    <th>سریال منحصر بفرد</th>
                    <th>واحد اندازه‌گیری</th>
                    <th>توضیحات</th>
                    <th>عملیات</th>
                </tr>
            </thead>
        <tbody>

            <?php $__currentLoopData = $stuffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stuff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $unit = \App\Models\Unit::where('id',$stuff->unit_id)->first();
                $user = \App\Models\User::where('id',$stuff->creator_user_id)->first();
                ?>

                <tr id="<?php echo e($stuff->id); ?>">
                    <td><?php echo e($ind++); ?></td>
                    <td><?php echo e($stuff->code); ?></td>
                    <td><?php echo e($stuff->name); ?></td>
                    <td class="eng"><?php echo e($stuff->latin_name ?? '-'); ?></td>
                    <td><?php echo e($stuff->has_unique_serial ? 'دارد' : 'ندارد'); ?></td>
                    <td><?php echo e($unit->name); ?></td>
                    <td>
                        <p>
                            <?php echo e($stuff->description ?? 'ندارد'); ?>

                        </p>
                        
                    </td>
                    <td id="" style="width: 4rem;">
                        <div class="" id="<?php echo e($stuff->id); ?>">
                            <button class="btn btn-info btn-sm m-0 my-1 d-inline-block w-100 text-center edit-stuff-modal-open-btn"
                        id="" data-stuff-id="<?php echo e($stuff->id); ?>" title="ویرایش" data-creator-user-id="<?php echo e($stuff->creator_user_id); ?>" data-user-id="<?php echo e($user->id); ?>"><i
                                    class="fas fa-pencil-alt  m-0"></i></button>
                            <button class="btn btn-danger btn-sm m-0 my-1 d-inline-block w-100 text-center delete-stuff-modal-open-btn"
                                id="" data-stuff-id="<?php echo e($stuff->id); ?>" title="حذف"><i
                                    class="fas fa-trash-alt m-0"></i></button>
                        </div>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr class="table-primary">
                <th>ردیف</th>
                <th>کد کالا</th>
                <th>نام کالا</th>
                <th>نام لاتین</th>
                <th>سریال منحصر بفرد</th>
                <th>واحد اندازه‌گیری</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
        </tfoot>
    </table>

<?php } ?>
<?php echo $__env->make('stuff.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php /**PATH E:\MAMP\htdocs\cngtest6\resources\views/stuff/table.blade.php ENDPATH**/ ?>