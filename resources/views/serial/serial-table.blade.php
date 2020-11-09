@php
    $reciepts = \App\Models\TempReciept::all() 
@endphp
<h3 class="header row p-3 text-center outset bg-lightgreen">
    ثبت سریال و وضعیت کالا
</h3>
<form action="add-serials" id="select-temp-reciept-serial">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="temp-resiept-select" class="form-lable">
                    شماره رسید موقت :
                </label>
                <select name="select-temp-reciept-for-serial" class="form-control" id="select-temp-reciept-for-serial">
                    @if ($reciepts->count() > 0 )
                    @foreach ($reciepts as $item)
                        <option value="{{ $item->reciept_no }}" id="">
                            {{ $item->reciept_no }}
                        </option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <button class="btn btn-primary form-control">
                    ثبت سریال
                </button>
            </div>
        </div>
    </div>
</form>