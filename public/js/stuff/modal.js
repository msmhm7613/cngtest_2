var ch = $('input[name="has_unique_serial"]');
var ch2 = $('form#edit-stuff-form input[name="has_unique_serial"]');
var user_id;
var creator_user_id;
var id;
var targetModal;

function openModal(e, msg,targetResponse ) {
    e.preventDefault();
    targetModal.first().modal('show');
    $('.modal-title').first().text(msg);

    targetResponse.first().html('').fadeOut(300);
}


function closeModal() {
    let ind = 1;
    $(document).on('hidden.bs.modal#'+targetModal.first().attr('id'), function () {
        console.log(ind++);
        refreshTable(targetModal);
        return false;
    })
}

function refreshTable(targetModal) {
    $.ajax({
        type: 'GET',
        url: 'new-panel-get-content',
        data: {
            target: 'stuff',
        },
        cache: false,
        async: false,
        timeout: 30000,
        success: function(s)
        {
            $('#content-box').first().html('');

            if ( s.errors )
            {
                console.log(s);
            }
            else
            {
                $('#content-box').first().html(s);
            }
            return false;
        },
        complete: function (c) {
            return c;
            if (c.status == 200)
                $('#content-box').html("please wait...").html(c.responseText);
        }
    });

    return false;
}


// insert new stuff
$(document).on('click', '#insert-new-stuff-button', function (e) {
    user_id = $(e.currentTarget).attr('data-user-id');
    targetModal = $('#insert-new-stuff-modal');
    openModal(e, 'کالای جدید', $('#insert-new-stuff-response'));
    closeModal();
})

//function insert new stuff
$('body').on('click', 'button#insert-new-stuff-save', function (e) {
    e.preventDefault();

    $('#insert-new-stuff-response').html("").fadeOut(300);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'insert-new-stuff',
        async: false,
        cache: false,
        timeout: 30000,
        data: {
            '_token': $('input[name="_token"]').val(),
            'name': $('input[name="name"]').val(),
            'code': $('input[name="code"]').val().replace(/ /g, '-'),
            'latin_name': $('input[name="latin_name"]').val(),
            'unit_id': $('#unit_id :selected').val(),
            'has_unique_serial': ch.is(':checked') ? 1 : 0,
            'description': $('textarea#description').val(),
            'creator_user_id': user_id,
            'modifier_user_id': user_id,
        },
        error: function (er) {
            console.log('error: ' + er);
        },
        success: function (s) {
            $('#insert-new-stuff-response').fadeIn(300);
            if (s.errors) {
                $('#insert-new-stuff-response').removeClass('hidden').html("");
                $('#insert-new-stuff-response').addClass('alert-danger').removeClass('alert-success');
                $.each(s.errors, function (insert_error_key, insert_error_value) {
                    $('#insert-new-stuff-response').append(`<li>${insert_error_value}</li>`);
                })
                return false;
            }
            else{
                $('#insert-new-stuff-response').text('کالا ثبت شد');
                $('#insert-new-stuff-form input[type="text"]').val("")
                $('#insert-new-stuff-form textarea').val("")
                $('#insert-new-stuff-form select option:eq(0)').attr('selected', 'selected')
                $('#insert-new-stuff-response').removeClass('alert-danger', 'hidden').addClass('alert-success');
                return false;
            }
        },
        complete: function (c) {
            //console.log(c);
            return false;

            if (c.errors) {
                $('#insert-new-stuff-response').removeClass('hidden').html("");
                $('#insert-new-stuff-response').addClass('alert-danger').removeClass('alert-success');
                $.each(c.errors, function (insert_error_key, insert_error_value) {
                    $('#insert-new-stuff-response').append(`<li>${insert_error_value}</li>`);
                })
            }
            else {
                $('#insert-new-stuff-response').text('کالا ثبت شد');
                $('#insert-new-stuff-form input[type="text"]').val("")
                $('#insert-new-stuff-form textarea').val("")
                $('#insert-new-stuff-form select option:eq(0)').attr('selected', 'selected')
                $('#insert-new-stuff-response').removeClass('alert-danger', 'hidden').addClass('alert-success')
            }
        }
    })
})


//select stuff

