


var user_id, stuff_id,doc ;

doc = $('#content-box').html();

/**
 *
 * Click event for open insert new stuff modal.
 *
 */
$(document).on('click', '#insert-new-stuff-button', function (e) {
    disableAll();
    user_id = $(e.currentTarget).attr('data-user-id')

    $('#insert-new-stuff-modal').modal('show');
    //$('.horizontal-form').show();
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

$(document).on('click', '#insert-new-stuff-save', (e) => {
    //disableAll();
    $('#insert-new-stuff-response')
                    .html("")
                    .show()
                    .removeClass('alert-success', 'text-center')
                    .addClass('alert-danger')
                    .html('')
    let code = $('#insert-new-stuff-form input#code').val();
    code = code.split(' ').join('-');
    $('#insert-new-stuff-form input#code').val(code);
    var bre = false;
    $.ajax({
        url             : 'insert-new-stuff',
        type            : 'post',
        dataType        : 'json',
        responseType    : 'document',
        headers         : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            _token                  : $('input[name="_token"]')                     .val(),
            code                    : $('input[name="code"]')                       .val(),
            name                    : $('input[name="name"]')                       .val(),
            latin_name              : $('input[name="latin_name"]')                 .val(),
            creator_user_id         : user_id,
            modifier_user_id        : user_id,
            unit_id                 : $('form#insert-new-stuff-form select#unit_id option:selected').val(),
            has_unique_serial       : $('#has_unique_serial').is(':checked')        ? 1 : 0,
            description             : $('textarea#edit-stuff-description')          .val(),
        },
        cache: false,
        complete: c => {
            if ( checkForResponse(c.responseJSON, $('#insert-new-stuff-response')) )
            {
                $('#insert-new-stuff-response')
                    .html("")
                    .show()
                    .addClass('alert-success', 'text-center')
                    .removeClass('alert-danger')
                    .html('کالا ثبت شد.')
                doc = c.responseText;
                $('#insert-new-stuff-form input[type="text"]').val("");
                $('#insert-new-stuff-form textarea').val("");
                $('form#insert-new-stuff-form select#unit_id option').eq(0).attr('selected', true);
                $('form#insert-new-stuff-form input[type="checkbox"]').attr('checked', true);
                //location.reload();
                enableAll();

            }
            else if ( bre )
            {
                $('#insert-new-stuff-response')
                .html("").show().addClass('alert-danger')
            }
               //$("[data-dismiss=modal]").trigger({ type: "click" });
        }
    })
})


function checkForResponse($response,$responseDiv)
{
    if (typeof ($response) !== 'undefined' && $response) {
        try {
            $.each($response.errors, function (i, er) {
                $.each(er, function (ier, mer) {
                    $responseDiv
                        .append(
                            `<li>
                        ${mer}
                    </li>
                    `
                        )
                })
            })
            return false;
        } catch (ex) {
            console.log('ex', ex);
        }
    }
    else{
        return true;
    }
}


$('#insert-new-stuff-modal').on('hidden.bs.modal', function (e) {
    //code...
})

$('#insert-new-stuff-modal  button[data-dismiss="modal"]').on('click', function (e) {
    console.log('modal close button clicked.', e);
    $('.fade.modal-backdrop.show').removeClass('show').removeClass('modal-backdrop');
    $('#insert-new-stuff-modal').modal('show');
    $('#content-box').html('...').html(doc);

})


/**
 *
 * SELECT STUFF
 *
 */

$(document).on('click', '#edit-stuff-modal-open-btn', function (e) {
    //user_id = $(e.currentTarget).attr('data-user-id');
    //stuff_id= $(e.currentTarget).attr('data-stuff-id');
})


/**
 *
 *
 * EDIT STUFF
 *
 */

$(document).on('click', '#edit-stuff-modal-open-btn', function (e) {
    disableAll();
    stuff_id = $(e.currentTarget).attr('data-stuff-id');
    $('#edit-stuff-modal').modal('show');
    //$('.horizontal-form').show();
    // get stuff info
    $.ajax({
        url                    : 'select-stuff',
        data                   :  {'id' : stuff_id, },
        type                   : 'GET',

        complete               : c => {
               console.log('c',c);
               if ( c )
               {
                   console.log(c.responseJSON.name);
                   $('form#edit-stuff-form input#edit-stuff-code-input').val(c.responseJSON.code);
                   $('form#edit-stuff-form input#edit-stuff-name-input').val(c.responseJSON.name);
                   $('form#edit-stuff-form input#edit-stuff-latin_name-input').val(c.responseJSON.latin_name);
                   //$(`form#edit-stuff-form select#edit-unit-id-select option[value="${c.responseJSON.unit_id}]"`).prop('selected',true);
                   $(`form#edit-stuff-form select#edit_unit_id_select option[value="${c.responseJSON.unit_id}"]`).attr('selected',true);
                   $(`form#edit-stuff-form input#has_unique_id`).attr('checked',c.responseJSON.has_unique_serial?true:false);
                   $(`form#edit-stuff-form textarea#edit-stuff-description`).val(c.responseJSON.description);
               }
        }
    })

    enableAll();
})

/**
 *
 * UPDATE EDITED STUFF IN DB
 *
 */

 $(document).on('click','#edit-stuff-save-btn',function(e){
     disableAll();
     $.ajax({
        url                     :'edit-stuff',
        type                    :'post',
        responseType            :'json',
        data: {
            _token              : $('input[name="_token"]'),
            stuff_id ,
            code                : $('input#edit-stuff-code-input')       .val(),
            name                : $('input#edit-stuff-code-name')        .val(),
            latin_name          : $('input#edit-stuff-latin_name-input') .val(),
            has_unique_serial   : $('#has_unique_serial').is(':checked') ? 1 : 0,
            unit_id             : $('select#unit_id option:selected').val(),
            description         : $('textarea#edit-stuff-description')   .val(),
        },
        headers                 : {
                'X-CSRF-TOKEN'  : $('meta[name="csrf-token"]').attr('content')
        },
        complete                : c => {
            if ( checkForResponse(c.responseJSON, $('#stuff-edit-response')) )
            {
                $('#stuff-edit-response')
                    .html("")
                    .show()
                    .addClass('alert-success', 'text-center')
                    .removeClass('alert-danger')
                    .html('کالا ثبت شد.')
                doc = c.responseText;
                $('#edit-stuff-form input[type="text"]').val("");
                $('#edit-stuff-form textarea').val("");
                $('form#edit-stuff-form select#edit_unit_id_select option').eq(0).attr('selected', true);
                $('form#edit-stuff-form input[type="checkbox"]').attr('checked', true);
                //location.reload();
                enableAll();
                bre = true;
            }
            else if ( bre )
            {
                $('#edit-stuff-form')
                .html("").show().addClass('alert-danger')
            }
        }
     });
 })


/**
 *
 *
 * DELETE STUFF
 *
 */
