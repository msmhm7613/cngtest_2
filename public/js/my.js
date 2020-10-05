var mydiv, mya;

$("tr").on("mouseenter", function (e) {
    e.preventDefault();
    try {
        $(this).children('td.operation')[0].firstElementChild.classList.remove('hidden');
    } catch (error) {
        //console.log(error)
    }
});

$("tr").on("mouseleave", function (e) {
    e.preventDefault();
    try {
        $(this).children('td.operation')[0].firstElementChild.classList.add('hidden');
    } catch (error) {
        //console.log(error)
    }
});