$(document).on('click', '#btnStuffEdit', function (e) {

    e.preventDefault();
    /* var user_id = $(e.currentTarget).attr('data-user-id'); console.log('user id: ' + user_id); */
    creator_user_id = $(e.currentTarget).attr('data-creator-user-id'); console.log('creator user id: ' + creator_user_id);
    //var id = $(e.currentTarget).attr('data-id');console.log('stuff id: ' + id);
    /*$('#stuff-edit-response').addClass('hidden');
    $('#edit-stuff-modal').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('ویرایش کالا');
     $('#edit-stuff-modal').on('hidden.bs.modal', function () {
        $('#define-stuff')[0].click();
    }) */
    openModal(e, $('#edit-stuff-modal'), 'کالای جدید')
    $('.preloader').addClass('hidden');
    id = $(e.currentTarget).attr('data-id');

    $.ajax({
        type: 'GET',
        url: 'selectStuff',
        data: {
            'id': id,
        },
        success: function (data) {
            console.log(data);
            $('#stuff-edit-response').text("")
            $('#stuff-edit-response').removeClass('hidden')
            if (!data.stuff) {
                console.log('stuff does not exist.')
                try {
                    if (data.errors.code == "23000") {
                        data.errors.message = "کالایی با این نام کد ثبت شده است"
                        $('#stuff-edit-response').append('<li>' + data.errors.message + '</li>')

                    }
                    else {
                        $.each(data.errors, function (keyobj, valueobj) {
                            $('#stuff-edit-response').append('<li>' + valueobj + '</li>')

                        })
                    }

                } catch (e) {
                    $('#stuff-edit-response').append('<li>' + data.errors + '</li>')
                }


            }
            else {
                try {

                    $('form#edit-stuff-form input#code').val(data.stuff['code']).attr('placeholder', 'کد جدید کالا')
                    $('form#edit-stuff-form input#name').val(data.stuff['name']).attr('placeholder', 'نام جدید کالا')
                    $('form#edit-stuff-form input#latin_name').val(data.stuff['latin_name']).attr('placeholder', 'نام لاتین جدید کالا')
                    $('form#edit-stuff-form input#has_unique_id').prop('checked', data.stuff['has_unique_serial']);
                    $('form#edit-stuff-form select#unit_id').val(data.stuff['unit_id']);
                    $('form#edit-stuff-form textarea#description').text(data.stuff['description']);


                } catch (error) {
                    // console.log(error)
                }

            }
        }
    })
})
/**
     * ********************
     * UPDATE SQL
     * ********************
     */
$('body').on('click', 'button#edit-stuff-save-btn', function (e) {
    e.preventDefault();
    $('#stuff-edit-response').text('').fadeOut(300);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'editStuff',
        data: {
            '_token': $('form#edit-stuff-form input[name="_token"]').val(),
            'name': $('form#edit-stuff-form input[name="name"]').val(),
            'code': $('form#edit-stuff-form input[name="code"]').val(),
            'latin_name': $('form#edit-stuff-form input[name="latin_name"]').val(),
            'unit_id': $('form#edit-stuff-form #unit_id :selected').val(),
            'has_unique_serial': ch2.is(':checked') ? 1 : 0,
            'description': $('form#edit-stuff-form textarea#description').val(),
            'modifier_user_id': user_id,
            'creator_user_id': creator_user_id,
            'id': id,
        },
        success: function (d) {

            if (d.errors) {
                $.each(d.errors, function (key, error) {
                    $.each(error, function (erkey, ermsg) {
                        console.log(ermsg);
                        $('#stuff-edit-response').fadeIn(300);
                        $('#stuff-edit-response').append(`<li>${ermsg}</li>`);
                        $('#stuff-edit-response').removeClass('hidden').addClass('alert-danger');

                    })
                })

            }
            else {
                $('#stuff-edit-response').text('تغییرات جدید ثبت شد')
                $('#stuff-edit-response').fadeIn(300);
                $('#stuff-edit-response').removeClass('alert-danger', 'hidden').addClass('alert-success')

            }
        }

    })

})

/**
     * START OF DELETE STUFF
     *
     */

$(document).on('click', '#btn-stuff-delete-modal-show', function (e) {
    //select stuff
    e.preventDefault();
    id = $(e.currentTarget).attr('data-id');
    $('#delete-stuff-response').addClass('hidden');
    $('#delete-stuff-modal').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('حذف کالا');
    /*     $('#delete-stuff-modal').on('hidden.bs.modal', function () {
            $('#define-stuff')[0].click();
        }) */

    del_stuff_id = $(e.currentTarget).attr('data-id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: 'selectStuff',
        data: {
            'id': del_stuff_id,
        },
        success: function (data) {
            console.log(data);
            $('span#delete-stuff-name').addClass('text-bold').text(data.stuff.code);
        }
    })
})

$('body').on('click', '#delete-stuff-btn', function (e) {
    e.preventDefault();
    console.log('btn delete clicked.');
    $('#delete-stuff-response').fadeOut(300);
    $.ajax(
        {
            type: 'POST',
            url: 'deleteStuff',
            data: { 'id': del_stuff_id },
            success: function (d) {
                $('#delete-stuff-response').fadeIn(300);
                console.log(d);
                if (d.errors) {
                    console.log(d);
                    $.each(d.errors, function (key, vlaue) {
                        $('#delete-stuff-response').append(`<li>${value}</li>`);
                    })

                }
                else {
                    $('#delete-stuff-response').text('کالا حذف شد.');
                    $('#delete-stuff-btn').fadeOut(300);
                    $('#delete-cancel-btn').text('بستن');

                }
            }
        }
    )
})
