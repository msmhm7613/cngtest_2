<div class="stuff-header">
    <div>
        <a href="#"
        class="btn btn-success"
        id="insert-new-stuff-button"
        data-user-id="{{ Auth::id() }}">
            <i class="fas fa-plus"></i>
            کالای جدید
        </a>
        <a href="{{asset('tempUpload/sample.csv')}}" style="color: white"
           class="btn btn-info">
            <i class="fas fa-download"></i>
            دانلود فایل نمونه
        </a>
        <form id="form" action = {{route('uploadStuff')}} method="post" class="d-inline p-0" enctype="multipart/form-data">
        @csrf
            <label
            for="file-form-1"
        class="btn btn-info text-light m-0"
        id="insert-new-stuff-file-button">
            <i class="fas fa-file-upload "></i>
            ارسال از طریق فایل
        </label>
        <input type="file" id="file-form-1" style="display: none" name="file">
        </form>

    </div>

    {{-- <table class="table table-striped table-bordered " id="stuffs-table">
        <thead>
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
        </thead> --}}
</div>
<script>

    document.getElementById("file-form-1").onchange = function() {
        document.getElementById("form").submit();
    };
</script>

