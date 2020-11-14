// گرفتن کالاهایی که در رسید سریال برای آن ها ثبت نشده است
function get_stuffs(recipet_no){
    $.ajax({
        url: `check_serial/${recipet_no}`,
        type: 'get',
        success: function (result) {

            $(`#res_${recipet_no}`).removeAttr('class');
            $('#tbl').html('');
            $(`#res_${recipet_no}`).html('در حال جست و جوی اطلاعات');

            if(result['status'] == 1) {
                $(`#res_${recipet_no}`).html(`<table id="tbl_${recipet_no}" class="table table-striped"><thead><tr><th>کد کالا</th><th>نام کالا</th><th>لاتین</th><th>نوع</th></tr></thead>`);
                var i = 1;
                $.each(result['result'], function (key, val) {
                    var stuff_type = 0;
                    if(val['type'] == 1)
                        stuff_type = 'کالا';
                    else
                        stuff_type = 'مجموعه کالا';

                    $(`#tbl_${recipet_no}`).append('<tr>' +
                        `<td>${val['code']}</td>` +
                        `<td>${val['name']}</td>` +
                        `<td>${val['latin_name']}</td>` +
                        `<td>${stuff_type}</td>` +
                        '</tr>');
                });
            } else {
                $(`#res_${recipet_no}`).attr('class','alert alert-warning');
                $(`#res_${recipet_no}`).html(result['msg']);
            }
        }
    });
}
