<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="insert-user-form">
                    @csrf
                    <div class="form-group row add">
                        {{-- <label for="title" class="control-label col-sm-2">{{ نام کاربری: }}</label> --}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="نام کاربری" id="username" name="username">
                                @error('username')
                                    <small id="small-1">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="رمز عبور" id="password" name="password">
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
                        @include('layouts.modals.user.access_list')
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

