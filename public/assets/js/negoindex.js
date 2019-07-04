 $(document).ready(function(){
 	// alert('test');

 	// inisialisasi modal
 	


 	$('#homeListNego').on('click', '.btnNego', function(){
 		var dataBtn = $(this).attr('data-button');
 		var idProject = $(this).attr('data-id-project');
 		console.log(idProject);
 		if(dataBtn == 'nego'){
 			addToModal('nego', 'nego-getone/'+idProject);
 		}
 		else if(dataBtn == 'cancel'){
 			$('.modal-content').removeAttr('modal-content');
 			addToModal('cancel', 'nego-getone/'+idProject);
 		}
 		myModal('open');
 	});


 	$('.modal-footer').on('click', '#btnY', function(){
 		var dataModal = $('.modal-content').attr('modal-content');
 		var dataId = $('.deal-content').attr('data-project');

 		
 		action(dataModal, dataId);
 		


 	});

 	$('.modal-footer').on('click', '#btnN', function(){
 		var dataModal = $('.modal-content').attr('modal-content');
 		console.log(dataModal);
 		myModal('close');
 		removeModal();
 	});

 	$('#homeListNego').on('click', '.btnAggre', function(){
 		var dataId = $(this).attr('data-project');
 		removeModal();
 		addToModal('aggre', 'nego-getone/'+dataId);
 		myModal('open');

 		console.log(dataId);
 	});


 	getAll();


 });





 function addToModal(param, myurl){
 	if(param == 'nego'){
 		$('#btnY').text("NEGO");
 		$('#btnN').text("CANCEL");

 		$('.modal-content').attr('modal-content', 'nego');
 		$('.modal-content').append(
 			'<div class="input-field col s12 deal-content">'+
 			'<input type="text" name="harga" id="harga" class="validate">'+
 			'<label for="title">Ajukan Harga</label>'+
 			'</div>'
		);

		$.ajax({
 			type: 'get',
 			dataType : 'JSON',
 			url	: myurl,
 			success : function(data){
 				$.each(data, function(index, element){
 					$('.modal-content').find('.deal-content').removeAttr('data-project');
 					$('.modal-content').find('.deal-content').attr('data-project', element.id_project);
 				})
 			}
 		});

 	}else if(param == 'cancel'){
 		$('.modal-content').attr('modal-content', 'cancel');
 		$('.modal-content').append(
 			'<div class="col s12 deal-content" data-project="">'+
 			'<p></p>'+
 			'<p> Apakah anda ingin membatalkan project ini? </p>'+
 			'</div>'
 		);

 		$.ajax({
 			type: 'get',
 			dataType : 'JSON',
 			url	: myurl,
 			success : function(data){
 				$.each(data, function(index, element){
 					$('.modal-content').find('.deal-content').removeAttr('data-project');
 					$('.modal-content').find('.deal-content').attr('data-project', element.id_project);
 				})
 			}
 		});
 	}
 	else if(param == 'aggre'){

 		$.ajax({
 			type : 'get',
 			dataType: 'JSON',
 			url : myurl,
 			beforeSend : function(){
 				$('#btnY').text("Ya");
 				$('#btnN').text("Tidak");

 				$('.modal-content').append(
 					'<div class="preloader-wrapper small active center-align">'+
 					'<div class="spinner-layer spinner-blue-only">'+
 					'<div class="circle-clipper left">'+
 					'<div class="circle"></div>'+
 					'</div><div class="gap-patch">'+
 					'<div class="circle"></div>'+
 					'</div><div class="circle-clipper right">'+
 					'<div class="circle"></div>'+
 					'</div>'+
 					'</div>'+
 					'</div>'
 					);
 			},
 			success : function(data){
 				$('.modal-content').attr('modal-content', 'aggre');
 				$.each(data, function(index, element){
 					console.log(element);
 					$('.modal-content').append(
 						'<div class="col s12 deal-content" data-project="'+element.id_project+'">'+
 						'<p class="harga-deal">Rp.'+element.harga_nego+'</p>'+
 						'<p> Apakah anda setuju? </p>'+
 						'</div>'
 						);
 				});

 			}
 		}).always(function(){
 					$('.preloader-wrapper').remove();
 		});

 	}

 }

 function removeModal(){
 	$('.modal-content').empty();
 }


 function getAll(){
 	$.ajax({
 		type : "get",
 		url : "nego-getall", 
 		dataType : 'JSON',
 		beforeSend : function(){

 		},
 		success : function(data){
 			console.log(data);
 			$.each(data, function(index, element){
 				
 				if(element.negosiator != 'admin'){
 					 dataButton = 'cancel';
 					 label 	= 'CANCEL';
 					
 				}else{
 					dataButton = 'nego';
 					label	= 'NEGO';
 				}

 				$('#homeListNego').append(
 					'<div class="col s12 nego-body">'+
 					'<div class="card ">'+
 					'<div class="card-content my-card">'+
 					'<span class="card-title">'+element.id_project+'</span>'+
 					'<div class="divider"></div>'+
 					'<br>'+
 					'<div class="card-button">'+
 					'<span class="my-btn btnAggre"  data-project="'+element.id_project+'">Setuju</span>'+
 					'<span class="my-btn modal-trigger btnNego" data-button="'+dataButton+'"  data-id-project="'+element.id_project+'">'+label+'</span>'+
 					'</div>'+
 					'</div>'+
 					'</div>'+
 					'</div>'
 				);

 				
 			});
 		}
 	

 	})

 }


function myModal(param){
	var Elm = $('#negoModal');
 	var modalInit = M.Modal.init(Elm, {
 		dismissible : false
 	});

 	var getModal = M.Modal.getInstance(Elm);

 	if(param == 'open'){
 		getModal.open()
 	}
 	else if(param == 'close'){
 		getModal.close();
 	}



}

 function action(dataModal, param = null){
 		var negourl = '';
 		var method = '';
 		var dataToSend = ''

 		if(dataModal == 'cancel'){
 			negourl = 'nego-cancel/'+param;
 			method = 'get';
 		}
 		else if(dataModal == 'nego'){
 			dataToSend = $('#harga').val();
 			negourl = 'nego-update/'+param+'/'+dataToSend;
 			method = 'get'
 		}
 		else if(dataModal == 'aggre'){
 			negourl = 'nego-jadi/'+param;
 			method = 'get'
 		}

 		$.ajax({
 			type : method,
 			dataType : 'JSON',
 			url : negourl,
 			data : dataToSend,
 			success : function(data){
 				console.log(data);
 				$('#homeListNego').empty();
 				getAll();

 				myModal('close');
 				removeModal();
 			}


 		});
 	
 }