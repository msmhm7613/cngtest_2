<?php
    use App\Models\User as user;
?>

<div id="insert-new-user-form-container">
    <a href="#" class="btn btn-success" id="newUserBtn">
        کاربر جدید
    </a>


    <div class="response">
        <ul>

        </ul>
    </div>
</div>

<!--
<div class="eng">
    <?php
//echo Str::random(8);
?>
    </div>
-->

<?php if(App\Models\User::all()->count()): ?>
    <table class="table table-striped tbl-users" id="tbl-users" style="z-index: 999;">
        <tr>
            <th>ردیف</th>
            <th>شناسه</th>
            <th>نام کاربری</th>
            <th style="display: none;">پسورد</th>
            <th>عنوان</th>
            <th style="text-align: left;" class="w-25">
                عملیات
            </th>
        </tr>
        <?php
            $ind = 1;
        ?>
        <?php $__currentLoopData = user::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="<?php echo e('tr-' . strval($ind)); ?>" aria-disabled="true">
                <td>
                    <?php echo e($ind); ?>

                </td>
                <td>
                    <?php echo e($user->id); ?>

                </td>
                <td>
                    <div class="d-flex justify-content-between">
                        <p>
                            <?php echo e($user->username); ?>

                        </p>

                    </div>
                </td>
                <td>
                    <div class="d-flex justify-content-between">
                        <p>
                            <?php echo e($user->title); ?>

                        </p>
                    </div>
                </td>
                <td class="text-left operation">
                    <div class="">
                        <?php if($ind == 1): ?>

                            <div class="lock">
                                <i class="fas fa-lock" style="display: block;"></i>
                            </div>

                        <?php endif; ?>
                        <button class="btn btn-info btn-sm my-1 w-25 d-inline-block " title="ویرایش" id="btnEdit" data-id=<?php echo e($user->id); ?>>
                            <i class="fas fa-pencil-alt m-0 "></i>

                        </button>
                        <button class="btn btn-danger btn-sm my-1 w-25 d-inline-block" title="حذف" id="btnDelete" data-id=<?php echo e($user->id); ?>>
                            <i class="fas fa-trash-alt m-0 "></i>
                        </button>
                        <button  class="btn btn-sm btn-warning" type="button" onclick="load_access(<?php echo e($user->id); ?>)" id="btnShowAccess"><i class="fas fa-universal-access m-0"></i></button>
                    </div>
                </td>
            </tr>
            <?php
                $ind++;
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <?php echo $__env->make('layouts.modals.user.show-access', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <div class="alert alert-info mt-5">
        <p>
            هیچ کاربری ثبت نشده است.
        </p>
    </div>
<?php endif; ?>


<?php echo $__env->make('layouts.modals.user.insert-new-user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.modals.user.edit-user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.modals.user.delete-user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp\www\cngtest_2\resources\views/layouts/tables/users.blade.php ENDPATH**/ ?>