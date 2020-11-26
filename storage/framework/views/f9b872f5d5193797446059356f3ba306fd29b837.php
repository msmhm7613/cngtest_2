<div class="stuff-header">
    <div>
        <a href="#"
           class="btn btn-success" data-controller="add-car-queue" id="create-car-squeue">
            <i class="fas fa-plus"></i>
            خودرو جدید
        </a>
        <a href="<?php echo e(asset('tempUpload/carsample.csv')); ?>" style="color: white"
           class="btn btn-info">
            <i class="fas fa-download"></i>
            دانلود فایل نمونه
        </a>
        <form id="form" action=<?php echo e(route('carUpload')); ?> method="post" class="d-inline p-0" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <label
                for="file-form-1"
                class="btn btn-info text-light m-0"
                id="insert-new-stuff-file-button">
                <i class="fas fa-file-upload "></i>
                ارسال از طریق فایل
            </label>
            <input type="file" id="file-form-1" style="display: none" name="file">
        </form>

    </div>

    <table class="table table-striped table-bordered " id="stuffs-table">
        <thead>
        <tr class="table-primary">
            <th>ردیف</th>
            <th>شماره پیگیری</th>
            <th>تاریخ نوبت</th>
            <th>وضعیت</th>
            <th>نام مالک</th>
            <th>کدملی مالک</th>
            <th>شماره مالک</th>
            <th>پلاک</th>
            <th>برند</th>
            <th>نام کارگاه</th>
            <th>شماره کارگاه</th>
            <th>تاریخ تبدیل</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = \App\Models\CarQueue::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=> $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th><?php echo e($i+1); ?></th>
                <th><?php echo e($c['track_number']); ?></th>
                <th><?php echo e($c['turn_date']); ?></th>
                <th><?php echo e($c['status']); ?></th>
                <th><?php echo e($c['owner_name']); ?></th>
                <th><?php echo e($c['owner_id']); ?></th>
                <th><?php echo e($c['owner_phone']); ?></th>
                <th><?php echo e($c['tag']); ?></th>
                <th><?php echo e($c['car_brand']); ?></th>
                <th><?php echo e($c['workshop']); ?></th>
                <th><?php echo e($c['workshop_phone']); ?></th>
                <th><?php echo e($c['convert_date']); ?></th>
                <th>
                    <button data-id="<?php echo e($c['id']); ?>" class="edit-car-queue btn btn-info btn-sm m-0 my-1 d-inline-block w-100 text-center edit-stuff-modal-open-btn" title="ویرایش"><i class="fas fa-pencil-alt  m-0"></i></button>
                </th>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
    <script>

        document.getElementById("file-form-1").onchange = function () {
            document.getElementById("form").submit();
        };
        $('#create-car-squeue').on('click', function (e) {
            $('#preloader').show();

            let targetController = ($(e.target).attr('data-controller'))


            $('div#content-box').first().load(
                'new-panel', {
                    '_token': $('input[name="_token"]').val(),
                    'target': targetController
                },
                function (responseTxt, statusTxt, xhr) {
                    if (statusTxt == "success")
                        $('#preloader').hide();

                }
            )
        })
        $('.edit-car-queue').on('click', function (e) {
            $('#preloader').show();
            let targetController = ($(e.target).attr('data-id'))
            $('div#content-box').first().load(
                'carEdit', {
                    '_token': $('input[name="_token"]').val(),
                    'target': targetController
                },
                function (responseTxt, statusTxt, xhr) {
                    if (statusTxt == "success")
                        $('#preloader').hide();

                }
            )
        })
    </script>
<?php /**PATH C:\wamp\www\cngtest_2\resources\views/car/index.blade.php ENDPATH**/ ?>