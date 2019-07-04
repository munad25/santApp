$(document).ready(function(){


	$('#btnSubmit').on('click', function(e){
		e.preventDefault();
		action();
	});


	$('#registForm').on('focus', '.input-field', function(){
		$('.helper-text').remove();
		$('.validate').removeClass('invalid');
	});
})


function action(){
	$.ajax({
		type : 'post',
		url : 'store-regist',
		dataType : 'JSON',
		data : $('#registForm').serialize(),
		chace : false,
		success : function(data){
			if(data.status == 'failed'){
				$.each(data.mesage, function(index, element){
					$('#'+index).addClass('invalid');
					$('#'+index).parent().append(
						'<span class="helper-text" data-error="* '+element+'">Helper text</span>'
					);

					// console.log();
				})
			}else if(data.status == 'success'){
				$(location).attr('href', 'login');
			}
		}

	});
}