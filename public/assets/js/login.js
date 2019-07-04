

$(document).ready(function(){
	var i = 0;
	$('#btnLogin').on('click', function(e){
		e.preventDefault();
		validate();
		i++
		if(i > 1){
			$('.helper-text').remove();
			$('#password, #username').removeClass('invalid')

		}
	});

	$('#username, #password').on('focus', function(){
		$('.helper-text').remove();
		$('#password, #username').removeClass('invalid')
	})
})


function validate(){
	$.ajax({
		type :"post",
		url	: "validate",
		dataType : "JSON",
		data : $('#loginForm').serialize(),
		chace : false,
		success: function(data){
			if(data.status == false){
				if(data.field == "username"){
					$('#username').parent().append('<span class="helper-text" data-error="*username tidak terdaftar"'+
						'>Helper text</span>');

					$('#username').addClass('invalid')

				}
				else if(data.field == "password"){
					$('#password').parent().append('<span class="helper-text" data-error="*password tidak sesuai"'+
						'>Helper text</span>');

					$('#password').addClass('invalid')

				}
			}
			else if(data.status == true){
				$(location).attr('href', 'pageClient');
			}
		}

	});
}

