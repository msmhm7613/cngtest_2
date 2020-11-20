<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="preloader d-flex justify-content-center align-center text-center flex-column">
                </div>
                <form action="" method="POST" class="form-horizontal" id="edit-user-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="user_id">
                    <div class="form-group row add">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="نام کاربری" id="editUsername" name="username">
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small id="small-1">
                                        <?php echo e($message); ?>

                                    </small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="رمز عبور" id="editPassword" name="password">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="acc_select">سطح دسترسی</label>
                                <select class="form-control" id="acc_edit_select" onchange="load_edit_access()">
                                    <option selected disabled>انتخاب کنید</option>
                                    <option value="1">انبار و کالا</option>
                                    <option value="2">خودرو</option>
                                    <option value="3">کارگاه</option>
                                    <option value="4">امکانات</option>
                                </select>
                            </div>
                        </div>
                        <?php echo $__env->make('layouts.modals.user.edit_access_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger" id="selectResponse"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="edit" >
                    <span class="fas fa-plus"></span>
                    ثبت
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal"  >
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp\www\cngtest_2\resources\views/layouts/modals/user/edit-user.blade.php ENDPATH**/ ?>