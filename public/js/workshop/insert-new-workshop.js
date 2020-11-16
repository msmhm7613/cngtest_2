$(document).on('click', '#insert-new-workshop-save', e => {
    console.log(e);
    e.preventDefault();
    e.stopImmediatePropagation();
    var resBox = $('#insert-new-workshop-response');
    var myForm = $('form#insert-tempstore-form').serializeArray();
    console.log(myForm);
    $.ajax({
        url: 'workshop-create',
        type: 'POST',
        data: {
            name : $('form#insert-tempstore-form input#name').val(),
            manager : $('form#insert-tempstore-form input#manager').val(),
            code : $('form#insert-tempstore-form input#code').val(),
            phone : $('form#insert-tempstore-form input#phone').val(),
            mobile : $('form#insert-tempstore-form input#mobile').val(),
            address : $('form#insert-tempstore-form input#address').val(),
            description : $('form#insert-tempstore-form input#description').val(),
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        responseType: 'json',
        complete: c => {
            console.log('سریال :', $('form#insert-tempstore-form').serialize());
            console.log('ریکوئست :', c );
            if (
                typeof c.responseJSON != 'undefined'
                && c.responseJSON.errors
            ) {
                resBox
                    .html('')
                    .addClass('alert-danger')
                    .removeClass('alert-success')
                    .fadeIn(300);
                $.each(c.responseJSON.errors, (errorKey, error) => {

                    resBox.append(
                        `
                                <li>
                                    ${error}
                                </li>
                            `
                    )

                })
            }
            else {
                resBox
                    .html('')
                    .addClass('alert-success')
                    .removeClass('alert-danger')
                    .fadeIn(300)
                    .html(`
                    <i class="fas fa-tick"></i>
                    کارگاه ثبت شد
                    `);
                $('form#insert-tempstore-form').get(0).reset();

                setTimeout(() => {
                    resBox.fadeOut(1000)
                },1000)
            }
        },
        fail: (jqXhr, textStatus, error ) => {
            resBox
                    .html(jqXhr.responsText)
                    .addClass('alert-danger')
                    .removeClass('alert-success')
                    .fadeIn(300);
        }
    })
})


$(document).on('click', '#insert-new-workshop-open-modal-btn', e => {

    e.preventDefault();
    e.stopImmediatePropagation();

    $('#insert-new-workshop-modal').modal('show');
})