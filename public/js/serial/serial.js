
let stuffs_serial_list = {};
var rec_id;
$(document).on('click', '#serial-get-list-btn', function (e) {

    e.stopImmediatePropagation();
    e.preventDefault();
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
            console.log(c);
            if (typeof c.responseJSON != 'undefined' && c.responseJSON.errors) {
                console.log(c);
            }
            else {
                if (typeof c.responseJSON.stuffs != 'undefined' && c.responseJSON.stuffs) {
                    $.each(c.responseJSON.stuffs, function (key, stuff) {

                        for (let i = 1; i <= stuff.count; i++) {
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
                                        <input type="text" class="form-control serial inset" data-id="${stuff.id}-${i}-${rec_id}"  placeholder="سریال" />
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
        }
    })
})

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
                $('#insert-new-serial-list-response').addClass('alert-success').removeClass('alert-danger').html(`
                    ذخــیره شــد
                `)
            }
        }
    })
})

$(document).on('keyup', '.serial', function (e) {
    stuffs_serial_list[String($(this).attr('data-id'))] = $(this).val();
    console.log($(this).attr('data-id'));
    console.log(stuffs_serial_list);
})