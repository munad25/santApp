 $(document).ready(function(){
 	$('.sidenav').sidenav();
 	$('select').formSelect();
 	$('input#input_text, textarea#deskripsi').characterCounter();

 	var element = $('.sidenav');
 	var sideMenuInit = M.Sidenav.init(element, {
 		draggable : false
 	});

 	var addprojectmenu = M.Sidenav.getInstance(element);


 	$('.my-sidenav').on('click', '.close-nav-button', function(){
 		addprojectmenu.close();
 	});

 	$('.add-project').on('click', function(){
 		addprojectmenu.open();
 	});

 });