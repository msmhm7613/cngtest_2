<div class="modal fade" id="insert-new-stuff-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="insert-new-stuff-form">
                    @csrf

                    <div class="form-group row add">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="کد کالا" id="code" name="code">
                                @error('code')
                                <small id="small-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class=" inset" placeholder="نام کالا" id="name" name="name">
                                @error('name')
                                <small id="small-1">
                                    {{ $message }}
                                </small>
                                @enderror
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
                                <div class="col-sm-6 p-0"><select name="unit_id" id="unit_id" class="form-control w-100">
                                        @foreach (App\Models\Unit::all() as $unit)
                                            <option value="{{ $unit->id }}">
                                                {{ $unit->name }}
                                            </option>
                                        @endforeach
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
                                <textarea name="description" id="description" cols="30" rows="3" class=" inset" placeholder="توضیحات"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger errors hidden" id="insert-new-stuff-response"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" id="insert-new-stuff-save">
                    <span class="fas fa-plus"></span>
                    اضافه
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal">
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="edit-stuff-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="edit-stuff-form">
                    @csrf
                    <div class="form-group row add">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="کد کالا" id="edit-stuff-code-input" name="edit-stuff-code-input">
                                @error('code')
                                <small id="small-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class=" inset" placeholder="نام کالا" id="edit-stuff-name-input" name="edit-stuff-name-input">
                                @error('name')
                                <small id="small-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class=" inset" placeholder="نام لاتین" id="edit-stuff-latin_name-input"
                                    name="latin_name">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-inline">
                                <div class="col-sm-6 p-0"><label for="edit_unit_id_select" class="form-select-label text-right">واحد
                                        اندازه‌گیری:</label></div>
                                <div class="col-sm-6 p-0"><select name="edit_unit_id_select" id="edit_unit_id_select" class="form-control w-100">
                                        @foreach (App\Models\Unit::all() as $unit)
                                            <option value="{{ $unit->id }}">
                                                {{ $unit->name }}
                                            </option>
                                        @endforeach
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
                                <textarea name="edit-stuff-description" id="edit-stuff-description" cols="30" rows="3" class=" inset" placeholder="توضیحات"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger errors hidden" id="stuff-edit-response"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="edit-stuff-save-btn"  data-user-id="{{ $user->id??'' }}">
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
<div class="modal fade" id="delete-stuff-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p class="alert alert-danger">
                    آیا شما مطمئنید میخواهید
                    <span id="delete-stuff-name"></span>
                    را حذف کنید؟

                </p>
            </div>
            <div class="alert alert-danger errors hidden" id="delete-stuff-response"></div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit" id="delete-stuff-btn">
                    <span class="fas fa-trash"></span>
                   حــذف
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal" id="delete-cancel-btn">
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>



<script src="{{ asset('js/stuff/modal.js') }}"></script>
<script src="{{ asset('js/stuff/table.js') }}"></script>


