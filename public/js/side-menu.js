
    var preloader = $('#content-box .preloader');
    var content_box = $('#content-box');
    preloader.hide();

    let menu_item = $('.side-menu #collapsibleNavbar ul li.nav-item a');

    $(menu_item).on('click', function (e) {

        $(menu_item).removeClass('active');
        $(e.target).addClass('active');

        preloader.fadeIn();

        let targetController = ($(e.target).attr('data-controller'))
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'panel',
            type: 'POST',
            data: {
                '_token': $('input[name="_token"]').val(),
                'target': targetController,
            },
            success: function (d) {
                preloader.fadeOut();
                content_box.html(d);
            }
        })
    })

    if($('#dashboard-btn'))
    $('#dashboard-btn').triggerHandler('click');
