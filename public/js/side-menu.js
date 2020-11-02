var preloader = $('#preloader');
var content_box = $('#content-box');

$('#preloader').hide();

let menu_item = $('.side-menu #collapsibleNavbar ul li.nav-item a');

$(menu_item).on('click', function (e) {
    $('#preloader').show();
    $(menu_item).removeClass('active');
    $(e.target).addClass('active');

    let targetController = ($(e.target).attr('data-controller'))

    /* $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }


    });
    $.ajax({
        url: 'new-panel',
        type: 'POST',
        data: {
            '_token': $('input[name="_token"]').val(),
            'target': targetController,
        },
        beforeSend: () => {
            //content_box.html($(preloader).html());
            //$('#content-box').fadeOut('300ms');
            $(preloader).show();

        },
        complete: () => {
            //console.log('completed');
            $(preloader).hide();

            console.log($('table#stuffs-table'));
            $('#stuffs-table').DataTable;
        },
        success: function (d) {
            //console.log('success');
            content_box.html(d);
            $(document).off().find('*').off();
            //$('#content-box').fadeIn('300ms');
        }

    }) */

    $('div#content-box').first().load(
        'new-panel', {
            '_token': $('input[name="_token"]').val(),
            'target': targetController
        },
        function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
              $('#preloader').hide();
            if(statusTxt == "error")
                $('#preloader').html('خطا در ایجاد صفحه');
        }
    )
})

if ($('#dashboard-btn'))
    $('#dashboard-btn').triggerHandler('click');
