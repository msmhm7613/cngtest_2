<div class="stuff-header">
    <div class="header row p-3 text-center outset bg-lightgreen">
        <h3 class="display-6">
            <div class="i fas fa-new"></div>
            تعریف کارگاه
        </h3>
    </div>

    <div class="row">
        <form action="{{ Route('createTempstore') }}" method="POST" class="form-horizontal col-sm-12" id="insert-tempstore-form">
            @csrf
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                نام کارگاه
                            </label>
                            <input type="text" name="name" id="name" class="inset">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="manager" class="form-label">
                                مدیر کارگاه
                            </label>
                            <input type="text" name="manager" id="manager" class="inset">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="code" class="form-label">
                            کد کارگاه
                        </label>
                        <input type="number" name="code" id="code" class="inset">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone" class="form-label">
                            تلفن کارگاه
                        </label>
                        <input type="number" name="phone" id="phone" class="inset">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile" class="form-label">
                            موبایل
                        </label>
                        <input type="number" name="mobile" id="mobile" class="inset">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address" class="form-label">
                            آدرس
                        </label>
                        <textarea name="address" id="address" class="inset"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description" class="form-label">
                            توضیحات
                        </label>
                        <textarea name="description" id="description" class="inset"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <button class="btn btn-success">ثبت کارگاه</button>
                </div>
            </div>
        </form>
    </div>
</div>
