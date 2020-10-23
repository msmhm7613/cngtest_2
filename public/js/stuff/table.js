
$('table#stuffs-table tr').on('mouseenter', function (e) {

    let divBtns = $(e.currentTarget).find('div.btns').first()
    divBtns.removeClass('hidden');
    let btnEdit = divBtns.first().find('button#btnEdit');

    btnEdit.on('click', function (e) {
        let id = $(btnEdit).attr('data-id');
        
    })

})

$('table#stuffs-table tr').on('mouseleave', function (e) {
    $(e.currentTarget).find('div.btns').addClass('hidden');
})
