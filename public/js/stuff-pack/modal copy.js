
var user_id;
var creator_user_id;
var id;
var targetModal;
var stuff_array_list = [];


function openModal(e, msg, targetModal) {
    e.preventDefault();
    targetModal.first().modal('show');
    $('.modal-title').first().text(msg);

    targetResponse.first().html('').fadeOut(300);
}


function closeModal() {
    let ind = 1;
    $(document).on('hidden.bs.modal',function(e) {

        console.log(ind++);
        refreshTable(targetModal);

    })
}

function refreshTable(targetModal) {
    $.ajax({
        type: 'GET',
        url: 'new-panel-get-content',
        data: {
            target: 'stuff-pack',
        },
        cache: false,
        async: false,
        timeout: 30000,
        success: function (s) {
            $('#content-box').first().html('');


            if (s.errors) {
                console.log(s);
            }
            else {
                $('#content-box').first().html(s);
            }

        },
        complete: function (c) {
            return c;
            if (c.status == 200)
                $('#content-box').html("please wait...").html(c.responseText);
        }
    });

    return false;
}


// insert new stuff-pack
$(document).on('click', '#insert-new-stuff-pack-button', function (e) {
    e.preventDefault();
    //$(document).off().find("*").off();// remove all click events from document. this prevents jQuery to repeat a click event automatically .
    user_id = $(e.currentTarget).attr('data-user-id');
    targetModal = $('#insert-new-stuff-pack-modal');
    openModal(e, 'مجموعه کالای جدید', $('#insert-new-stuff-pack-response'));
    closeModal();


})

// add to list btn clicked
$('body').on('click', '#add-to-stuffs-list-btn',
    function stuff_add_to_list(e) {
        e.preventDefault();
        var stuff_name = $('select#stuff-select-input :selected').text();
        var stuff_id = $('select#stuff-select-input').val();
        var stuff_count = $('input#stuff-number-input').val();
        var stuff_list = $('ol#stuff-array-list');
        stuff_array_list.push([`${stuff_id}`, stuff_count]);
        console.log(stuff_array_list);
        console.log(stuff_list);
        stuff_list.append(`
    <li>
    <div class="row" style="margin:3px 1px !important;">
    <div class="col-9">
    ${stuff_name}
    </div>
    <div class="">
    ${stuff_count}
    </div>
    </div>`
        );

    }

)

//function insert new stuff-pack
$('body').on('click', 'button#insert-new-stuff-pack-save', function (e) {
    e.preventDefault();

    $('#insert-new-stuff-pack-response').html("").fadeOut(300);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'insert-new-stuffpack',
        async: false,
        cache: false,
        timeout: 30000,
        data: {
            '_token': $('input[name="_token"]').val(),
            'name': $('input[name="name"]').val(),
            'code': $('input[name="code"]').val().replace(/ /g, '-'),
            'serial': $('input[name="serial"]').val(),
            'description': $('textarea#description').val(),
            'creator_user_id': user_id,
            'modifier_user_id': user_id,
        },
        error: function (er) {
            console.log('error: ' + er);
        },
        success: function (s) {
            $('#insert-new-stuff-pack-response').fadeIn(300);
            if (s.errors) {
                $('#insert-new-stuff-pack-response').removeClass('hidden').html("");
                $('#insert-new-stuff-pack-response').addClass('alert-danger').removeClass('alert-success');
                $.each(s.errors, function (insert_error_key, insert_error_value) {
                    $('#insert-new-stuff-pack-response').append(`<li>${insert_error_value}</li>`);
                })
                return false;
            }
            else {
                $('#insert-new-stuff-pack-response').text('مجموعه کالا ثبت شد');
                $('#insert-new-stuff-pack-form input[type="text"]').val("")
                $('#insert-new-stuff-pack-form textarea').val("")
                $('#insert-new-stuff-pack-form select option:eq(0)').attr('selected', 'selected')
                $('#insert-new-stuff-pack-response').removeClass('alert-danger', 'hidden').addClass('alert-success');
                return false;
            }
        },
        complete: function (c) {
            //console.log(c);
            return false;

            if (c.errors) {
                $('#insert-new-stuff-pack-response').removeClass('hidden').html("");
                $('#insert-new-stuff-pack-response').addClass('alert-danger').removeClass('alert-success');
                $.each(c.errors, function (insert_error_key, insert_error_value) {
                    $('#insert-new-stuff-pack-response').append(`<li>${insert_error_value}</li>`);
                })
            }
            else {
                $('#insert-new-stuff-pack-response').text('کالا ثبت شد');
                $('#insert-new-stuff-pack-form input[type="text"]').val("")
                $('#insert-new-stuff-pack-form textarea').val("")
                $('#insert-new-stuff-pack-form select option:eq(0)').attr('selected', 'selected')
                $('#insert-new-stuff-pack-response').removeClass('alert-danger', 'hidden').addClass('alert-success')
            }
        }
    })
})


//select stuff-pack

