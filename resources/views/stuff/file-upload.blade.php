    <div class="container">
        <h4>
            فرم ارسال فایل
        </h4>
    </div>
    <div class="form">
        {!! Form::open(['url' => 'upload-stuff-file', 'files' => 'true']) !!}
        <div class="form-group file">
            {!! Form::file('stuff_file') !!}

        {!! Form::submit('ارسال...',['class'=>'btn btn-success']) !!}
    </div>
        {!! Form::close() !!}
    </div>


