

$(document).on('click', '#serial-get-list-btn', function (e) {
    e.stopImmediatePropagation();
    e.preventDefault();
    console.log($('select#select-temp-reciept-for-serial option:selected').val())
    console.log('clicked');
    $.ajax({
        url: 'get-serial-items-list',
        type: 'POST',
        data: {
            rec_id: $('select#select-temp-reciept-for-serial option:selected').val(),

        },
        responseType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        complete: c => {
            if (typeof c.responseJSON != 'undefined' && c.responseJSON.errors) {
                console.log(c);
            }
            else {
                if (typeof c.responseJSON.stuffs != 'undefined' && c.responseJSON.stuffs) {
                    $.each(c.responseJSON.stuffs, function (key, stuff) {

                        for (let i = 1; i < stuff.count; i++) {
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
                                        <input type="text" class="form-control inset" id="serial-${stuff.name}-${stuff.coutn}" placeholder="سریال" />
                                    </td>
                                    <td>
                                    <input class="form-control inset" type="text" id="desc-${stuff.name}-${stuff.coutn}" placeholder="توضیحات" />
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