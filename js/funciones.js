function llamar(ruta){
	$.ajax({
		url:ruta+'/listado.php',
		type: 'post',
		data: 'path='+ruta,
		success: function(a){
			$('#main').html(a);
			$('#tabla_listado').DataTable();
		}
	})
}

function cerrar(){
	$('#modal-container-abm').modal('hide');
	$('body').removeClass('modal-open');
	$('.modal-backdrop').remove();
}

function editar(ruta, id){
	$.ajax({
		url:ruta+'/formulario.php',
		type: 'post',
		data: 'path='+ruta+'&id='+id,
		success: function(a){
			$('#modal-body').html(a);
		}
	})
}


//Funciones control formulario alta/modificaciones////////////////// 

function controlar_clientes(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        if ($('#calle').val()==''){
            return 0;
        }
        else{
            if ($('#cuit').val()==''){
                return 0;
            }
            else{
                return 1;
            }            
        }
    }
}

function controlar_rutas(){
    if ($('#nombre').val()==''){
        return 0;
    }
   else{
       return 1;
    }
}

function controlar_rutas_distribucion(){
    if ($('#nombre').val()==''){
        return 0;
    }
   else{
       return 1;
    }
}


function controlar_proveedores(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        if ($('#cuit').val()==''){
            return 0;
        }
        else{
            if ($('#direccion').val()==''){
                return 0;
            }
            else{
                return 1;
            }            
        }
    }
}


function controlar_vendedores(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        if ($('#sucursal').val()==''){
            return 0;
        }
        else{
            if ($('#cargo').val()==''){
                return 0;
            }
            else{
                return 1;
            }            
        }
    }
}
//Fin controlador alta/modificacion/////////////////////////////////



function sin_altura(){
    if ($('#interseccion').is(':checked')){
        $('#altura').css('display','none');
    }
    else{
        $('#altura').css('display','inline');   
    }
}

function controlar(ruta, id){
    var funcion="controlar_"+ruta;
    eval('var resultado='+funcion+'()');
    if (resultado==1){
		var dataString=$("#formulario").serialize();
		dataString=dataString+'&id='+id+'&funcion=guardar';
		$.ajax({
			url:'../nolan/'+ruta+'/controlador.php',
			type:'post',
			data: dataString,
			success:function(a){
				cerrar();
				alertas(a);
				llamar(ruta);
			}
		})
    }
    else{
        alertas('Debe ingresar los valores obligatorios');
    }
}

function limpia_div(){
	$('.e_form').val('');
	$('.e_form').html('');
}

function alertas(msj)
{
  $.alert({
    title: 'Alerta!',
    //content: 'alerta común. <br> algo de <strong>HTML</strong> <em>con tags =)</em>',
    content: msj,
    icon: 'fa fa-rocket',
    animation: 'scale',
    closeAnimation: 'scale',
    buttons: {
      okay: {
        text: 'OK!',
        btnClass: 'btn-blue'
      }
    }
  });
}

function anular(ruta, id){
	$.confirm({
    title: 'Confirmar Acción',
    content: 'Desea eliminar el registro?',
    icon: 'glyphicon glyphicon-question-sign',
    animation: 'scale',
    closeAnimation: 'scale',
    opacity: 0.5,
    buttons: {
        confirm: {
            text: 'SI',
            btnClass: 'btn-green', 
            action: function () {         
                //accion de eliminar
                var dataString='funcion=eliminar&id='+id;
                $.ajax({
					url:'../nolan/'+ruta+'/controlador.php',
                	type:'post',
                	data: dataString,
                	success: function(a){
                		alertas(a);
                		llamar(ruta);
                	}
                })
                //fin de accion eliminar
            }
        },
        cancel: {
            text: 'NO',
            btnClass: 'btn-red',
            action: function () {
              $.alert('Accion Cancelada');
            }
        }
    }
  });   
}