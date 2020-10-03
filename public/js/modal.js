

$(document).on('click','#newUserBtn', function(e){
    e.preventDefault();

    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('کاربر جدید');


    //function add user
    $('button#add').on('click',function(){
        console.log('salam')
        $('#error').html("");
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
            type:'POST',
            url: 'addUser',
            data: {
                '_token': $('input[name="_token"]').val(),
                'username':$('input[name="username"]').val(),
                'password':$('input[name="password"]').val(),
                'role': $('#role').val(),
                'title': $('#role :selected').text(),
            },
            success : function(data){
                if((data.errors)){
                    console.log(data.errors);
                    $.each(data.errors,function(keyobj,valueobj){
                        console.log(keyobj + ':' +valueobj)
                        $('#error').append('<li>'+valueobj+'</li>')
                    })
                }
                else
                {

                }
            }
        })
    })
})


//Edit Modal

$(document).on('click','#btnEdit',function(e){
    e.preventDefault();


    $('#edit').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('ویرایش کاربر ');


    //function edit user
    $('button#edit').on('click',function(e){
        console.log(e.target)
        $('#error').html("");
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.ajax({
            type:'POST',
            url: 'editUser',
            data: {
                '_token': $('input[name="_token"]').val(),
                'username':$('input[name="username"]').val(),
                'password':$('input[name="password"]').val(),
                'role': $('#role').val(),
                'title': $('#role :selected').text(),
                'id': e.target.attr['data-id'],
            },
            success : function(data){
                if((data.errors)){
                    console.log(data.errors);
                    $.each(data.errors,function(keyobj,valueobj){
                        console.log(keyobj + ':' +valueobj)
                        $('#error').append('<li>'+valueobj+'</li>')
                    })
                }
                else
                {

                }
            }
        })
    })

})
