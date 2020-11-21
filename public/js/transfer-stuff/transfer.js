function add_transfer_list() {

    var stuff = $('#stuff_id').val();
    var stuff_pack = $('#stuffpack_id').val();

    if (stuff !== null) {
        var row_count = $('#stuff-body tr').length + 1;
        var code = $('#stuff_id option:selected').attr("data-code");
        var unit = $('#stuff_id option:selected').attr("data-unit");
        var num = $('#stuff-number-input-trnsfer').val();
        var desc = $('#item_stuff_comment').val();

        $('#stuff-body').append('<tr>' +
            '<td>' + row_count + ' </td>' +
            '<td class="code"><input hidden name="stuffs_id[]" value="' + stuff + '">' + code + '</td>' +
            '<td>' + $('#stuff_id option:selected').text() + '</td>' +
            '<td><input hidden name="stuffs_num[]" value="' + num + '">' + num + '</td>' +
            '<td>' + unit + '</td>' +
            '<td></td>' +
            '<td><input hidden name="stuffs_desc[]" value="' + desc + '">' + desc + '</td>' +
            '<td><button type="button" class="btn btn-sm" onclick="remove_row(this)">-</button> </td>' +
            '</tr>');
        $('#stuff_id option:selected').attr('disabled', 'disabled');
        $('#insert-new-reciept-save-btn-trnsfer').attr('class', 'btn btn-success');

    } else if (stuff_pack !== null) {
        var row_count = $('#stuffpack-body tr').length + 1;
        var code = $('#stuffpack_id option:selected').attr("data-code");
        var num = $('#stuffpack-number-input-trnsfer').val();
        var desc = $('#item_stuffpack_comment').val();

        $('#stuffpack-body').append('<tr>' +
            '<td>' + row_count + ' </td>' +
            '<td class="code"><input hidden name="stuffspack_id[]" value="' + stuff + '">' + code + '</td>' +
            '<td>' + $('#stuffpack_id option:selected').text() + '</td>' +
            '<td><input hidden name="stuffspack_num[]" value="' + num + '">' + num + '</td>' +
            '<td>---</td>' +
            '<td><input hidden name="stuffpack_desc[]" value="' + desc + '">' + desc + '</td>' +
            '<td></td>' +
            '<td><button type="button" class="btn btn-sm" onclick="remove_row(this)">-</button> </td>' +
            '</tr>');
        $('#stuffpack_id option:selected').attr('disabled', 'disabled');
        $('#insert-new-reciept-save-btn-trnsfer').attr('class', 'btn btn-success');
    } else {
        $('#result').attr('class', 'alert alert-warning');
        $('#result').html('هیچ کالا یا مجموعه کالایی برای افزودن به لیست انتخاب نشده است');
    }

}

function remove_row(e) {
    $(e).parent().parent().each(function () {
        var code = $(this).find(".code").text();
        $("[data-code=" + code + "]").removeAttr('disabled');
    });
    $(e).parent().parent().remove();
}
