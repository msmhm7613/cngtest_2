<div class="modal fade" id="insert-new-stuff-pack-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="insert-new-stuff-pack-form">
                    @csrf
                    <div class="form-group row add">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="کد کالا"
                                    id="stuff-pack-code-input" name="code">
                                @error('code')
                                <small id="small-1">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class=" inset" placeholder="نام کالا" id="stuff-pack-name-input"
                                    name="name">
                                @error('name')
                                <small id="small-1">
                                    {{ $message }}
                                </small>
                                @enderror
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
                                            @if (App\Models\Stuff::all()->count())
                                                @foreach (\App\Models\Stuff::all() as $stuff)
                                                    <option value="{{ $stuff->id }}">{{ $stuff->name }}</option>
                                                @endforeach
                                            @endif
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
                                <div class="col-sm-6 p-0"><select name="unit_id" id="unit_id"
                                        class="form-control w-100">
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
                    data-user-id="{{ $user->id ?? '' }}">
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
                    <span id="delete-stuff-pack-name"></span>
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
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>



<script src="{{ asset('js/stuff-pack/modal.js') }}"></script>
<script src="{{ asset('js/stuff-pack/table.js') }}"></script>


