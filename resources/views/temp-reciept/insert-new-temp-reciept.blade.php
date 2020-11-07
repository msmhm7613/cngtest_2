<div class="header row p-3 text-center outset bg-lightgreen">
    <h3 class="display-6">
        <div class="i fas fa-new"></div>
        ثبت رسید موقت جدید
    </h3>
</div>

<div class="row">

    <form action="" method="POST" class="form-horizontal col-sm-12" id="insert-new-temp-reciept-form">
        @csrf
        <div class="form-group  add">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="temp-reciept-sender-input" class="form-label">
                             ارسال کننده:
                        </label>
                        <input type="text" autofocus class=" inset" placeholder="" id="temp-reciept-sender-input"
                            name="temp-reciept-sender-input">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="temp-reciept-code-input" class="form-label">
                            شماره رسید:
                        </label>
                        <input type="text" autofocus class=" inset" placeholder="" id="temp-reciept-code-input"
                            name="temp-reciept-code-input">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="temp-reciept-referral-number-input" class="form-label">
                            شماره حـواله:
                        </label>
                        <input type="text" class=" inset" placeholder="" id="temp-reciept-referral-number-input"
                            name="temp-reciept-referral-number-input">
                    </div>
                </div>
                <div class="col-md-3 bb-1">
                    <div class="form-group">
                        <label for="temp-reciept-referral-date-input" class="form-label">
                            تاریخ حـواله:
                        </label>
                        <input type="text" class=" inset" placeholder="" id="temp-reciept-referral-date-input"
                            name="temp-reciept-referral-date-input">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="temp-reciept-driver-input" class="form-label">
                            نام راننده:
                        </label>
                        <input type="text" autofocus class=" inset" placeholder="" id="temp-reciept-driver-input"
                            name="temp-reciept-driver-input">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="temp-reciept-car-no-input" class="form-label">
                            شماره پلاک خودرو:
                        </label>
                        <input type="text" class=" inset" placeholder="" id="temp-reciept-car-no-input"
                            name="temp-reciept-car-no-input">
                    </div>
                </div>
                <div class="col-md-4 bb-1">
                    <div class="form-group">
                        <label for="temp-reciept-referral-date-input" class="form-label">
                            نوع خودرو:
                        </label>
                        <input type="text" class=" inset" placeholder="" id="temp-reciept-car-type-input"
                            name="temp-reciept-car-type-input">
                    </div>
                </div>
            </div>
            <div class="row"> {{-- توضیحات --}}
                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea name="insert-new-stuffpack-description" id="insert-new-stuffpack-description"
                            cols="30" rows="3" class=" inset" placeholder="توضیحات"></textarea>
                    </div>
                </div>
            </div>
            <div class="row"> {{-- انتخاب کالا یا مجموعه --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="temp-reciept-stuff-radion" class="form-label">
                            <input class="form-control" value="0" type="radio" name="temp-reciept-type-radio"
                                id="temp-reciept-stuff-radion" checked>اضافه کردن کالا به رسید
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="temp-reciept-stuffpack-radion" class="form-label">
                            <input class="form-control" value="1" type="radio" name="temp-reciept-type-radio"
                                id="temp-reciept-stuffpack-radion">اضافه کردن مجموعه به رسید
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">{{-- انتخاب کالا یا مجموعه که به لیست اضافه شود
                --}}
                <div class="col-md-4 border ">
                    <div class="form-group select-stuff-or-stuffpack">
                        <div class="" id="select-stuff-to-add">
                            <label for="stuff-select-input" class="form-label">
                                انتخاب کالا:
                            </label>
                            <select name="stuff_id" id="stuff-select-input" class="inset form-control">
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
                        <div class="hidden" id="select-stuffpack-to-add">
                            <label for="stuff-select-input" class="form-label">
                                انتخاب مجموعه:
                            </label>
                            <select name="stuffpack_id" id="stuffpack-select-input" class="inset form-control">
                                @if (App\Models\Stuffpack::all()->count())
                                    @foreach (\App\Models\Stuffpack::all() as $stuffpack)
                                        <option value="{{ $stuffpack->id }}"
                                            data-stuffpack-code="{{ $stuffpack->code }}">{{ $stuffpack->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 border">
                    <div class="form-group">
                        <label for="stuff-number-input" class="form-label">
                            تعداد :
                        </label>
                        <input type="number" class="form-control inset" name="stuff-number-input"
                            id="stuff-number-input" value="1" min="1" max="100" style="background: #fff;">

                    </div>
                </div>
                <div class="form-group">
                    <label for="item-comment-input" class="form-label">
                        توضیحات :
                    </label>
                    <input type="text" class=" inset" name="item-comment-input" id="item-comment-input" min="1"
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
        <p class="text-bold text-primary">
            لیست کالاهای این رسید:
        </p>
        <p id="temp-reciept-list-zero" class="alert alert-info">
            هیچ کالایی در این رسید وجود ندارد.
        </p>
        <table class="table table-bordered" id="temp-reciept-list-table">
            <div class="">
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
                            حذف
                        </th>

                    </tr>
                </thead>
            </div>
        </table>
    </div>

    <div class="row">

        <div class="col">
            <button class="btn btn-success hidden" id="insert-new-reciept-save-btn">
                <i class="fas fa-save"></i>
                ثبت
            </button>
        </div>
        <div class="col">
            <button class="btn btn-primary" id="insert-new-reciept-back-btn">
                <i class="fas fa-backward"></i>
                بازگشت
            </button>
        </div>
        <div class="col">
            <div class="mt-2 alert" id="insert-new-reciept-response">

            </div>
        </div>
    </div>
</div>
