$(document).ready(function(){
	
 	$('select').formSelect();
 	$('input#input_text, textarea#deskripsi').characterCounter();
 	$('.collapsible').collapsible();

 	
 	$('.add-project').on('click', function(){
 		mySideNav('open');

 	});

 	$('.close-nav-button').on('click', function(){
 		mySideNav('close');

 	});

	$('#btnAddProject').on('click', function(){
		addProject();
	});

	$('#formAddProject').on('focus', '.validate', function(){
		$('.helper-text').remove();
		$('.validate').removeClass('invalid');
	})

	$('#homeListProject').on('click', '.btn-detail-project', function(){
		var dataProject = $(this).attr('data-project');
		console.log('test');
		getOne(dataProject);
		myModal('detail','open');
	})

	$('#homeListProject').on('click', '.btn-progress-project', function(){
		var dataProject = $(this).attr('data-project');
		console.log(dataProject);
		getProgress(dataProject);
		myModal('progress','open');
	})

	$('#modalProgress .modal-footer').on('click', '#btn-close-progress', function(){
		myModal('progress', 'close');
		
	});

	$('#modalDetail .modal-footer').on('click', '#btn-close-detail', function(){
		myModal('detail', 'close');
		
	});

	$('#homeListProject').empty();
	getAll();
})


function getAll(){
	$.ajax({
		type	: "get",
		url		: "project-getall",
		dataType: "JSON",
		success	: function(data){
			var classStatus ='';
			var statusLabel = '';


			$.each(data, function(index, element){

				if(element.status_pengerjaan == 4){
					classStatus = 'complete';
					statusLabel = 'complete';
				}
				else{
					 classStatus ='';
					 statusLabel = '';
				}


				$('#homeListProject').append(
					'<div class="col s12">'+
						'<div class="card ">'+
							'<div class="card-content">'+
								'<div class="my-content">'+
									'<span class="">'+element.id_project+'</span>'+
									'<span class="right btn-detail-project" data-project="'+element.id_project+'">DETAIL</span>'+
									'<span class="right btn-progress-project" data-project="'+element.id_project+'">PROGRESS</span>'+
									'<span class="right status '+classStatus+'" >'+statusLabel+'</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
				);
			});
		}
	});
}

function getOne(id){
	$('#btnY').text('Tutup');
	$.ajax({
		type	: "get",
		url		: "project-detail/"+id,
		dataType: "JSON",
		success	: function(data){
			// console.log(data);
			$.each(data, function(index, element){
				$('#modalDetail .modal-content').append(
					'<ul class="collection">'+
						'<li class="collection-item">ID Project :'+element.id_project+'</li>'+
						'<li class="collection-item">Jenis Project: '+element.jenis_project+'</li>'+
						'<li class="collection-item">Deskripsi '+element.keterangan+'</li>'+
						'<li class="collection-item">Status Project :</li>'+
					'</ul>'
				);
			});
		}
	});
}

function getProgress(id){
	$.ajax({
		type	: "get",
		url		: "get-progress/"+id,
		dataType: "JSON",
		success : function(data){
			console.log(data);

			if(data.length == 0){
				$('.collapsible').hide();
				$('#modalProgress .modal-content').append(
					'<p id="alert">Project ini belum ada perogress</p>'
				);
			}
			else{
				$('p#alert').remove();
				$('.collapsible').show();
				$.each(data, function(index, element){
					$('#modalProgress .modal-content .collapsible').append(
						'<li>'+
						'<div class="collapsible-header"><i class="fas fa-tasks"></i><span id="progress-title">'+element.tanggal+'</span></div>'+
						'<div class="collapsible-body"><span>'+element.keterangan+'</span></div>'+
						'</li>'
						);
				});

			}
		}
	});

}


function addProject(){
	$.ajax({
		type:'post',
		dataType: 'JSON',
		url : 'add-project',
		data: $('#formAddProject').serialize(),
		success:function(data){
			console.log(data);
			if(data.status == 'failed'){
				$.each(data.mesage, function(index, element){
					$('#'+index).addClass('invalid');
					$('#'+index).parent().append('<span class="helper-text" data-error="* '+element+'">*pilih kategori project</span>');

				});
			}else if(data.status == 'success'){
				$('#homeListProject').empty();
				getAll();
				mySideNav('close');
			}
		}
	});
}


function mySideNav($param){
	$('.sidenav').sidenav();

	var element = $('.sidenav');
 	var sideMenuInit = M.Sidenav.init(element, {
 		draggable : false
 	});

 	var addprojectmenu = M.Sidenav.getInstance(element);

 	if($param == 'open'){
 		addprojectmenu.open();
 	}
 	else if($param == 'close'){
 		addprojectmenu.close();
 	}
}



function myModal(param = null , action){
	console.log(param);
	console.log(action);
	var modalDetail = $('#modalDetail');
 	var modalDetailInit = M.Modal.init(modalDetail, {
 		dismissible : false,
 		});
 	

 	var getModalDetail = M.Modal.getInstance(modalDetail);

 	var modalProgress = $('#modalProgress');
 	var modalProgressInit = M.Modal.init(modalProgress, {
 		dismissible : false,
 		});
 	
 	
 	var getModalProgress = M.Modal.getInstance(modalProgress);

 	if(param == 'progress'){
 		if(action == 'open'){
 			getModalProgress.open();
 		}else if(action == 'close'){
 			$('body').css({overflow: 'visible'});


 			getModalProgress.close();
 			$('#modalProgress .modal-content').find('p#alert').remove();
 			$('#modalProgress .modal-content .collapsible').empty();
 		}

 	}else if(param == 'detail'){
 		if(action == 'open'){
 			getModalDetail.open();
 		}
 		else if(action == 'close'){
 			$('body').css({overflow: 'visible'});
 			$('#modalDetail .modal-content').empty();
 			getModalDetail.close();
 		}

 	}

}
