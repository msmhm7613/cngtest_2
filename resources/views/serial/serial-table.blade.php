@php
    $reciepts = \App\Models\TempReciept::all() 
@endphp
<h3 class="header row p-3 text-center outset bg-lightgreen">
    ثبت سریال و وضعیت کالا
</h3>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="temp-resiept-select" class="form-lable">
                    شماره رسید موقت :
                </label>
                <select name="select-temp-reciept-for-serial" class="form-control" id="select-temp-reciept-for-serial">
                    @if ($reciepts->count() > 0 )
                    @foreach ($reciepts as $item)
                <option value="{{ $item->id }}" id="">
                            {{ $item->reciept_no }}
                        </option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <button class="btn btn-primary form-control" style="margin-top:2rem;" id="serial-get-list-btn">
                    ثبت سریال
                </button>
            </div>
        </div>
    </div>


    <table class="table table-striped table-borderd" id="serial-list-table">
        <thead >
            <tr class="table-primary ">
                <th>
                    ردیف
                </th>
                <th>
                    نام کالا
                </th>
                <th>
                    سریال
                </th>
                <th>
                    توضیحات
                </th>
            </tr>
            

        </thead>

        <tbody>
          
        </tbody>
    </table>

<div class="row">
    <div class="col-md-6">
        <button class="btn btn-success form-control" id="save-serial-list-btn">
            ذخیره
        </button>
    </div>
</div>
    <script src="{{ asset('js/serial/serial.js') }}">
    </script>