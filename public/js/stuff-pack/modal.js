var stuff_list_array = [];


// open insert form
$(document).on('click', '#insert-new-stuff-pack-button', function (e) {
    e.preventDefault();
    $('#content-box').html('بارگذاری...').load('open-insert-form',function(xhr){
        
    });
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

    let stuff_name = $('#stuff-select-input :selected').text();
    let stuff_id = $('#stuff-select-input :selected').val();
    let stuff_num = $('#stuff-number-input').val();

    checkForExists(stuff_id, stuff_name, stuff_num);

    if (!stuff_list_array.length) {
        $('p#stuff-pack-list').show();

    } else {
        $('p#stuff-pack-list').hide();
        $('#stuff-list-table').fadeIn(300);
        refreshTable();
    }
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
                        <span>${ind}</span>
                        </button>
                    </td>
                </tr>
            `
        );
    })

    $('#stuff-number-input').val(1);

    console.log(stuff_list_array);
}
