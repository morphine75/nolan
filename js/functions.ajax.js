/**=============================================================================
 *
 *	Filename:  function.ajax.js
 *	
 *	(c)Autor: Arkos Noem Arenom
 *	
 *	Description: Ajax para hacer las consultas
 *	
 *	Licence: GPL|LGPL
 *	
 *===========================================================================**/

$(document).ready(function(){
	
	var timeSlide = 1000;
	$('#username').focus();
	$('#timer').hide(0);
	$('#timer').css('display','none');
	$('#login-submit').click(function(){
		$('#timer').fadeIn(300);
		$('.box-info, .box-success, .box-alert, .box-error').slideUp(timeSlide);
		setTimeout(function(){
			if ( $('#username').val() != "" && $('#pass').val() != ""){
				$.ajax({
					type: 'POST',
					url: 'log.inout.ajax.php',
					data: 'username=' + $('#username').val() + '&userpass=' + $('#userpass').val(),
					success:function(msj){
						if ( msj != 0 ){
							$('#alertBoxes').html('<div class="box-success"></div>');
							$('.box-success').hide(0).html('Espere un momento&#133;');
							$('.box-success').slideDown(timeSlide);
							setTimeout(function(){
								window.location.href = "menu.php";
							},(timeSlide + 500));
						}						
						if ( msj == 0 ){
							$('#alertBoxes').html('<div class="box-error"></div>');
							$('.box-error').hide(0).html('Lo sentimos, pero los datos son incorrectos: ' + msj);
							$('.box-error').slideDown(timeSlide);
						}
						$('#timer').fadeOut(300);
					},
					error:function(){
						$('#timer').fadeOut(300);
						$('#alertBoxes').html('<div class="box-error"></div>');
						$('.box-error').hide(0).html('Ha ocurrido un error durante la ejecución');
						$('.box-error').slideDown(timeSlide);
					}
				});
				
			}
			else{
				$('#alertBoxes').html('<div class="box-error"></div>');
				$('.box-error').hide(0).html('Los campos estan vacios');
				$('.box-error').slideDown(timeSlide);
				$('#timer').fadeOut(300);
			}
		},timeSlide);
		return false;
	});
	
	$('#sessionKiller').click(function(){
		var timeSlide = 1000;		
		$('#timer').fadeIn(300);
		$('#alertBoxes').html('<div class="box-success"></div>');
		$('.box-success').hide(0).html('Espere un momento&#133;');
		$('.box-success').slideDown(timeSlide);
		setTimeout(function(){
			window.location.href = "logout.php";
		},2500);
	});
});
