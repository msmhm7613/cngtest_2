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
            <div class="alert alert-danger errors hidden" id="response"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="add">
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



<script src="{{ asset('js/stuff/modal.js') }}"></script>
