<div class="modal fade" id="insert-new-store">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="insert-store-form">
                    @csrf
                    <div class="form-group row add">
                       <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="نام انبار" id="name" name="name">
                                @error('name')
                                    <small id="small-1">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="role" id="role" class="form-control">
                                    <option value=1>
                                        {{ 'مدیر سیستم' }}
                                    </option>
                                    <option value=2>
                                        {{ 'مسئول سایت' }}
                                    </option>
                                    <option value=3>
                                        {{ 'پیمانکار' }}
                                    </option>
                                    <option value=4>
                                        {{ 'انبار' }}
                                    </option>
                                    <option value=5>
                                        {{ 'انبار موقت' }}
                                    </option>
                                    <option value=6>
                                        {{ 'کارگاه' }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger errors hidden" id="response"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="add">
                    <span class="fas fa-plus"></span>
                    اضافه
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal"  >
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/store/modal.js') }}"></script>
