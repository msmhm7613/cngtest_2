var user_id, stuff_id, doc;

doc = $('#content-box').html();
/**
 *
 * Click event for open insert new stuff modal.
 *
 */
$('#insert-new-stuff-button').on('click', function (e) {
    clickedButton = $(this).first().get();
    user_id = $(clickedButton).attr('data-user-id')
    $('#insert-new-stuff-modal').modal('show');
})
function disableAll() {
    $(document).find('.btn').prop('disabled', true).attr('disabled', true);
    console.log('disabled', Date.now());
}

function enableAll() {
    $(document).find('.btn').prop('disabled', false).attr('disabled', false);
    console.log('enabled', Date.now());
}

function reloadTable(e) {
    /* modalClosed = $(e).get(0);
    if ( modalClosed )
        $(modalClosed).trigger('click'); */

    sideMuneBtn = $('#define-stuff').get(0);
    if (sideMuneBtn)
        document.getElementById(sideMuneBtn.id).click();

}

$('#insert-new-stuff-modal').on('hidden.bs.modal', function (e) {
    reloadTable($(this));
})

$('#insert-new-stuff-save').on('click', (e) => {
    $('#insert-new-stuff-response')
        .removeClass('alert-success', 'text-center')
        .addClass('alert-danger')
        .html("")
        .fadeOut();
    let code = $('#insert-new-stuff-form input#code').val();
    code = code.split(' ').join('-');
    $('#insert-new-stuff-form input#code').val(code);
    var bre = false;
    $.ajax({
        url: 'insert-new-stuff',
        type: 'post',
        dataType: 'json',
        responseType: 'document',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        async: true,
        data: {
            _token: $('input[name="_token"]').val(),
            code: $('input#code').val(),
            name: $('input[name="name"]').val(),
            latin_name: $('input[name="latin_name"]').val(),
            creator_user_id: user_id,
            modifier_user_id: user_id,
            unit_id: $('form#insert-new-stuff-form select#unit_id option:selected').val(),
            has_unique_serial: $('#has_unique_id').first().is(':checked') ? 1 : 0,
            description: $('textarea#edit-stuff-description').val(),
        },

        complete: c => {

            if (typeof c.responseJSON != 'undefined' && c.responseJSON.errors) {
                $('#insert-new-stuff-response')
                    .removeClass('alert-success')
                    .addClass('alert-danger')
                    .html(c.responseJSON.errors)
                    .fadeIn()
                $.each(c.responseJSON.errors, function (key, value) {
                    $('#insert-new-stuff-response')
                        .append(
                            `
                            <li>
                                ${value[0]}
                            </li>
                            `
                        ).fadeIn();
                })
            }
            else {
                $('#insert-new-stuff-response')
                    .html("")
                    .addClass('alert-success', 'text-center')
                    .removeClass('alert-danger')
                    .html('کالا ثبت شد.')
                    .fadeIn()
                doc = c.responseText;
                $('#insert-new-stuff-form input[type="text"]').val("");
                $('#insert-new-stuff-form textarea').val("");
                $('form#insert-new-stuff-form select#unit_id option').eq(0).attr('selected', true);
                $('form#insert-new-stuff-form input[type="checkbox"]').attr('checked', true);
            }
        }
    })
})


