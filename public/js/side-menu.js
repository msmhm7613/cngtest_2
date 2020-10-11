let menu_item =  $('.side-menu #collapsibleNavbar ul li.nav-item a');



$(menu_item).on('click',function(e){
   $(menu_item).removeClass('active');
   $(e.target).addClass('active');
})


