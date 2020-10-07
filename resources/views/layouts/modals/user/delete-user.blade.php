<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert-danger">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title "></h4>
            </div>
            <div class="modal-body">
                <form action="/deleteUser" method="post">
                    @csrf
                </form>
                <span>آیا مطمئنید میخواهید کاربر</span>
                <span id="sureDeleteUsername"></span>
                <span id="sureDeleteRole"></span>
                <span>را حذف کنید؟</span>
            </div>
            <div class="modal-footer">
                <div id="deleteResponse" class="alert alert-danger"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit" id="modalBtnDelete" >
                    <span class="fas fa-delete"></span>
                    حذف
                </button>
                <button class="btn btn-info" id="deleteCancel" type="button"  data-dismiss="modal"  >
                    <span class="fas fa-cancel"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>
