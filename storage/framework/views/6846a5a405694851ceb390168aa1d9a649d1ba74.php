<div class="modal fade" id="insert-new-stuff-pack-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="insert-new-stuff-pack-form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row add">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="کد کالا"
                                    id="stuff-pack-code-input" name="code">
                                <?php $__errorArgs = ['code'];
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
                                <input type="text" class=" inset" placeholder="نام کالا" id="stuff-pack-name-input"
                                    name="name">
                                <?php $__errorArgs = ['name'];
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
                                <input type="text" class=" inset" placeholder="شماره سریال" id="stuff-pack-serial-input"
                                    name="serial">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <fieldset class="border form-group">
                                <legend class="w-auto p-2">کالا</legend>
                                <ol class="form-group" id="stuff-array-list">

                                </ol>
                                <div class="row">
                                    <?php $ind = 1; ?>

                                    <div class="col-6 form-group">
                                        <select name="stuff_id" id="stuff-select-input" class="form-control">
                                            <?php if(App\Models\Stuff::all()->count()): ?>
                                                <?php $__currentLoopData = \App\Models\Stuff::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stuff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($stuff->id); ?>"><?php echo e($stuff->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-6 form-group">
                                        <input type="number" class="form-control" name="stuff-number-input"
                                            id="stuff-number-input" value="1" min="1" max="100"
                                            style="background: #fff;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="w-100 btn btn-sm btn-success" id="add-to-stuffs-list-btn">
                                            <i class="fas fa-plus m-0"></i>
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea name="description" id="description" cols="30" rows="3" class=" inset"
                                    placeholder="توضیحات"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger errors hidden" id="insert-new-stuff-pack-response"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" id="insert-new-stuff-pack-save">
                    <span class="fas fa-plus"></span>
                    ذخیره
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal">
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="edit-stuff-pack-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="edit-stuff-pack-form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row add">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="کد کالا" id="code" name="code">
                                <?php $__errorArgs = ['code'];
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
                                <input type="text" class=" inset" placeholder="نام کالا" id="name" name="name">
                                <?php $__errorArgs = ['name'];
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
                                <input type="text" class=" inset" placeholder="نام لاتین" id="latin_name"
                                    name="latin_name">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-inline">
                                <div class="col-sm-6 p-0"><label for="unit_id" class="form-select-label text-right">واحد
                                        اندازه‌گیری:</label></div>
                                <div class="col-sm-6 p-0"><select name="unit_id" id="unit_id"
                                        class="form-control w-100">
                                        <?php $__currentLoopData = App\Models\Unit::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($unit->id); ?>">
                                                <?php echo e($unit->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select></div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-inline">
                                <div class="col-sm-9 p-0 text-right d-inline-block">
                                    <label for="has_unique_serial" class="form-check-lable p-0"> کالا سریال
                                        منحصر بفرد دارد؟
                                    </label>
                                </div>
                                <div class="col-sm-3 p-0 align-left text-left">
                                    <input type="checkbox" name="has_unique_serial" id="has_unique_id"
                                        class=" form-check-input p-0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea name="description" id="description" cols="30" rows="3" class=" inset"
                                    placeholder="توضیحات"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger errors hidden" id="stuff-pack-edit-response"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="edit-stuff-pack-save-btn"
                    data-user-id="<?php echo e($user->id ?? ''); ?>">
                    <span class="fas fa-save"></span>
                    ثبت تغییرات
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal">
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="delete-stuff-pack-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p class="alert alert-danger">
                    آیا شما مطمئنید میخواهید
                    <b>
                    <span id="delete-stuff-pack-name"></span>
                    </b>
                    را حذف کنید؟

                </p>
            </div>
            <div class="alert alert-danger errors hidden" id="delete-stuff-pack-response"></div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit" id="delete-stuff-pack-btn">
                    <span class="fas fa-trash"></span>
                    حــذف
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal" id="delete-cancel-btn">
                    <span class="fas fa-exit"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>



<script src="<?php echo e(asset('js/stuff-pack/modal.js')); ?>"></script>
<script src="<?php echo e(asset('js/stuff-pack/table.js')); ?>"></script>


<?php /**PATH C:\wamp\www\cngtest_2\resources\views/stuff-pack/footer.blade.php ENDPATH**/ ?>