 $(document).ready(function(){
 	$('.sidenav').sidenav();
 	$('select').formSelect();
 	$('input#input_text, textarea#textarea2').characterCounter();


 	var element = $('.sidenav');
 	var sideMenuInit = M.Sidenav.init(element, {
 		draggable : false
 	});

 	var addprojectmenu = M.Sidenav.getInstance(element);


 	// inisialisasi modal
 	var modal = $('#negoModal');
 	modalInit = M.Modal.init(modal, {
 		dismissible	: false
 	});
 	var negoModal = M.Modal.getInstance(modal);



 	$('.my-sidenav').on('click', '.close-nav-button', function(){
 		addprojectmenu.close();
 	});

 	$('.add-project').on('click', function(){
 		addprojectmenu.open();
 	});

 	$('.card-button').on('click', '#btnNego', function(){
 		addToModal();
 		negoModal.open();
 	});

 	$('.modal').on('click', '#btnClose', function(){
 		negoModal.close();
 		removeModal();
 	});

 });




 function addToModal(){
 	$('.modal-content').append(
 		'<div class="input-field col s12">'+
			'<input type="text" name="title" id="title" class="validate">'+
			'<label for="title">Nama Project</label>'+
		'</div>'
		);
 }

 function removeModal(){
 	$('.modal-content').empty();
 }