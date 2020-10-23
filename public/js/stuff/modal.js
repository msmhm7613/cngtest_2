var ch = $('input[name="has_unique_serial"]');
var ch2 = $('form#edit-stuff-form input[name="has_unique_serial"]');

function openModal(e, targetModal, msg) {
    e.preventDefault();
    $('#response').addClass('hidden');
    $('#' + targetModal[0].id).modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text(msg);
    $('#' + targetModal[0].id).on('hidden.bs.modal', function () {
        let active_item = $('.side-menu a.active');
        $('#' + active_item[0].id)[0].click();
    })
}

// insert new stuff

$(document).on('click', '#insert-new-stuff-button', function (e) {

    var user_id = $(e.currentTarget).attr('data-user-id'); console.log($user_id);
    openModal(e, $('#insert-new-stuff-modal'), 'کالای جدید')
    //function add stuff
    $('button#add').on('click', function () {
        $('#response').html("");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'insert-new-stuff',
            data: {
                '_token': $('input[name="_token"]').val(),
                'name': $('input[name="name"]').val(),
                'code': $('input[name="code"]').val(),
                'latin_name': $('input[name="latin_name"]').val(),
                'unit_id': $('#unit_id :selected').val(),
                'has_unique_serial': ch.is(':checked') ? 1 : 0,
                'description': $('textarea#description').val(),
                'creator_user_id': user_id,
                'modifier_user_id': user_id,
            },
            cache: false,
            success: function (d) {
                $('#response').removeClass('hidden').html("");

                if (d.errors) {
                    try {

                        if (d.errors.code == "23000") {
                            d.errors.message = "کالا با این نام قبلا ثبت شده است"
                            $('#response').append('<li>' + d.errors.message + '</li>')
                            return
                        }
                        else {
                            console.log(d.errors)
                            $.each(d.errors, function (keyobj, valueobj) {
                                $('#response').append('<li>' + valueobj + '</li>')
                                $('#' + keyobj).addClass('error');
                            })
                            return
                        }
                    } catch (e) {
                        $('#response').append('<li>error:' + d.errors + '</li>')
                        return
                    }
                }
                else {
                    $('#response').text('کالا ثبت شد')
                    $('#insert-new-stuff-form input[type="text"]').val("")
                    $('#insert-new-stuff-form textarea').val("")
                    $('#insert-new-stuff-form select option:eq(0)').attr('selected', 'selected')
                    $('#response').removeClass('alert-danger', 'hidden').addClass('alert-success')
                }
            }
        })
    })
})


//select stuff

