<h4 class=" p-3 text-center text-dark outset bg-lightgreen">
    بخش ارسال اطلاعات
</h4>
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    ارسال اطلاعات
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="importTempstores" method="post" id="insert-new-testImport-form"
                    enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        
              
                    <button type="submit" name="send" class="btn btn-primary">
                        Send
                    </button>
              
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>