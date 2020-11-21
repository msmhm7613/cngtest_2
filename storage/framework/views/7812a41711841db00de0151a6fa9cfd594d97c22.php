<?php

use App\Models\Tempstore;

// کارگاه ها
$tempstores = Tempstore::latest()->get();

?>
<div class="stuff-header">
    <form action="<?php echo e(Route('createTransfer')); ?>" method="POST" class="form-horizontal col-md-12">
        <div class="header row p-3 text-center outset bg-lightgreen">
            <h3 class="display-6">
                <div class="i fas fa-new"></div>
                انتقال کالا ها بین انبار
            </h3>
        </div>
        <div class="row">
            <?php echo csrf_field(); ?>
            <div class="form-group  add">
                <?php if(count($tempstores)): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source_temp" class="form-label">
                                    انبار مبدا :
                                </label>
                                <select class="form-control" name="source_temp" id="source_temp">
                                    <option selected disabled>انتخاب کارگاه</option>
                                    <?php $__currentLoopData = $tempstores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="destination_temp" class="form-label">
                                    انبار مقصد :
                                </label>
                                <select class="form-control" name="destination_temp">
                                    <option selected disabled>انتخاب کارگاه</option>
                                    <?php $__currentLoopData = $tempstores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">هیچ کارگاهی در سیستم ثبت نشده است</div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer_date" class="form-label">
                                تاریخ :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder="" id="transfer_date"
                                   name="transfer_date">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer_number" class="form-label">
                                شماره انتقال :
                            </label>
                            <input type="text" class=" inset" placeholder="" id="transfer_number"
                                   name="transfer_number">
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="temp-reciept-stuff-radion" class="form-label">
                                <input class="form-control" value="0" type="radio" name="stuff-type-radio"
                                       id="temp-reciept-stuff-radion" checked>اضافه کردن کالا به لیست
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="temp-reciept-stuffpack-radion" class="form-label">
                                <input class="form-control" value="1" type="radio" name="stuff-type-radio"
                                       id="temp-reciept-stuffpack-radion">اضافه کردن مجموعه به لیست
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row" id="stuff_div" style="display: none">
                    <div class="col-md-4 border ">
                        <div class="form-group select-stuff-or-stuffpack">
                            <div class="" id="select-stuff-to-add-trnsfer">
                                <label for="stuff-select-input" class="form-label">
                                    انتخاب کالا:
                                </label>
                                <select name="stuff_id" id="stuff_id" class="inset form-control">
                                </select>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-4 border">
                        <div class="form-group">
                            <label for="stuff-number-input-trnsfer" class="form-label">
                                تعداد :
                            </label>
                            <input type="number" class="form-control inset" name="stuff-number-input-trnsfer"
                                   id="stuff-number-input-trnsfer" in="1"
                                   style="background: #fff;">

                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="item-comment-input-trnsfer" class="form-label">
                            توضیحات :
                        </label>
                        <input type="text" class=" inset" name="item-comment-input-trnsfer"
                               id="item_stuff_comment" min="1"
                               max="100" style="background: #fff;">

                    </div>

                </div>
                    <div class="row" id="stuffpack_div" style="display: none">
                        <div class="col-md-4 border ">
                            <div class="form-group select-stuff-or-stuffpack">
                                <div class="" id="select-stuff-to-add-trnsfer">
                                    <label for="stuff-select-input" class="form-label">
                                        انتخاب مجموعه کالا:
                                    </label>
                                    <select name="stuffpack_id" id="stuffpack_id" class="inset form-control">
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 border">
                            <div class="form-group">
                                <label for="stuff-number-input-trnsfer" class="form-label">
                                    تعداد :
                                </label>
                                <input type="number" class="form-control inset" name="stuff-number-input-trnsfer"
                                       id="stuffpack-number-input-trnsfer" min="1"
                                       style="background: #fff;">

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="item-comment-input-trnsfer" class="form-label">
                                توضیحات :
                            </label>
                            <input type="text" class=" inset" name="item-comment-input-trnsfer"
                                   id="item_stuffpack_comment" min="1"
                                   max="100" style="background: #fff;">

                        </div>

                    </div>
                <div class="row">

                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center align-center">
                        <div class="form-group ">
                            <button class="w-100 btn btn-success" id="" onclick="add_transfer_list()" type="button">
                                <i class="fas fa-plus"></i>
                                اضافه به لیست
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="result"></div>
                </div>

            </div>
            <div class="col-sm-12 stuffpack-list p-3 border inset">

                <table class="table table-bordered" id="temp-reciept-list-table-trnsfer">
                    <div class="">
                        <thead>
                        <tr class="table-primary">
                            <th>
                                ردیف
                            </th>
                            <th>
                                کد کالا
                            </th>
                            <th>
                                نام کالا
                            </th>
                            <th>
                                تعداد
                            </th>
                            <th>
                                واحد
                            </th>
                            <th>
                                سریال (ها)
                            </th>
                            <th>
                                توضیحات
                            </th>

                            <th>
                                حذف
                            </th>

                        </tr>
                        </thead>
                        <tbody id="stuff-body">

                        </tbody>
                        <thead>
                        <tr class="table-primary">
                            <th>
                                ردیف
                            </th>
                            <th>
                                کد کالا / مجموعه
                            </th>
                            <th>
                                نام کالا / مجموعه
                            </th>
                            <th>
                                تعداد
                            </th>
                            <th>
                                واحد
                            </th>
                            <th>
                                توضیحات
                            </th>
                            <th>
                                سریال (ها)
                            </th>
                            <th>
                                حذف
                            </th>

                        </tr>
                        </thead>
                        <tbody id="stuffpack-body">

                        </tbody>
                    </div>
                </table>
            </div>

            <div class="row">

                <div class="col">
                    <button class="btn btn-success hidden" type="submit" id="insert-new-reciept-save-btn-trnsfer">
                        <i class="fas fa-save"></i>
                        ثبت
                    </button>
                </div>
                <div class="col">
                    <button class="btn btn-primary" id="insert-new-reciept-back-btn-trnsfer">
                        <i class="fas fa-backward"></i>
                        بازگشت
                    </button>
                </div>
                <div class="col">
                    <div class="mt-2 alert" id="insert-new-reciept-response-trnsfer">

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo e(asset('js/transfer-stuff/transfer.js')); ?>"></script>

