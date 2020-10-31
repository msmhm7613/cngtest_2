@php
$temp_reciept = \App\Models\TempReciept::paginate(10);
$stuffpack = \App\Models\Stuffpack::all();
@endphp
<div class="header row">
    <button class="btn btn-success" id="open-insert-new-temp-reciept-modal">
        <i class="fas fa-plus"></i>
        ثبت رسید موقت
    </button>
</div>
<div class="row">

</div>
<div class="contents">
    <table class="table table-bordered">
        <div class="">
            <thead>
                <tr class="table-primary">
                    <th>
                        ردیف
                    </th>
                    <th>
                        سریال مجموعه کالا
                    </th>
                    <th>
                        تعداد
                    </th>
                    <th>
                        توضیحات
                    </th>
                    <th>
                        عملیات
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($temp_reciept as $item)
                    <tr>
                        <td>
                            {{ $item->id }}
                        </td>
                        <td>
                            {{ $stuffpack->select('serial')->where('id',$item->stuffpack_id)->first() }}
                        </td>
                        <td>
                            {{ $item->count }}
                        </td>
                        <td>
                            {{ $item->description }}
                        </td>
                        <td>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </div>
    </table>
</div>
