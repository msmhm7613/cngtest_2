<div class="modal fade" id="insert-new-workshop-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <button class=" btn btn-danger btn-sm close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ثبت کارگاه جدید</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class=" p-0 form-horizontal col-sm-12" id="insert-tempstore-form">
                    <div class="form-group  add">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" placeholder="نام کارگاه" class="inset">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="manager" id="manager" class="inset" placeholder="مدیر کارگاه">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" name="code" id="code" placeholder="کد کارگاه" class="inset">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" name="phone" id="phone" class="inset" placeholder="تلفن کارگاه">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" name="mobile" id="mobile" class="inset" placeholder="موبایل">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="address" id="address" class="inset" placeholder="آدرس"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="description" id="description" class="inset" placeholder="توضیحات"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert" id="insert-new-workshop-response"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" id="insert-new-workshop-save">
                    <span class="fas fa-save"></span>
                    ثــبت
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal">
                    <span class="fas fa-close"></span>
                    بستن
                </button>
            </div>
        </div>

    </div>
</div><?php /**PATH C:\wamp\www\cngtest_2\resources\views/workshop/insert-new-workshop-modal.blade.php ENDPATH**/ ?>