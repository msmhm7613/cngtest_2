<div class="header row p-3 text-center outset bg-lightgreen">
    <h3 class="display-6">
        <div class="i fas fa-new"></div>
        ثبت مجموعه کالای جدید
    </h3>
</div>

<div class="row">
    <div class="col-md-6 stuffpack-list p-3 border inset">
        <p class="text-bold text-primary">
            لیست کالاهای این مجموعه:
        </p>
        <p id="stuff-pack-list" class="alert alert-info">
            هیچ کالایی در این مجموعه وجود ندارد.
        </p>

        <table class="table table-sm table-striped table-bordered " id="stuff-list-table">
            <thead >
                <tr class="table-info">
                    <th>ردیف</th>
                    <th>نــام</th>
                    <th>تعداد</th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
    <form action="" method="POST" class="form-horizontal col-md-6" id="insert-new-stuff-pack-form">
        <?php echo csrf_field(); ?>
        <div class="form-group  add">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="stuff-pack-code-input" class="form-label">
                        کد مجموعه کالا:
                    </label>
                    <input type="text" autofocus class=" inset" placeholder="یک کد برای این مجموعه انتخاب نمایید" id="stuff-pack-code-input"
                        name="code">
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
                    <label for="stuff-pack-name-input" class="form-label">
                        نــام مجموعه کالا:
                    </label>
                    <input type="text" class=" inset" placeholder="یک نام برای این مجموعه انتخاب نمایید" id="stuff-pack-name-input" name="name">
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
            <div class="col-sm-12 bb-1">
                <div class="form-group">
                    <label for="stuff-pack-serial-input" class="form-label">
                        سریال مجموعه کالا:
                    </label>
                    <input type="text" class=" inset" placeholder="شماره سریال" id="stuff-pack-serial-input"
                        name="serial">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="stuff-select-input" class="form-label form-control">
                        انتخاب کالا:
                    </label>
                        <select name="stuff_id" id="stuff-select-input" class="inset form-control">
                            <?php if(App\Models\Stuff::all()->count()): ?>
                                <?php $__currentLoopData = \App\Models\Stuff::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stuff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($stuff->id); ?>"><?php echo e($stuff->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>

                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="stuff-number-input" class="form-label form-control">
                        تعداد در مجموعه:
                    </label>
                    <input type="number" class="form-control inset" name="stuff-number-input" id="stuff-number-input"
                        value="1" min="1" max="100" style="background: #fff;">

                </div>
            </div>
            <div class="col-md-12 text-center">
                <button class="w-100 btn btn-success" id="add-to-stuffs-list-btn">
                    <i class="fas fa-forward"></i>
                    اضافه به لیست
                </button>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <textarea name="insert-new-stuffpack-description" id="insert-new-stuffpack-description" cols="30" rows="3" class=" inset"
                    placeholder="توضیحات"></textarea>
            </div>
        </div>
        <div class="col-sm-12">
            <button class="btn btn-success hidden" id="insert-new-stuffpack-save-btn">
                <i class="fas fa-save"></i>
                ثبت
            </button>
            <button class="btn btn-primary" id="insert-new-stuffpack-back-btn">
                <i class="fas fa-backward"></i>
                بازگشت
            </button>
            <div class="mt-2 alert" id="insert-new-stuffpack-response">

            </div>
        </div>
    </form>

</div>


<?php /**PATH C:\wamp\www\cngtest_2\resources\views/stuff-pack/insert-form.blade.php ENDPATH**/ ?>