function checkForResponse($response, $responseDiv) {
    if (typeof ($response) !== 'undefined' && $response) {
        try {
            if ($response.errors)
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
    else {
        return true;
    }
}

/**
 *
 *
 * EDIT STUFF
 *
 */
$('#edit-stuff-modal').on('hidden.bs.modal', function (e) {
    reloadTable($(this));
})


$('.edit-stuff-modal-open-btn').on('click', function (e) {
    clickedButton = $(this).first().get();
    stuff_id = $(clickedButton).attr('data-stuff-id');
    console.log('stuff id: ' + stuff_id);
    $('#edit-stuff-modal').modal('show');
    //$('.horizontal-form').show();

    // get stuff info

    $.ajax({
        url: 'select-stuff',
        data: { 'id': stuff_id, },
        type: 'GET',
        responseType: 'json',
        complete: c => {
            console.log('c', c);
            if (typeof c.responseJSON != 'undefined') {
                console.log(c.responseJSON.name);
                $('form#edit-stuff-form input#edit-stuff-code-input').val(c.responseJSON.code);
                $('form#edit-stuff-form input#edit-stuff-name-input').val(c.responseJSON.name);
                $('form#edit-stuff-form input#edit-stuff-latin_name-input').val(c.responseJSON.latin_name);
                $(`form#edit-stuff-form select#edit_unit_id_select option[value="${c.responseJSON.unit_id}"]`).attr('selected', true);
                $(`form#edit-stuff-form input#has_unique_serial`).attr('checked', c.responseJSON.has_unique_serial ? true : false);
                $(`form#edit-stuff-form textarea#edit-stuff-description`).val(c.responseJSON.description);

            }
        }
    })
})

/**
 *
 * UPDATE EDITED STUFF IN DB
 *
 */

$('#edit-stuff-save-btn').on('click', function (e) {

    $('#stuff-edit-response')
        .html("")
        .show()
        .removeClass('alert-success', 'text-center')
        .addClass('alert-danger')
    disableAll();
    $.ajax({
        url: 'edit-stuff',
        type: 'POST',
        async: true,
        data: {
            _token: $('input[name="_token"]').val(),
            id: stuff_id,
            code: $('input#edit-stuff-code-input').val(),
            name: $('input#edit-stuff-name-input').val(),
            latin_name: $('input#edit-stuff-latin_name-input').val(),
            has_unique_serial: $('input#has_unique_serial').is(':checked') ? 1 : 0,
            unit_id: $('select#edit_unit_id_select option:selected').val(),
            description: $('textarea#edit-stuff-description').val(),
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        complete: c => {
            console.log(c.responseJSON);

            if (typeof (c.responseJSON) != 'undefined' && c.responseJSON.errors)//(typeof (c.responseJSON.errors) !== 'undefined' && c.responseJSON.errors)
            {
                $('#stuff-edit-response')
                    .html("")
                    .removeClass('alert-success')
                    .addClass('alert-danger')
                $.each(c.responseJSON.errors, function (errKey, errVal) {
                    $('#stuff-edit-response').append(
                        `<li> ${errVal} </li>`
                    )
                })
            }
            else if (c.responseText) {
                $('#stuff-edit-response')
                    .html("")
                    .show()
                    .addClass('alert-success', 'text-center')
                    .removeClass('alert-danger')
                    .html('تغییرات کالا ثبت شد.')
                doc = c.responseText;
                bre = true;
            }
            else if (bre) {
                var err = c.responseText;
                $('#edit-stuff-form')
                    .html("<br/>:خطا" + err).show().addClass('alert-danger')
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

$('.delete-stuff-modal-open-btn').on('click', function (e) {
    console.log(e);
    clickedButton = $(this).first().get();
    console.log(clickedButton);
    stuff_id = $(clickedButton).attr('data-stuff-id');
    console.log('stuff id: ' + stuff_id);

    $('#delete-stuff-modal').modal('show');

    $.ajax({
        url: 'select-stuff',
        type: 'get',
        responseType: 'json',
        data: { id: stuff_id }, async: true,
        complete: c => {
            console.log(c);
            if (c.responseJSON) {

                $('#delete-stuff-name').html('').html(c.responseJSON.code);
            }
        }
    })
})


$('#delete-stuff-btn').on('click', function (e) {
    $.ajax({
        url: 'delete-stuff',
        type: 'post',
        data: { id: stuff_id, _token: $('input[name=_token]').val() },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, async: true,
        complete: c => {
            console.log(c);
            if (typeof (c.responseJSON) != 'undefined' && c.responseJSON.errors) {
                $('#delete-stuff-response').html(c.responseJSON.errors).show();
            }
            else {
                $('#delete-stuff-response').html('کالا حذف شد.').show();

            }
            $('#delete-stuff-btn').fadeOut(300).hide();
            $('#delete-cancel-btn').html('بستن');

        }
    })

})


$('#delete-stuff-modal').on('hidden.bs.modal', function (e) {
    reloadTable();
})



/* $(document).on('click', "#insert-new-stuff-file-button", function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var stuffFile = $('form#insert-new-stuff-file-upload-form input[name="stuff-file-input"]')[0].files.FileList;

    console.log('stuffFile',stuffFile);
    $("#insert-new-stuff-file-response")
        .removeClass()
        .addClass(['alert', 'alert-info', 'text-center', 'justify-content-center'])
        .html(`
                        <span class="spinner spinner-border text-info"></span>
                        <span class="text-info">
                            در حال ارسال فایل...
                        </span>
                    `)
        .fadeIn(300);
    $.ajax({
        url: 'insert-new-stuff-file',
        type: 'post',
        enctype: 'multipart/form-data',
        data: {
            file: stuffFile,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        responseType: 'json',
        complete: c => {
            console.log('c', c);
        }
    })
}) */


/**
 * 
 * Send file to the controller for inserting stuffs into the table 
 

var request = new XMLHttpRequest();
var resBox = document.getElementById('insert-new-stuff-file-response');
resBox.style.display = "none";

var uploadForm = document.querySelector('form#insert-new-stuff-file-upload-form');

console.log($('input[type="file"]'));
console.log('val: ', $('input[type="file"]').val());

request.upload.addEventListener('load', res => {
    resBox.classList = [];
    resBox.classList.add(['alert', 'alert-info']);
    resBox.innerHTML = `
    بارگذاری کامل شد.
    `
    resBox.style.display = "block";
})
uploadForm.addEventListener('submit', e => {
    e.preventDefault();
    console.log($('input[type="file"]'));
    console.log('val: ',$('input[type="file"]').val());
    var formData = new FormData(uploadForm);
    formData.append('excelFile', $('input[type="file"]').val(), $('input[type="file"]')[0].files);
    //request.open('post', 'insert-new-stuff-file');
    request.send(formData);
}, false);


$(window).load(function () {

    var uploadForm = $('#insert-new-stuff-file-upload-form');
    var bar = $('.progress-bar');
    var percent = $('.percent');
    var status = $('#insert-new-stuff-file-response');

    $('#insert-new-stuff-file-button').on('click', e => {
        e.stopImmediatePropagation();
        e.preventDefault();
    })

    console.log(uploadForm);
    uploadForm.ajaxForm({
        url: 'insert-new-stuff-file',
        type: 'POST',
        responseType: 'json',
        beforeSend: function () {
            alert(status);
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function (data) {
            if (data.errors) {
                console.log(data);

            }
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function (xhr) {
            console.log('xhr', xhr)
        }
    });

})*/


/* 
var upForm = document.getElementById('insert-new-stuff-file-upload-form');
var bar = document.querySelector('.progress .progress-bar');
var percent = document.querySelector('.percent');
var status = document.querySelector('#status');

console.log(upForm);

upForm.ajaxForm({
    beforeSend: function () {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function (event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function () {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    complete: function (xhr) {
        status.html(xhr.responseText);
    }
}); */
/* $(document).on('click', '#insert-new-stuff-file-button', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    $.getScript('public/js/jquery-form/jquery.form.min.js', function (data, textStatus, jqxhr) {
        var formData = new FormData();
        console.log(formData);
    });
}); */


$('#file-save-btn').on('click', function (e) {
    e.preventDefault();
    
    $.getScript('public/js/jquery-form/jquery.form.min.js', () => {
        var myForm = document.getElementById('insert-new-stuff-file-upload-form');
        var fd = new FormData(e.currentTarget.form)
        
        var target = $('#fileupload-response');
        var bar = $('.progress-bar');
        var percent = $('.percent');
        var status = target;
        
        $('#insert-new-stuff-file-upload-form').ajaxSubmit(
            {
                url: 'insert-new-stuff-file',
                type: 'post',
                target: '#fileupload-response',
                forceSync: true,
                beforeSend: function() {
                    status.empty();
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },
                success: c => {
                    target.fadeOut(300);
                    console.log('c', c)
                    var brk = false;
                    if (c.errors.lenght > 0 ) {
                        $.each(c.errors, (errKey, errVal) => {
                            target
                                .addClass(['row', 'alert', 'alert-danger'])
                                .fadeIn(300)
                                .append(`
                                        <li>
                                            ${JSON.stringify(errVal)}
                                        </li>
                                        `);
                        } )
                        brk = true;
                    }
                    else {
                        target
                            .removeClass()
                            .addClass(['alert', 'alert-success', 'row'])
                            .html(`${c.success} مورد ذخیره شد.`)
                            .fadeIn(300);
                        setTimeout(function () {
                            sideMuneBtn = $('#define-stuff').get(0);
                            if (sideMuneBtn)
                                document.getElementById(sideMuneBtn.id).click(); }, 3000);
                    }
                },
                error: err =>
                {
                    console.log('err', c);
                    if (c.errors) {
                        $.each(c.errors, (errKey, errVal) => {
                            $(target)
                                .addClass(['row', 'alert', 'alert-danger'])
                                .fadeIn(300)
                                .append(`
                                        <li>
                                            ${errVal}
                                        </li>
                                        `);
                        } )
                        
                    }
                }
            }
        ).resetForm();
        return false;
    })
});
