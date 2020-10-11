let menu_item =  $('.side-menu #collapsibleNavbar ul li.nav-item a');



$(document).on('click',menu_item,function(e){
   menu_item.removeClass('active');
   $(e.target).addClass('active');
})