$(document).on('click', '#btnStuffEdit', function (e) {

    e.preventDefault();
    /* var user_id = $(e.currentTarget).attr('data-user-id'); console.log('user id: ' + user_id); */
    creator_user_id = $(e.currentTarget).attr('data-creator-user-id'); console.log('creator user id: ' + creator_user_id);
    //var id = $(e.currentTarget).attr('data-id');console.log('stuff-pack id: ' + id);
    /*$('#stuff-pack-edit-response').addClass('hidden');
    $('#edit-stuff-pack-modal').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('ویرایش کالا');
     $('#edit-stuff-pack-modal').on('hidden.bs.modal', function () {
        $('#define-stuff-pack')[0].click();
    }) */
    openModal(e, $('#edit-stuff-pack-modal'), 'کالای جدید')
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
            $('#stuff-pack-edit-response').text("")
            $('#stuff-pack-edit-response').removeClass('hidden')
            if (!data.stuff - pack) {
                console.log('stuff-pack does not exist.')
                try {
                    if (data.errors.code == "23000") {
                        data.errors.message = "کالایی با این نام کد ثبت شده است"
                        $('#stuff-pack-edit-response').append('<li>' + data.errors.message + '</li>')

                    }
                    else {
                        $.each(data.errors, function (keyobj, valueobj) {
                            $('#stuff-pack-edit-response').append('<li>' + valueobj + '</li>')

                        })
                    }

                } catch (e) {
                    $('#stuff-pack-edit-response').append('<li>' + data.errors + '</li>')
                }


            }
            else {
                try {

                    $('form#edit-stuff-pack-form input#code').val(data.stuff - pack['code']).attr('placeholder', 'کد جدید کالا')
                    $('form#edit-stuff-pack-form input#name').val(data.stuff - pack['name']).attr('placeholder', 'نام جدید کالا')
                    $('form#edit-stuff-pack-form input#latin_name').val(data.stuff - pack['latin_name']).attr('placeholder', 'نام لاتین جدید کالا')
                    $('form#edit-stuff-pack-form input#has_unique_id').prop('checked', data.stuff - pack['has_unique_serial']);
                    $('form#edit-stuff-pack-form select#unit_id').val(data.stuff - pack['unit_id']);
                    $('form#edit-stuff-pack-form textarea#description').text(data.stuff - pack['description']);


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
$('body').on('click', 'button#edit-stuff-pack-save-btn', function (e) {
    e.preventDefault();
    $('#stuff-pack-edit-response').text('').fadeOut(300);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'editStuff',
        data: {
            '_token': $('form#edit-stuff-pack-form input[name="_token"]').val(),
            'name': $('form#edit-stuff-pack-form input[name="name"]').val(),
            'code': $('form#edit-stuff-pack-form input[name="code"]').val(),
            'latin_name': $('form#edit-stuff-pack-form input[name="latin_name"]').val(),
            'unit_id': $('form#edit-stuff-pack-form #unit_id :selected').val(),
            'has_unique_serial': ch2.is(':checked') ? 1 : 0,
            'description': $('form#edit-stuff-pack-form textarea#description').val(),
            'modifier_user_id': user_id,
            'creator_user_id': creator_user_id,
            'id': id,
        },
        success: function (d) {

            if (d.errors) {
                $.each(d.errors, function (key, error) {
                    $.each(error, function (erkey, ermsg) {
                        console.log(ermsg);
                        $('#stuff-pack-edit-response').fadeIn(300);
                        $('#stuff-pack-edit-response').append(`<li>${ermsg}</li>`);
                        $('#stuff-pack-edit-response').removeClass('hidden').addClass('alert-danger');

                    })
                })

            }
            else {
                $('#stuff-pack-edit-response').text('تغییرات جدید ثبت شد')
                $('#stuff-pack-edit-response').fadeIn(300);
                $('#stuff-pack-edit-response').removeClass('alert-danger', 'hidden').addClass('alert-success')

            }
        }

    })

})

/**
     * START OF DELETE STUFF
     *
     */

$(document).on('click', '#btn-stuff-pack-delete-modal-show', function (e) {
    //select stuff-pack
    e.preventDefault();
    id = $(e.currentTarget).attr('data-id');
    $('#delete-stuff-pack-response').addClass('hidden');
    $('#delete-stuff-pack-modal').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('حذف کالا');
    /*     $('#delete-stuff-pack-modal').on('hidden.bs.modal', function () {
            $('#define-stuff-pack')[0].click();
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
            $('span#delete-stuff-pack-name').addClass('text-bold').text(data.stuff - pack.code);
        }
    })
})

$('body').on('click', '#delete-stuff-pack-btn', function (e) {
    e.preventDefault();
    console.log('btn delete clicked.');
    $('#delete-stuff-pack-response').fadeOut(300);
    $.ajax(
        {
            type: 'POST',
            url: 'deleteStuff',
            data: { 'id': del_stuff_id },
            success: function (d) {
                $('#delete-stuff-pack-response').fadeIn(300);
                console.log(d);
                if (d.errors) {
                    console.log(d);
                    $.each(d.errors, function (key, vlaue) {
                        $('#delete-stuff-pack-response').append(`<li>${value}</li>`);
                    })

                }
                else {
                    $('#delete-stuff-pack-response').text('مجموعه کالا حذف شد.');
                    $('#delete-stuff-pack-btn').fadeOut(300);
                    $('#delete-stuff-pack-cancel-btn').text('بستن');

                }
            }
        }
    )
})
