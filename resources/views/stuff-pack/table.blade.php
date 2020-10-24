@guest

    <script>
        window.location('login')

    </script> ;
@endguest

@include('stuff-pack.header')

@if ('App\Models\StuffPack::all()->count()')
    @php $ind = 1 @endphp
    <table class="table table-striped table-bordered " id="stuff-packs-table">
        <thead>
            <tr class="table-primary">
                <th>کد مجموعه کالا</th>
                <th>نام مجموعه کالا</th>
                <th>لیست اقلام</th>
                <th>تعداد کل</th>
                <th>شماره سریال</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
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
        </tfoot>
    </table>
@else
    <div class="mt-3 alert alert-info">
        هنوز هیچ مجموعه کالایی ثبت نشده است.
    </div>
@endif
@include('stuff-pack.footer')
