var mydiv, mya;

console.log('my is loaded')

$(document).on("mouseenter mouseleave", "table.table tr", function (e) {
    if (e.type == "mouseenter") {
        // check if it is mouseenter, do something
        try {
            if (e.currentTarget.id == 'tr-1') {
                return;
            }
            else {
                $(this).children('td.operation')[0].firstElementChild.classList.remove('hidden');
            }

        } catch (error) {
            console.log(error)
        }
    } else {
        // if not, mouseleave, do something
        try {

            if (e.currentTarget.id == 'tr-1') {
                return;
            }
            else {
                $(this).children('td.operation')[0].firstElementChild.classList.add('hidden');
            }

        } catch (error) {
            console.log(error)
        }
    }
    return;
});


