<?php
    $reciepts = \App\Models\TempReciept::all() 
?>
<h3 class="header row p-3 text-center outset bg-lightgreen">
    ثبت سریال و وضعیت کالا
</h3>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="temp-resiept-select" class="form-lable">
                    شماره رسید موقت :
                </label>
                <select name="select-temp-reciept-for-serial" class="form-control" id="select-temp-reciept-for-serial">
                    <?php if($reciepts->count() > 0 ): ?>
                    <?php $__currentLoopData = $reciepts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($item->id); ?>" id="">
                            <?php echo e($item->reciept_no); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <button class="btn btn-primary form-control" style="margin-top:2rem;" id="serial-get-list-btn">
                    ثبت سریال
                </button>
            </div>
        </div>
    </div>


    <table class="table table-striped table-bordered" id="serial-list-table">
        <thead >
            <tr class="table-primary ">
                <th>
                    ردیف
                </th>
                <th>
                    نام کالا
                </th>
                <th>
                    سریال
                </th>
                <th>
                    توضیحات
                </th>
            </tr>
            

        </thead>

        <tbody>
          
        </tbody>
    </table>

<div class="row">
    <div class="col-md-6">
        <button class="btn btn-success form-control" id="save-serial-list-btn">
            ذخـیـره
        </button>
    </div>
</div>
<div class="row alert" id="insert-new-serial-list-response">

</div>
    <script src="<?php echo e(asset('js/serial/serial.js')); ?>">
    </script><?php /**PATH C:\wamp\www\cngtest_2\resources\views/serial/serial-table.blade.php ENDPATH**/ ?>