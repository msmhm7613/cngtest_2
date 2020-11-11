<div class="stuff-header">
    <div class="header row p-3 text-center outset bg-lightgreen">
        <h3 class="display-6">
            <div class="i fas fa-new"></div>
            انتقال کالا ها بین انبار
        </h3>
    </div>

    <div class="row">

        <form action="" method="POST" class="form-horizontal col-sm-12" id="insert-transfert-stuff-form">
            @csrf
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="store-init" class="form-label">
                                انبار مبدا :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder="" id="store-init"
                                   name="store-init">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="store-close" class="form-label">
                                انبار مقصد :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder="" id="store-close"
                                   name="store-close">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer-date" class="form-label">
                                تاریخ :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder="" id="transfer-date"
                                   name="transfer-date">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer-number" class="form-label">
                                شماره انتقال  :
                            </label>
                            <input type="text" class=" inset" placeholder="" id="transfer-number"
                                   name="transfer-number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transfer-producer" class="form-label">
                                تهیه کننده :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder="" id="transfer-producer"
                                   name="transfer-producer">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tensfer-seconder" class="form-label">
                               تایید کننده:
                            </label>
                            <input type="text" class=" inset" placeholder="" id="tensfer-seconder"
                                   name="tensfer-seconder">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 border ">
                        <div class="form-group select-stuff-or-stuffpack">
                            <div class="" id="select-stuff-to-add-trnsfer">
                                <label for="stuff-select-input" class="form-label">
                                    انتخاب کالا:
                                </label>
                                <select name="stuff_id" id="stuff-select-input-trnsfer" class="inset form-control">
                                    @if (App\Models\Stuff::all()->count())
                                        @foreach (\App\Models\Stuff::all() as $stuff)
                                            <option value="{{ $stuff->id }}" data-stuff-code="{{ $stuff->code }}" <?php $unit_name=\App\Models\Unit::select() ->where('id',
                                                $stuff->unit_id)
                                                ->first()->name; ?>
                                            data-stuff-unit="{{ json_encode($unit_name) }}">{{ $stuff->name }}
                                            </option>
                                        @endforeach
                                    @endif
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
                                   id="stuff-number-input-trnsfer" value="1" min="1" max="100" style="background: #fff;">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="item-comment-input-trnsfer" class="form-label">
                            توضیحات :
                        </label>
                        <input type="text" class=" inset" name="item-comment-input-trnsfer" id="item-comment-input-trnsfer" min="1"
                               max="100" style="background: #fff;">

                    </div>

                </div>
                <div class="row">

                    <div class="col-md-4"></div>

                    <div class="col-md-4 text-center align-center">
                        <div class="form-group ">
                            <button class="w-100 btn btn-success" id="add-to-items-list-btn">
                                <i class="fas fa-plus"></i>
                                اضافه به لیست
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>

                </div>
            </div>

        </form>
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
                    <tbody>

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
                </div>
            </table>
        </div>

        <div class="row">

            <div class="col">
                <button class="btn btn-success hidden" id="insert-new-reciept-save-btn-trnsfer">
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

</div>

