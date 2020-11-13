<div class="stuff-header">
    <div class="header row p-3 text-center outset bg-lightgreen">
        <h3 class="display-6">
            <div class="i fas fa-new"></div>
            ثبت صف خودرو
        </h3>
    </div>
    <div class="row">
        <form action="{{route('carUpdate')}}" method="POST" class="form-horizontal col-sm-12"
              id="insert-transfert-stuff-form">
            <input type="hidden" name="id" value="{{$car['id']}}">
            @csrf
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="track_number" class="form-label">
                                شماره پیگیری :
                            </label>
                            <input type="text" autofocus value="{{$car['track_number']}}" class=" inset" required placeholder=""
                                   name="track_number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="turn_date" class="form-label">
                                تاریخ نوبت :
                            </label>
                            <input type="text" autofocus class=" inset" required placeholder=""
                                   value="{{$car['turn_date']}}"   name="turn_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="owner_name" class="form-label">
                            نام و نام خانوادگی مالک :
                        </label>
                        <input type="text" class=" inset" placeholder=""
                               value="{{$car['owner_name']}}"  name="owner_name">
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <div class="col-sm-12  col-12 p-0">
                            <label for="status" class="form-select-label text-right">
                                وضعیت:</label></div>
                        <div class="col-sm-12 p-0">
                            <select name="status" class="form-control ">
                                <option {{$car['status']=="در انتظار"? 'selected':''}} value="در انتظار">
                                    در انتظار
                                </option>
                                <option value="تبدیل شده" {{$car['status']=="تبدیل شده"? 'selected':''}}>
                                    تبدیل شده
                                </option>
                                <option value="رد شده" {{$car['status']=="رد شده"? 'selected':''}}>
                                    رد شده
                                </option>
                            </select></div>

                    </div>
                </div>
            </div>

            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="owner_id" class="form-label">
                                کد ملی مالک :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['owner_id']}}"  name="owner_id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="owner_phone" class="form-label">
                                شماره مالک :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['owner_phone']}}"    name="owner_phone">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tag" class="form-label">
                                پلاک :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['tag']}}"    name="tag">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="car_type" class="form-label">
                                نوع کاربری :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['car_type']}}"    name="car_type">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="car_brand" class="form-label">
                                برند :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['car_brand']}}"    name="car_brand">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="car_model" class="form-label">
                                مدل:
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['car_model']}}"    name="car_model">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="state" class="form-label">
                                استان خودرو :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['state']}}"   name="state">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city" class="form-label">
                                شهرخودرو :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['city']}}"   name="city">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contractor" class="form-label">
                                نام پیمانکار:
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['contractor']}}"    name="contractor">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="workshop" class="form-label">
                                نام کارگاه :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['workshop']}}" name="workshop">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="workshop_state" class="form-label">
                                استان کارگاه :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['workshop_state']}}"   name="workshop_state">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="workshop_city" class="form-label">
                                شهرکارگاه :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['workshop_city']}}" name="workshop_city">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="workshop_address" class="form-label">
                                آدرس کارگاه :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['workshop_address']}}"  name="workshop_address">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="workshop_phone" class="form-label">
                                شماره تماس کارگاه :
                            </label>
                            <input type="text" autofocus required class=" inset" placeholder=""
                                   value="{{$car['workshop_phone']}}"    name="workshop_phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="convert_date" class="form-label">
                                تاریخ تبدیل :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder=""
                                   value="{{$car['convert_date']}}"  name="convert_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="convert_id" class="form-label">
                                شناسه تبدیل :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder=""
                                   value="{{$car['convert_id']}}"    name="convert_id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tank_size" class="form-label">
                                حجم مخزن :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder=""
                                   value="{{$car['tank_size']}}"   name="tank_size">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tank_id" class="form-label">
                                سریال مخزن:
                            </label>
                            <input type="text" autofocus class=" inset" placeholder=""
                                   value="{{$car['tank_id']}}"   name="tank_id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tank_valve" class="form-label">
                                سریال شیر مخزن :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder=""
                                   value="{{$car['tank_valve']}}"    name="tank_valve">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="regulator_id" class="form-label">
                                سریال رگلاتور :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder=""
                                   value="{{$car['regulator_id']}}"       name="regulator_id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="convert_certificate_id" class="form-label">
                                شماره گواهی تبدیل :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder=""
                                   value="{{$car['convert_certificate_id']}}"  name="convert_certificate_id">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group  add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="health_certificate_id" class="form-label">
                                شناسه گواهی سلامت :
                            </label>
                            <input type="text" autofocus class=" inset" placeholder=""
                                   value="{{$car['health_certificate_id']}}"    name="health_certificate_id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="engine_id" class="form-label">
                                شماره موتور:
                            </label>
                            <input type="text" autofocus class=" inset" placeholder=""
                                   value="{{$car['engine_id']}}"    name="engine_id">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <button class="btn btn-success"
                            id="insert-new-reciept-save-btn-trnsfer">
                        <i class="fas fa-save"></i>
                        ثبت
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

