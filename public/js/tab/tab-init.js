
$.ajax({
    type: 'GET',
    url: 'init_panel',
    data: {

        btn_1: {
            url: '#insert-new-user-form-btn-show',
            text: 'کاربر',
            icon: 'user',
            target: 'users',
            active: 1,
        },
        btn_2: {
            url: '#temp-store-table',
            text: 'انبار موقت',
            icon: 'wrench',
            target: 'temp-store-table',
            active: 0,
        },

    },
    success:
        function (data) {
            $('#tab-content').html(data);
        }
});