$(document).on('click', '#btnStuffEdit', function (e) {

    e.preventDefault();
    var user_id = $(e.currentTarget).attr('data-user-id'); console.log('user id: ' + user_id);
    var creator_user_id = $(e.currentTarget).attr('data-creator-user-id'); console.log('creator user id: ' + creator_user_id);
    //var id = $(e.currentTarget).attr('data-id');console.log('stuff id: ' + id);
    $('#response').addClass('hidden');
    $('#edit-stuff-modal').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('ویرایش کالا');
    $('#edit-stuff-modal').on('hidden.bs.modal', function () {
        $('#define-stuff')[0].click();
    })
    $('.preloader').addClass('hidden');
    var id = $(e.currentTarget).attr('data-id');

    $.ajax({
        type: 'GET',
        url: 'selectStuff',
        data: {
            'id': id,
        },
        success: function (data) {
            console.log(data);
            $('#response').text("")
            $('#response').removeClass('hidden')
            if (!data.stuff) {
                console.log('stuff does not exist.')
                try {
                    if (data.errors.code == "23000") {
                        data.errors.message = "کالایی با این نام کد ثبت شده است"
                        $('#response').append('<li>' + data.errors.message + '</li>')
                        return
                    }
                    else {
                        $.each(data.errors, function (keyobj, valueobj) {
                            $('#response').append('<li>' + valueobj + '</li>')
                            return
                        })
                    }

                } catch (e) {
                    $('#response').append('<li>' + data.errors + '</li>')
                }


            }
            else {
                try {

                    $('form#edit-stuff-form input#code').val(data.stuff[0]['code']).attr('placeholder', 'کد جدید کالا')
                    $('form#edit-stuff-form input#name').val(data.stuff[0]['name']).attr('placeholder', 'نام جدید کالا')
                    $('form#edit-stuff-form input#latin_name').val(data.stuff[0]['latin_name']).attr('placeholder', 'نام لاتین جدید کالا')
                    $('form#edit-stuff-form input#has_unique_id').prop('checked', data.stuff[0]['has_unique_serial']);
                    $('form#edit-stuff-form select#unit_id').val(data.stuff[0]['unit_id']);
                    $('form#edit-stuff-form textarea#description').text(data.stuff[0]['description']);
                    return;

                } catch (error) {
                    // console.log(error)
                }

            }
        }
    })

    /**
     * ********************
     * UPDATE SQL
     * ********************
     */
    $('button#edit-stuff-save-btn').on('click', function (e) {
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
                            $('#stuff-edit-response').text('error');
                            $('#stuff-edit-response').append(`<li>${ermsg}</li>`);
                            $('#stuff-edit-response').removeClass('hidden').addClass('alert-danger')
                        })
                    })
                    return;
                }
                else {
                    console.log($('#response'));
                    $('#stuff-edit-response').text('تغییرات جدید ثبت شد')
                    $('#stuff-edit-response').removeClass('alert-danger', 'hidden').addClass('alert-success')
                    return;
                }
            }

        })

    })
    /**
     * END OF UPDATE

    */


})


/**
     * START OF DELETE USER
     *
     */

$(document).on('click', '#btnDelete', function (e) {

    //select user

    e.preventDefault();
    id = $(e.currentTarget).attr('data-id');
    if (id == 1)
        return;
    $('#deleteResponse').addClass('hidden');
    $('#deleteModal').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('حذف کاربر');
    $('#deleteModal').on('hidden.bs.modal', function () {

    })

    del_id = $(e.currentTarget).attr('data-id');
    var del_role;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: 'selectUser',
        data: {
            'id': del_id,
        },
        success: function (data) {
            console.log(data.user[0]['username']);
            if (data.user) {
                $('#deleteResponse').removeClass('hidden');
                $('#sureDeleteUsername').text(" " + data.user[0]['username'] + " ")
                $('#sureDeleteRole').text(" " + data.user[0]['title'] + " ")
                del_role = data.user[0]['role'];
            }
            else {
                $('#deleteResponse').removeClass('hidden');
                $('#selectResponse').val(data.errors['message'])
            }
        }
    })

    $('#modalBtnDelete').on('click', function (e) {

        console.log(del_id);
        $.ajax(
            {
                type: 'POST',
                url: '/deleteUser',
                data: { 'id': del_id, 'role': del_role },
                success: function (d) {
                    if (d.errors) {
                        console.log(d);

                    }
                    else {
                        $('#deleteResponse').text('کاربر حذف شد.');
                        $('#modalBtnDelete').fadeOut(300);
                        $('#deleteCancel').text('بستن');
                    }
                }
            }
        )
    })

})

// Insert new workshop

$(document).on('click', '#insert-new-workshop-modal-btn', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: 'insertNewWorkshopForm',
        data: { r: Math.random() },
        success: function (d) {
            $('.ajax-content').css('opacity', '0');
            $('#preloader').show();
            $('.ajax-content').first().html(d);
            $('.ajax-content').css('opacity', '1');;
        }
    });

})

// Insert new contractor

$(document).on('click', '#new-temp-modal-opener-btn', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: 'insert_new_contractor_form',
        data: { r: Math.random() },
        success: function (d) {
            $('.ajax-content').css('opacity', '0');
            $('#preloader').show();
            $('.ajax-content').first().html(d);
            $('.ajax-content').css('opacity', '1');;
        }
    });

})


// insert new contractor
$(document).on('click', '#insert-new-contractor-form-show-btn', function (e) {
    e.preventDefault();

})
