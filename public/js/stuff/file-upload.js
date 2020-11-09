/* function disableAll() {
    $(document).find('.btn').prop('disabled', true).attr('disabled', true).off();
    console.log('disabled', Date.now());
}

function enableAll() {
    $(document).find('.btn').prop('disabled', false).attr('disabled', false).on();
    console.log('enabled', Date.now());
}

$('#insert-new-stuff-file-button').on('click',function(e){
    disableAll();

    $.ajax({
        url : 'new-panel-get-content',
        type: 'GET',
        data: {
            target: 'stuff-file'
        },
        complete: c => {
            $('#content-box').html(c.responseText)
        }

    })
})
 */