<script type="text/javascript">

    var stuff_count = [];
    var stuffpack_count = [];

    $(document).on('change', 'input[name="stuff-type-radio"]', function (e) {
        $('#stuff_div').fadeOut('fast');
        $('#stuffpack_div').fadeOut('fast');

        is_stuffpack = $('input[name="stuff-type-radio"]:checked').val();
        if (is_stuffpack == 1)
            $('#stuffpack_div').fadeIn();
        else
            $('#stuff_div').fadeIn();
    });

    $(document).on('change', '#source_temp', function () {
        var temp_id = $('#source_temp').val();
        $.ajax({
            url: `get_inventory/${temp_id}`,
            type: 'get',
            success: function (result) {

                $('#stuff_div').fadeOut('fast');
                $('#stuffpack_div').fadeOut('fast');

                $('#stuff_id').html('');
                $('#stuffpack_id').html('');

                if (result.status == 1) {

                    is_stuffpack = $('input[name="stuff-type-radio"]:checked').val();

                    if(result.stuffs.length) {

                        $('#stuff_id').append('<option selected disabled value="">انتخاب کنید</option>');
                        $.each(result.stuffs, function (key, val) {
                            stuff_count.push({id: val.id,count: val.count});
                            $('#stuff_id').append(`<option data-unit="${val.unit}" data-code="${val.code}" value="${val.id}">${val.name}</option>`);
                        });
                        if (is_stuffpack == 0)
                            $('#stuff_div').fadeIn('fast');

                    }

                    if(result.stuffpacks.length) {
                        $('#stuffpack_id').append('<option selected disabled value="">انتخاب کنید</option>');
                        $.each(result.stuffpacks, function (key, val) {
                            stuffpack_count.push({id: val.id,count: val.count});
                            $('#stuffpack_id').append(`<option data-code="${val.code}" value="${val.id}">${val.name}</option>`);
                        });
                        if (is_stuffpack == 1)
                            $('#stuffpack_div').fadeIn('fast');
                    }


                } else {
                    $('#stuff_result').addClass('alert alert-warning');
                    $('#stuffpack_result').addClass('alert alert-warning');
                    $('#stuff_result').html(result.msg);
                    $('#stuffpack_result').html(result.msg);
                }
            }
        });
    });

    $(document).on('change','#stuff_id',function () {

        var st_id = $('#stuff_id').val();
        var number = stuff_count.filter(el => el.id == st_id);
        var max_num = number[0].count;
        $('#stuff-number-input-trnsfer').attr('max',max_num);
        $('#stuff-number-input-trnsfer').attr('placeholder',`موجودی کالا : ${max_num}`);

    });

    $(document).on('change','#stuffpack_id',function () {

        var st_id = $('#stuffpack_id').val();
        var number = stuffpack_count.filter(el => el.id == st_id);
        var max_num = number[0].count;
        $('#stuffpack-number-input-trnsfer').attr('max',max_num);
        $('#stuffpack-number-input-trnsfer').attr('placeholder',`موجودی مجموعه کالا : ${max_num}`);

    });
</script>
<?php /**PATH C:\wamp\www\cngtest_2\resources\views/stuff-transfer/transfer-stuff.blade.php ENDPATH**/ ?>