var stuff_list_array = [];


function disableAll() {
    $(document).find('.btn').prop('disabled', true).attr('disabled', true).off();
    console.log('disabled', Date.now());
}

function enableAll() {
    $(document).find('.btn').prop('disabled', false).attr('disabled', false).on();
    console.log('enabled', Date.now());
}

// open insert form
$(document).on('click', '#insert-new-stuff-pack-button', function (e) {
    e.preventDefault();
    $('#content-box').html('بارگذاری...').load('open-insert-form',function(xhr){

    });
    $('#insert-new-stuffpack-save-btn').hide();
   /*  $.ajax({
        url: 'open-insert-form',
        type: 'GET',
        async: false,
        success: function (data) {

            $('#content-box').html('');
            $('#content-box').html(data);
            $('#stuff-list-table').hide();
        }
    }) */


})

//add to list
$(document).on('click', '#add-to-stuffs-list-btn', function (e) {
    e.preventDefault();
    $('#insert-new-stuffpack-save-btn').off().on()
    disableAll()
    let stuff_name = $('#stuff-select-input :selected').text();
    let stuff_id = $('#stuff-select-input :selected').val();
    let stuff_num = $('#stuff-number-input').val();
    disableAll();
    checkForExists(stuff_id, stuff_name, stuff_num);

    if (stuff_list_array.length == 0 ) {
        console.log('disabled');
        $('p#stuff-pack-list').show();
        /* $('#stuff-pack-code-input').attr('disabled',false);
        $('#stuff-pack-name-input').attr('disabled',false);
        $('#stuff-pack-serial-input').attr('disabled',false); */
        $('#insert-new-stuffpack-save-btn').hide();
    } else {
        $('p#stuff-pack-list').hide();
        /* $('#stuff-pack-code-input').attr('disabled',true);
        $('#stuff-pack-name-input').attr('disabled',true);
        $('#stuff-pack-serial-input').attr('disabled',true); */
        $('#stuff-list-table').fadeIn(300);
        $('#insert-new-stuffpack-save-btn').show();
        refreshTable();
    }
    enableAll();
})


function checkForExists(stuff_id, stuff_name, stuff_num) {
    breakOut = false;
    $.each(stuff_list_array, function (ind, item) {

        if (item.id === stuff_id) {
            console.log('stuff: ' + stuff_list_array[ind]);
            stuff_list_array[ind] = {
                id: stuff_id,
                name: stuff_name,
                num: stuff_num
            };
            breakOut = true;
            return false;
        }
    })

    if (breakOut) return false;

    stuff_list_array.push({
        id: stuff_id,
        name: stuff_name,
        num: stuff_num
    });
    return false;
}


function removeFromList(e) {
    console.log($(e).attr('data-stuff-id'));
    let stuff_id = $(e).attr('data-stuff-id');
    console.log('stuff id for delete: ' + stuff_id );
    stuff_list_array.splice(stuff_id, 1);
    refreshTable();
}


function refreshTable() {
    let stuff_list_table = $('#stuff-list-table tbody');
    stuff_list_table.html('');
    if(!stuff_list_array.length)
    {
        $('#stuff-list-table').hide();
        $('p#stuff-pack-list').show();
        $('#insert-new-stuffpack-save-btn').hide();
    }
    $.each(stuff_list_array, function (ind, item) {
        stuff_list_table.append(
            `
                <tr>
                    <td>
                        ${ind+1}
                    </td>
                    <td>
                        ${item.name}
                    </td>
                    <td>
                        ${item.num}
                    </td>
                    <td>
                        <button
                        class="btn btn-danger text-light btn-sm"
                        data-stuff-id=${ind}
                        title='حذف از لیست'
                        onclick='removeFromList(this);'
                        >
                        <i class='fas fa-trash '></i>
                        <span class="hidden">${ind}</span>
                        </button>
                    </td>
                </tr>
            `
        );
    })

    $('#stuff-number-input').val(1);

    console.log(stuff_list_array);

    //$('#content-box').off().find('*').off();

    $('#insert-new-stuffpack-save-btn').on('click',function(e){
        e.preventDefault();
        disableAll();
        if ( !stuff_list_array.length )
        {
            $('#insert-new-stuffpack-response')
            .addClass('alert-danger')
            .removeClass('hidden')
            .html("")
            .html('لیست نباید خالی باشد.')
            return false;
        }
        $('#insert-new-stuffpack-response')
        .html('<span class="spinner-border text-success"></span>' +'ذخیره اطلاعات ...')
        .addClass(['alert', 'alert-success'])
        .removeClass(['alert','alert-danger'])
        $.ajax({
            url: 'insert-new-stuffpack',
            type: 'POST',
            responseType: 'json',
            data: {
                code : $('input#stuff-pack-code-input').val(),
                name : $('input#stuff-pack-name-input').val(),
                serial : $('input#stuff-pack-serial-input').val(),
                description : $('textarea#insert-new-stuffpack-description').val(),
                list : stuff_list_array,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            complete: c => {

                if ( c.responseJSON && c.responseJSON.status )
                {
                    console.log(c.responseJSON);
                    $('#insert-new-stuffpack-response').html('').html('مجموعه کالا ذخیره شد.')
                }
                else{
                    console.log(c);
                }
            }
        })
        enableAll();
    })
}

/*
$('#insert-new-stuffpack-back-btn').on('click',function(e){
    $('#insert-new-stuffpack-back-btn').off();
    e.preventDefault();
    disableAll();

    $.ajax({
        url: '/new-panel',
        type: 'GET',
        data : {target : 'stuff-pack'}
    })

    enableAll();
}) */
