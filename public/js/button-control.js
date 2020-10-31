function disableAll() {
    $(document).find('.btn').prop('disabled', true).attr('disabled', true).off();
    console.log('disabled', Date.now());
}

function enableAll() {
    $(document).find('.btn').prop('disabled', false).attr('disabled', false).on();
    console.log('enabled', Date.now());
}
