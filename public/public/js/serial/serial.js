

var stuffs_serial_list = {};
var rec_id;

filterRecSelectList();

function filterRecSelectList() {

}

$('#serial-get-list-btn').on('click' ,refreshTable)

function refreshTable() {

    rec_id = $('select#select-temp-reciept-for-serial option:selected').val()

    $.ajax({
        url: 'get-serial-items-list',
        type: 'POST',
        data: {
            rec_id: rec_id,

        },
        responseType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        complete: c => {

            if (typeof c.responseJSON !== 'undefined' && c.responseJSON.errors) {
                console.log('errors',c);
            }
            else {
                console.log(c.responseJSON.stuffs);
                $('#serial-list-table tbody').html("");
                $.each(c.responseJSON.stuffs, function (key, stuff) {
                    var _count = parseInt(stuff.count) ? parseInt(stuff.count) : 0;
                    var _used = parseInt(stuff.used) ? parseInt(stuff.used) : 0;
                    
                    var realNeeds = _count - _used;
                    console.log('count: ', _count);
                    console.log('used: ', _used);
                    
                    if( realNeeds > 0 ) {
                        $('#serial-list-table tbody').append(
                            `
                                <tr>
                                    <td colspan="4" class="text-center font-weight-bold bg-dark text-light" >
                                        ${stuff.name}
                                    </td>
                                </tr>
                            `
                        )
                    }
                    for (let i = 1; i <= realNeeds; i++) {
                        $('#serial-list-table tbody').append(
                            `
                                <tr>
                                    <td>
                                        ${i}
                                    </td>
                                    <td>
                                        ${stuff.name}
                                    </td>
                                    <td>
                                        <input type="text" class="form-control serial inset" data-id=
                                        "${stuff.id}-${i}-${rec_id}"
                                         placeholder="سریال"
                                         name = "serial"
                                        value
                                        />
                                    </td>
                                    <td>
                                    <input class="form-control inset" type="text" placeholder="توضیحات" />
                                    </td>
                                </tr>
                                `
                        )
                    }
                })
            }
        }
    })

}

var rec_id;
$(document).on('click', '#save-serial-list-btn', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    rec_id = $('#select-temp-reciept-for-serial option:selected').val();
    $.ajax({
        url: 'insert-serial-list',
        type: 'POST',
        responseType: 'json',
        data: {
            serialList: JSON.stringify(stuffs_serial_list),
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        complete: c => {
            console.log(c);
            if (typeof c.responseJSON !== 'undefined' && c.responseJSON.errors) {
                $('#insert-new-serial-list-response').addClass('alert-danger').removeClass('alert-success')
                $('#insert-new-serial-list-response').append(
                    `
                        <li>
                            ${c.responseJSON.errors}
                        </li>
                    `
                )

            }
            else {
                $('#insert-new-serial-list-response')
                    .addClass('alert-success')
                    .removeClass('alert-danger')
                    .html(`ذخــیره شــد`);
                disableAll();
                refreshTable();// refresh table after save
                enableAll();
                    
            }
        }
    })
})

$(document).on('keyup', '.serial', function (e) {
    stuffs_serial_list[String($(this).attr('data-id'))] = $(this).val();
    console.log($(this).attr('data-id'));
    console.log(stuffs_serial_list);
})


function disableAll() {
    $(document).find('.btn').prop('disabled', true).attr('disabled', true);
    console.log('disabled', Date.now());
}

function enableAll() {
    $(document).find('.btn').prop('disabled', false).attr('disabled', false);
    console.log('enabled', Date.now());
}