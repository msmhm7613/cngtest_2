var user_id;

/**
 * Click event for open insert new stuff modal.
 */
$(document).on('click', '#insert-new-stuff-button', function (e) {
    disableAll();
    user_id = $(e.currentTarget).attr('data-user-id')

    $('#insert-new-stuff-modal').modal('show');
    $('.horizontal-form').show();
    enableAll();
})

function disableAll() {
    $(document).find('.btn').prop('disabled', true).attr('disabled', true);
    console.log('disabled', Date.now());
}

function enableAll() {
    $(document).find('.btn').prop('disabled', false).attr('disabled', false);
    console.log('enabled', Date.now());
}

$('#insert-new-stuff-save').on('click', (e) => {
    disableAll();
    console.log($('input[name="unit_id"]').find('option :selected'))
    let code = $('#insert-new-stuff-form input#code').val();
    code = code.split(' ').join('-');
    $('#insert-new-stuff-form input#code').val(code);


    var bre = false;

    $.ajax({
        url: 'insert-new-stuff',
        type: 'post',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            _token              : $('input[name="_token"]').val(),
            code                : $('input[name="code"]').val(),
            name                : $('input[name="name"]').val(),
            creator_user_id     : user_id,
            modifier_user_id    : user_id,
            unit_id             : $('input[name="unit_id"]').find('option :selected').val(),
            has_unique_serial   : $('#has_unique_serial').is(':checked')?1:0,
         },
        cache: false,
        complete: (c) => {
            console.log('c', c);

            if ( typeof (c.responseJSON) !== 'undefined' && c.responseJSON) {
                try {
                    console.log(c.responseJSON);
                    $('#insert-new-stuff-response')
                        .html("").show().addClass('alert-danger')
                    console.log(c.responseJSON.errors);
                    $.each(c.responseJSON.errors, function (i, er) {
                        $.each(er, function (ier, mer) {
                            $('#insert-new-stuff-response')
                                .append(
                                    `<li>
                                ${mer}
                            </li>
                            `
                                )
                        })
                    })
                    bre = true;
                    return false;
                }
                catch(ex)
                {
                    console.log('ex',ex);
                }
            } else if (!bre) {
                console.log('c.responseTEXT', c.responseText);


            }
        }
    })

    enableAll();
})
