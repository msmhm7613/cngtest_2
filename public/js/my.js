var mydiv, mya;

$("tr").on("mouseenter", function(e) {
    e.preventDefault();
    mydiv = $(this).children("div.hide")[0];
    $(mydiv).css("display", "block");
    console.log("enter");
    if ($(this).attr("contenteditable")) {
        $(this).css("background-color", "rgba(20,170,25,0.3)");
        $(this).css("border", "none");
        $(this).css("outline", "none");
        mydiv = $(this).children("div")[0];
        mya = $(mydiv).children("a")[0];
        $(mya).css("display", "block");
        $(mya).attr("contenteditable", false);
    }
    $(this).on("mouseOver", function() {});
});

$(mya).on("click", function() {});

$("td").on("blur", function(e) {
    e.preventDefault();
    $(this).css("background-color", "rgba(20,170,25,0.0)");
    const mydiv = $(this).children("div")[0];
    const mya = $(mydiv).children("a")[0];
    $(mya).css("display", "none");
});
