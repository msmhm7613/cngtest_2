var reciept_list_array = [];
var is_stuffpack = 0;

/**
 * disables all button in the document
 * @param
 *
 * @returns void
 */
function disableAll() {
    $(document).find('.btn', 'button', 'a').attr('disabled', true).prop('disabled', true).off()

}
function enableAll() {
    $(document).find('.btn', 'button', 'a').attr('disabled', false).prop('disabled', false).on()

}

// open insert form
$(document).on('click', '#open-insert-new-temp-reciept-modal', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    disableAll();
    $('#content-box').html('بارگذاری...').load('open-temp-reciept-insert-form', function (xhr) {

    });

    refreshTable();
    enableAll();
})

//add to list
$(document).on('click', '#add-to-items-list-btn', function (e) {

    e.stopImmediatePropagation();
    e.preventDefault();
    console.log($(this));

    let item_name
    let item_id
    let item_code
    let item_num
    let item_unit
    let item_comment
 
    if (is_stuffpack != '0' ) {
        
        console.log(is_stuffpack);
        item_name = $('#stuffpack-select-input :selected').text();
        item_id = $('#stuffpack-select-input :selected').val();
        item_code = $('#stuffpack-select-input :selected').attr('data-stuffpack-code');

        item_unit = 'پک';
    }
    else {
        item_name = $('#stuff-select-input :selected').text();
        item_id = $('#stuff-select-input :selected').val();
        item_code = $('#stuff-select-input :selected').attr('data-stuff-code');
        item_unit = $('#stuff-select-input :selected').attr('data-stuff-unit');

    }
    try {
        item_unit = JSON.parse(item_unit);
    } catch (error) {

    }

    item_num = $('#stuff-number-input').val();
    item_comment = $('#item-comment-input').val() ?? '-';

    checkForExists(data_array = [item_id, item_name, item_num, item_code, item_unit, item_comment]);

    if (reciept_list_array.length == 0) {
        $('p#temp-reciept-list-zero').show();
        $('#insert-new-reciept-save-btn').hide();
        $('#temp-reciept-list-table').hide();
    } else {
        $('p#temp-reciept-list-zero').hide();
        $('#temp-reciept-list-table').fadeIn(300);
        $('#insert-new-reciept-save-btn').show();
        refreshTable();
    }

})


function checkForExists(data_array) {
    console.log('data array : ', data_array);
    breakOut = false;
    $.each(reciept_list_array, function (ind, item) {

        /*         if (item[0] == data_array[0]) {
                   item[2]= data_array[2];
                    breakOut = true;
                    return false;
                } */
    })

    /* if (breakOut) return false; */

    reciept_list_array.push(
        [
            data_array[0],
            data_array[1],
            data_array[2],
            data_array[3],
            data_array[4],
            data_array[5],
            is_stuffpack
        ]
    );

    console.log('reciept_list_array:', reciept_list_array);
    return false;
}


function removeFromList(e) {
    console.log($(e).attr('data-stuff-id'));
    let stuff_id = $(e).attr('data-stuff-id');
    console.log('stuff id for delete: ' + stuff_id);
    reciept_list_array.splice(stuff_id, 1);
    refreshTable();
}


function refreshTable() {
    
    disableAll();
    let stuff_list_table_body = $('#temp-reciept-list-table tbody');
    stuff_list_table_body.html('');
    
    if (reciept_list_array.length == 0 ) {
        $('table#temp-reciept-list-table thead').fadeOut();
        $('#temp-reciept-list-zero').show();
        $('#insert-new-reciept-save-btn').hide();
        console.log('len: ', reciept_list_array.length);
    }

    var sum = 0;
    $.each(reciept_list_array, function (ind, item) {
        sum += parseInt(item.num);
        stuff_list_table_body.append(
            `
                    <tr>
                        <td>
                            ${ind + 1}
                        </td>
                        <td>
                            ${item[3]}
                        </td>
                        <td>
                            ${item[1]}
                        </td>
                        <td>
                            ${item[2]}
                        </td>
                        <td>
                            ${item[4]}
                        </td>
                        <td>
                            ${item[5]}
                        </td>
                        <td>
                            <button
                            class="btn btn-danger text-light btn-sm"
                            data-stuff-id=${ind}
                            title='حذف از لیست'
                            onclick='removeFromList(this);'
                            >
                            <i class='fas fa-trash '></i>
                            <span class="hidden">${ind}</span>
                            </button>
                        </td>
                    </tr>
                `
        );
    })
    stuff_list_table_foot = $('#stuff-list-table tfoot');
    stuff_list_table_foot.html(
        `
            <tr class="table-info">
                <td colspan="2">
                    جــمع کـل:
                </td>
                <td colspan="2">
                    ${parseInt(sum)}
                </td>
            </tr>
        `
    );
    $('#stuff-number-input').val(1);
    $('#stuff-select-input option:eq(0)').attr('selected', true);
    $('#stuffpack-list').val(JSON.stringify(reciept_list_array));
    enableAll();
}


$(document).on('change', 'input[name="temp-reciept-type-radio"]', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    disableAll();
    is_stuffpack = $('input[name="temp-reciept-type-radio"]:checked').val();
    $('#select-stuffpack-to-add, #select-stuff-to-add').toggle(300);
    console.log('is stuffpack: ', is_stuffpack);
    enableAll();
})


$(document).on('click', '#insert-new-reciept-save-btn', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    disableAll();
    console.log('sent list : ',reciept_list_array);
    $.ajax({
        url: 'insert-new-temp-rec',
        type: 'post',
        data: {
            sender : $('#temp-reciept-sender-input').val(),
            reciept_id : $('#temp-reciept-code-input').val(),
            ref_no : $('#temp-reciept-referral-number-input').val(),
            ref_date : $('#temp-reciept-referral-date-input').val(),
            driver : $('#temp-reciept-driver-input').val(),
            car_no : $('#temp-reciept-car-no-input').val(),
            car_type : $('#temp-reciept-car-type-input').val(),
            descriptiom : $('#insert-new-stuffpack-description').val(),

            items_list: reciept_list_array,
        },
        responseType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        complete: c => {
            console.log( 'c', c);
            if (typeof c.responseJSON != 'undefined' && c.responseJSON.errors) {
                $('#insert-new-reciept-response')
                    .html('خطایی رخ داده است.')
                    .fadeIn().addClass('alert-danger');
               
                    $('#insert-new-reciept-response')
                        .append(
                            `<li>
                            ${c.responseJSON.errors[2]}
                            </li>
                            `
                    )
                

            }
            else {
                $('#insert-new-reciept-response')
                    .html('رسید ثبت شد.')
                    .fadeIn()
                    .addClass('alert-success')
                    .removeClass('alert-danger');
            }
            enableAll();
        }
    })
})

$(document).on('click', '#insert-new-reciept-back-btn', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    if($('#temp-reciept-side-menu-btn'))
        $('#temp-reciept-side-menu-btn').get(0).click();
})