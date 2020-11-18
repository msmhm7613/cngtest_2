<div class="stuff-header">
    <div class="row">
        <div class="col-md-4">
            <a href="#" class="btn btn-success" id="insert-new-stuff-button" data-user-id="{{ Auth::id() }}">
                <i class="fas fa-plus"></i>
                کالای جدید
            </a>

        </div>
        <div class="col-md-4">
            <a href="{{asset('tempUpload/sample.xlsx')}}" style="color: white" class="btn btn-secondary">
                <i class="fas fa-download"></i>
                دانلود فایل نمونه
            </a>
        </div>
        <div class="col-md-4">
            <form id="insert-new-stuff-file-upload-form" method="post" class="d-inline p-0"
                enctype="multipart/form-data" action="insert-new-stuff-file" name="myForm">
                @csrf
                <div class="form-group">
                    <input type="file" accept=".xlsx" class="mb-2 form-control-file border" name="file">
                    <button class="form-control btn btn-primary" type="submit" id='file-save-btn' name="submit">
                        <i class="fas fa-file-upload"></i>
                        ارسال فایل
                    </button>
                </div>
            </form>
        </div>

    </div>
    <div class="progress bg-dark">
        <div class="progress-bar" style="width:0%;" aria-valuenow="0"
            aria-valuemax="100">
            <div class="percent">0%</div>
        </div>
    </div>

    <div id="fileupload-response">

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