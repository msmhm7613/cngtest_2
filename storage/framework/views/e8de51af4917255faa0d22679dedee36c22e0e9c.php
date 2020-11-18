<?php if(auth()->guard()->guest()): ?>

    <script>
        window.location('login')

    </script> ;
<?php endif; ?>

<?php echo $__env->make('stuff-pack.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(App\Models\Stuffpack::all()->count()): ?>
    <?php $ind = 1 ?>
    <table class="table table-striped table-bordered " id="stuff-packs-table">
        <thead>
            <tr class="table-primary">
                <th>ردیف</th>
                <th>کد مجموعه کالا</th>
                <th>نام مجموعه کالا</th>
                <th>تعداد اقلام</th>
                <th>تعداد کل</th>
                <th>شماره سریال</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>

            <?php $__currentLoopData = \App\Models\Stuffpack::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stuff_pack): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $unit = \App\Models\Unit::where('id',$stuff_pack->unit_id)->first();
                $user = \App\Models\User::where('id',$stuff_pack->creator_user_id)->first();
                $stuffpack_list = \App\Models\StuffpackList::where('stuffpack_id',$stuff_pack->id);
                ?>

                <tr id="<?php echo e($stuff_pack->id); ?>">
                    <td><?php echo e($ind++); ?></td>
                    <td><?php echo e($stuff_pack->code); ?></td>
                    <td><?php echo e($stuff_pack->name); ?></td>
                    <td><?php echo e($stuffpack_list->count()); ?></td>
                    <td><?php echo e($stuffpack_list->sum('stuff_count')); ?></td>
                    <td><?php echo e($stuff_pack->serial); ?></td>
                    <td>
                        <p>
                            <?php echo e($stuff_pack->description ?? 'ندارد'); ?>

                        </p>
                        

                    </td>
                    <td id="operation">
                        <div class="btns" id="<?php echo e($stuff_pack->id); ?>">
                            <button class="btn btn-info btn-sm m-0 my-1 d-inline-block w-100 text-center stuffpack-edit-modal-open"
                        id="btnStuff_packEdit-<?php echo e($stuff_pack->id); ?>" data-id="<?php echo e($stuff_pack->id); ?>" title="ویرایش" data-creator-user-id="<?php echo e($stuff_pack->creator_user_id); ?>" data-user-id="<?php echo e($user->id); ?>"><i
                                    class="fas fa-pencil-alt  m-0"></i></button>
                            <button class="btn btn-danger btn-sm m-0 my-1 d-inline-block w-100 text-center "
                                id="btn-stuff_pack-delete-modal-show" data-id="<?php echo e($stuff_pack->id); ?>" title="حذف"><i
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
<?php elseif( \App\Models\Stuff::all()->count() ): ?>
    <div class="mt-3 alert alert-info">
        هنوز هیچ مجموعه کالایی ثبت نشده است.
    </div>
<?php else: ?>
    <div class="mt-3 alert alert-info">
        ابتدا باید کالا ثبت کنید.
    </div>
    <script>
        var btn = document.getElementById('insert-new-stuff-pack-button');
        console.log(btn);
        btn.disabled = true;
    </script>
<?php endif; ?>
<?php echo $__env->make('stuff-pack.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH E:\MAMP\htdocs\cngtest6\resources\views/stuff-pack/table.blade.php ENDPATH**/ ?>