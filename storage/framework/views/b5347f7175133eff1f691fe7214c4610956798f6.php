<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="insert-user-form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row add">
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="نام کاربری" id="username" name="username">
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
                                <input type="text" autofocus class=" inset" placeholder="رمز عبور" id="password" name="password">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="role" id="role" class="form-control">
                                    <option value=1>
                                        <?php echo e('مدیر سیستم'); ?>

                                    </option>
                                    <option value=2>
                                        <?php echo e('مسئول سایت'); ?>

                                    </option>
                                    <option value=3>
                                        <?php echo e('پیمانکار'); ?>

                                    </option>
                                    <option value=4>
                                        <?php echo e('انبار'); ?>

                                    </option>
                                    <option value=5>
                                        <?php echo e('انبار موقت'); ?>

                                    </option>
                                    <option value=6>
                                        <?php echo e('کارگاه'); ?>

                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="acc_select">سطح دسترسی</label>
                                <select class="form-control" id="acc_select" onchange="load_sub_access()">
                                    <option selected disabled>انتخاب کنید</option>
                                    <option value="1">انبار و کالا</option>
                                    <option value="2">خودرو</option>
                                    <option value="3">کارگاه</option>
                                    <option value="4">امکانات</option>
                                </select>
                            </div>
                        </div>
                        <?php echo $__env->make('layouts.modals.user.access_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger errors hidden" id="response"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="add">
                    <span class="fas fa-plus"></span>
                    اضافه
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal"  >
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>

<?php /**PATH C:\wamp\www\cngtest_2\resources\views/layouts/modals/user/insert-new-user.blade.php ENDPATH**/ ?>