@guest

    <script>
        window.location('login')

    </script> ;
@endguest

@include('stuff.header')

@if (App\Models\Stuff::all()->count())
    @php $ind = 1 @endphp
    <table class="table table-striped table-bordered table-responsive" id="stuffs-table">
        <tr class="table-primary">
            <th>ردیف</th>
            <th>کد کالا</th>
            <th>نام کالا</th>
            <th>نام لاتین</th>
            <th>سریال منحصر بفرد</th>
            <th>واحد اندازه‌گیری</th>
            <th>توضیحات</th>
            <th>عملیات</th>
        </tr>

        @foreach (\App\Models\Stuff::all() as $stuff)
            @php
            $unit = \App\Models\Unit::where('id',$stuff->unit_id)->first();
            $user = \App\Models\User::where('id',$stuff->creator_user_id)->first();
            @endphp

            <tr id="{{ $stuff->id }}">
                <td>{{ $ind++ }}</td>
                <td>{{ $stuff->code }}</td>
                <td>{{ $stuff->name }}</td>
                <td class="eng">{{ $stuff->latin_name ?? '-' }}</td>
                <td>{{ $stuff->has_unique_serial ? 'دارد' : 'ندارد' }}</td>
                <td>{{ $unit->name }}</td>
                <td>
                    <p>
                        {{ $stuff->description ?? 'ندارد' }}
                    </p>
                    <i class="fas fa-calendar-check text-success"></i>
                    <small class="text-secondary font-weight-lighter font-italic">
                        ثبت شده توسط : {{ $user->username }} در
                        {{ \App\Http\Controllers\persianDateTimeController::gregorianToPersian($stuff->created_at) }}</small>

                </td>
                <td id="operation">
                    <div class="btns hidden" id="{{ $stuff->id }}">
                        <button class="btn btn-info btn-sm m-0 my-1 d-inline-block w-100 text-center "
                            id="btnEdit" data-id="{{ $stuff->id }}" title="ویرایش"><i class="fas fa-pencil-alt  m-0"></i></button>
                        <button class="btn btn-danger btn-sm m-0 my-1 d-inline-block w-100 text-center " id="btnDel" data-id="{{ $stuff->id }}" title="حذف"><i
                                class="fas fa-trash-alt m-0"></i></button>
                    </div>

                </td>
            </tr>
        @endforeach
    </table>
@else
    <div class="mt-3 alert alert-info">
        هنوز هیچ کالایی ثبت نشده است.
    </div>
@endif
@include('stuff.footer')
