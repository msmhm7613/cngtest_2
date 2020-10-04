
function openModal(e,msg){
    e.preventDefault();
    $('#response').addClass('hidden');
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text(msg);
    $('#create').on('hidden.bs.modal', function(){
        location.reload();
    })
}

$(document).on('click', '#newUserBtn', function (e) {

    openModal(e,'کاربر جدید')
    //function add user
    $('button#add').on('click', function () {

        $('#response').html("");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'addUser',
            data: {
                '_token': $('input[name="_token"]').val(),
                'username': $('input[name="username"]').val(),
                'password': $('input[name="password"]').val(),
                'role': $('#role').val(),
                'title': $('#role :selected').text(),
            },
            success: function (data) {
                $('#response').removeClass('hidden')
                if ((data.errors)) {
                    try {
                        console.log(data)

                        if (data.errors.code == "23000") {
                            data.errors.message = "کاربری با این نام قبلا ثبت شده است"
                            $('#response').append('<li>' + data.errors.message + '</li>')
                            return
                        }
                        else {
                            $.each(data.errors, function (keyobj, valueobj) {
                                $('#response').append('<li>' + valueobj + '</li>')
                                return
                                //$('#response').append('<li>' + valueobj + '</li>')
                            })
                        }

                    } catch (e) {
                        $('#response').append('<li>' + data.errors + '</li>')
                    }


                }
                else {
                    $('#response').text('کاربر جدید ثبت شد')
                    $('#insert-user-form input[type="text"]').val("")
                    $('#response').removeClass('alert-danger', 'hidden').addClass('alert-success')
                    console.log(data)
                }
            }
        })
    })
})


//Edit Modal

$(document).on('click', '#btnEdit', function (e) {
    e.preventDefault();


    $('#edit').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('ویرایش کاربر ');


    //function edit user
    $('button#edit').on('click', function (e) {
        console.log(e.target)
        $('#error').html("");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: 'editUser',
            data: {
                '_token': $('input[name="_token"]').val(),
                'username': $('input[name="username"]').val(),
                'password': $('input[name="password"]').val(),
                'role': $('#role').val(),
                'title': $('#role :selected').text(),
                'id': e.target.attr['data-id'],
            },
            success: function (data) {
                /*                 if((data.errors)){
                                    console.log(data.errors);
                                    $.each(data.errors,function(keyobj,valueobj){
                                        console.log(keyobj + ':' +valueobj)
                                        $('#response').append('<li>'+valueobj+'</li>')
                                        $('#response').removeClass('alert-success','hidden').addClass('alert-alert')
                                    })
                                }
                                else
                                {
                                    $('#response').text('کاربر جدید ثبت شد')
                                    $('#insert-user-form input[type="text"]').text("")
                                    $('#response').removeClass('alert-danger','hidden').addClass('alert-success')
                                    console.log(data.status)
                                } */

                console.log(data)
            },

        })
    })

})
