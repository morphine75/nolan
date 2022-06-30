var total_pedido=0;
var subtotal_pedido=0;
filas_detalle_pedido=0;
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

function llamar_informe(ruta){
    $.ajax({
        url:'./informes/'+ruta+'/p_'+ruta+'.php',
        type: 'post',
        data: 'path='+ruta,
        success: function(a){
            $('#main').html(a);
        }
    })
}

function llamar_distribucion(ruta){
    $.ajax({
        url:ruta+'/distribucion.php',
        type: 'post',
        success: function(a){
            $('#main').html(a);
        }
    })
}

function llamar_composicion(ruta){
    $.ajax({
        url:ruta+'/composicion_carga.php',
        type: 'post',
        success: function(a){
            $('#main').html(a);
        }
    })
}

function ver_informe(ruta){
  $.post('./informes/'+ruta+'/'+ruta+'.php',$('#formulario').serialize(),function(dato){
    $("#resultado").html(dato);
  });    
}

function imprimir_informe(ruta){
    var redirect = function(url, method) {
        var form = document.getElementById('formulario');
        form.method = method;
        form.action = url;
        form.target = "_blank";
        form.submit();
    };
    redirect('./informes/'+ruta+'/pdf_'+ruta+'.php', 'post');  
}

function llamar_mapa(ruta){
    $.ajax({
        url:ruta+'/muestramapa.php',
        type: 'post',
        data: 'path='+ruta,
        success: function(a){
            $('#main').html(a);
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

function controlar_fleteros(){
    var nombre=$('#nombre').val();
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        return 1;
    }
}

function controlar_stock(){
    return 1;
}

function controlar_articulos(){
    var nombre=$('#nombre').val();
    var cantxcaja=$('#cantxcaja').val();
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        if ($('#cantxcaja').val()==''){
            return 0;
        }    
        else{
            return 1;
        }
    }
}

function controlar_proveedores_articulos(){
    var precio=$('#precio').val();
    if ((precio=='')||(parseInt(precio)<0)){
        return 0;
    }
    else{
        return 1;
    }
}

function controlar_documentos(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        if ($('#letra').val()==''){
            return 0;
        }    
        else{
            return 1;
        }
    }
}

function controlar_listas_precio(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        return 1;
    }
}

function controlar_moviles(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        return 1;
    }
}


function controlar_tipos_movimiento(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        if ($('#descripcion').val()==''){
            return 0;
        }
        else{
            return 1;
        }
    }
}

function controlar_tipos_iva(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        return 1;
    }
}

function controlar_impuestos(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        if ($('#alicuota').val()==''){
            return 0;
        }
        else{
            return 1;
        }
    }
}

function controlar_tipos_ruta(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        return 1;
    }    
}

function controlar_sucursales(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        return 1;
    }
}

function controlar_canales(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        return 1;
    }
}

function controlar_depositos(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        return 1;
    }
}

function controlar_almacenes(){
    if ($('#nombre').val()==''){
        return 0;
    }
    else{
        return 1;
    }
}

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

function controlar_precio_venta(){
    return 1;
}

function controlar_rutas_cliente(){
    return 1;
}

function controlar_rutas_vendedor(){
    return 1;
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

function controlar_pedidos(){
    if (($('#detalle tr').length==2)||($('#total').val()=='')){
        return 0;
    }
    else{
        return 1;
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
			url:'./'+ruta+'/controlador.php',
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
    icon: 'fa fa-exclamation',
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
					url:'./'+ruta+'/controlador.php',
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

function ver(ruta, id){
    $.ajax({
        url:'./'+ruta+'/ver_'+ruta+'.php',
        type:'post',
        data: 'id='+id,
        success: function (a){
            $('#modal-body').html(a);
        }
    }) 
}

function agregar_fila(){
    filas_detalle_pedido=$('#filas_detalle_pedido').val();    
    $("#body_pedido").append('<tr id="tr_'+filas_detalle_pedido+'"><td><input type="text" size="7" name="codigo[]" id="codigo'+filas_detalle_pedido+'" onblur="busca_art_codigo(this.value, '+filas_detalle_pedido+')"></td><td><input type="text" class="inactivo" readonly="readonly" name="articulo[]" size="30" id="articulo'+filas_detalle_pedido+'"></td><td><span id="precio'+filas_detalle_pedido+'"></span></<td><td><input type="number" min="0" step="1" name="cantidad[]" size="5" id="cantidad'+filas_detalle_pedido+'" onclick="calcula_st(this.value,0,'+filas_detalle_pedido+')" onkeyup="calcula_st(this.value,0,'+filas_detalle_pedido+')"></td><td><input type="number" min="0" step="1" name="unidades[]" size="5" id="unidades'+filas_detalle_pedido+'" onclick="calcula_st(this.value,1,'+filas_detalle_pedido+')" onkeyup="calcula_st(this.value,1,'+filas_detalle_pedido+')"></td><td><input type="number" name="bonif[]" size="5" id="bonif'+filas_detalle_pedido+'" onkeyup="calcula_descuento(this.value,'+filas_detalle_pedido+')"> %</td><td><span id="subtotal'+filas_detalle_pedido+'"></span></td><td><a href="#" onclick="quitar_fila_dr('+filas_detalle_pedido+')"><span class="glyphicon glyphicon-trash"></span></a></td></tr><input type="hidden" name="cantxcaja[]" id="cantxcaja'+filas_detalle_pedido+'"><input type="hidden" name="subtotal_linea[]" id="subtotal_linea'+filas_detalle_pedido+'"><input type="hidden" name="stock[]" id="stock'+filas_detalle_pedido+'" value="0">');
    filas_detalle_pedido++;
    $('#filas_detalle_pedido').val(filas_detalle_pedido);
    subtotal_pedido=0;
}

function quitar_fila_dr(fila){
    total_pedido=0;
    $('#tr_'+fila).remove();
    for (var i=0;i<filas_detalle_pedido;i++){
        if ($('#subtotal'+i).length){
            if ($('#subtotal'+i).html()==''){
                var sumar=0;
            }
            else{
                var sumar=parseFloat($('#subtotal'+i).html());
            }
            total_pedido=parseFloat(total_pedido)+sumar;
        }
    }
    $('#total').val(total_pedido);    
}

function busca_clientes(cadena){
  $.get("sistema/clientes/busca_clientes.php?cadena="+cadena,function(dato){
    $("#lista_clientes").html(dato);
  });
}

function seleccionar_cliente(id){
  $.get("sistema/clientes/cliente_seleccionado.php?id="+id,function(dato){
    $("#lista_clientes").html(dato);
    $('#txt_clientes').css('display','none');
  });
}

function busca_art_codigo(codigo, fila){
    var lista=$('#id_lista').val();
    if (lista){
        $.ajax({
            url:'sistema/articulos/busca_art_codigo.php',
            type:'post',
            data: 'id='+codigo+'&lista='+lista,
            success: function (a){
                var res=a.split('***');
                $('#articulo'+fila).val(res[0]);
                $('#precio'+fila).html(res[2]);
                $('#cantxcaja'+fila).val(res[1]);
                $('#stock'+fila).val(res[3]);
            }
        })
    }
    else{
        alertas('Ingrese un cliente con lista de precio valida');
    }
}

function calcula_st(valor, tipo, fila){ 
    total_pedido=0;
    var keycode = (event.keyCode ? event.keyCode : event.which);
    //alert (keycode);
    if((keycode > '95')&&(keycode < '106')||(keycode == '8')||(keycode == '46')||(keycode != '109')||(keycode != '110')){
        if (tipo=='0'){
            if ((valor!='')&&(valor!='0')){
                var unidades=$('#unidades'+fila).val();
                var precio=$('#precio'+fila).html();
                var cantxcaja=$('#cantxcaja'+fila).val();
                if (unidades!=''){
                       unidades=parseInt(unidades)*(parseFloat(precio)/parseInt(cantxcaja));
                       subtotal_pedido=unidades+parseInt(valor)*parseFloat(precio);
                }
                else{
                    var cantidad=$('#cantidad'+fila).val();
                    subtotal_pedido=parseInt(cantidad)*parseFloat(precio);                    
                }
                $('#subtotal'+fila).html(subtotal_pedido);
            }
            else{
                subtotal_pedido=0;
                if (($('#unidades'+fila).val()==0)||($('#unidades'+fila).val()=='')){
                    $('#subtotal'+fila).html(0);                
                }
                else{
                    var unidades=$('#unidades'+fila).val();                    
                    var precio=$('#precio'+fila).html();
                    var cantxcaja=$('#cantxcaja'+fila).val();
                    subtotal_pedido=parseInt(unidades)*(parseFloat(precio)/parseInt(cantxcaja));
                    $('#subtotal'+fila).html(subtotal_pedido);                
                }
            }            
        }
        if (tipo=='1'){
            if ((valor!='')&&(valor!='0')){        
                var cantidad=$('#cantidad'+fila).val();
                var precio=$('#precio'+fila).html();
                var cantxcaja=$('#cantxcaja'+fila).val();
                if (cantidad!=''){
                    cantidad=parseInt(cantidad)*parseFloat(precio);
                    subtotal_pedido=cantidad+(parseInt(valor)*(parseFloat(precio)/parseInt(cantxcaja)));
                }
                else{
                    var unidades=$('#unidades'+fila).val();
                    subtotal_pedido=parseInt(unidades)*(parseFloat(precio)/parseInt(cantxcaja));                    
                }                
                $('#subtotal'+fila).html(subtotal_pedido);
            }
            else{
                subtotal_pedido=0;
                if (($('#cantidad'+fila).val()==0)||($('#cantidad'+fila).val()=='')){
                    $('#cantidad'+fila).html(0);                
                }
                else{
                    var cantidad=$('#cantidad'+fila).val();
                    var precio=$('#precio'+fila).html();
                    subtotal_pedido=parseInt(cantidad)*parseFloat(precio);
                    $('#subtotal'+fila).html(subtotal_pedido);                
                }
            }                   
        }
        $('#subtotal_linea'+fila).val(subtotal_pedido);
    }
    else{
        event.preventDefault(); //stop character from entering input 
    }
    var bandera_st=0;
    for (var i=0;i<filas_detalle_pedido;i++){
        if ($('#subtotal'+i).length){
            /*CONTROLAR STOCK*/
            if (($('#cantidad'+i).val()!='')&&($('#unidades'+i).val()!='')){
                var controlar=(parseInt($('#cantidad'+i).val())*parseInt($('#cantxcaja'+i).val()))+parseInt($('#unidades'+i).val());
                if (controlar>parseInt($('#stock'+i).val())){
                    bandera_st=1;
                }
            }
            if (($('#cantidad'+i).val()=='')&&($('#unidades'+i).val()!='')){
                var controlar=parseInt($('#unidades'+i).val());
                if (controlar>parseInt($('#stock'+i).val())){
                    bandera_st=1;
                }
            }
            if (($('#cantidad'+i).val()!='')&&($('#unidades'+i).val()=='')){
                var controlar=parseInt($('#cantidad'+i).val())*parseInt($('#cantxcaja'+i).val());
                if (controlar>parseInt($('#stock'+i).val())){
                    bandera_st=1;
                }
            }
            if ($('#subtotal'+i).html()==''){
                var sumar=0;
            }
            else{
                var sumar=parseFloat($('#subtotal'+i).html());
            }
            total_pedido=parseFloat(total_pedido)+sumar;
        }
        if (bandera_st==1){
            alertas ('Por favor revise las cantidades');
            $('#cantidad'+i).css('border-color','#ff4040');
            $('#unidades'+i).css('border-color','#ff4040');
        }
        else{
            $('#cantidad'+i).css('border-color','#000000');
            $('#unidades'+i).css('border-color','#000000');            
        }
    }
    $('#total').val(total_pedido);
}

function calcula_descuento(valor, fila){
    total_pedido=0;
    if ((valor!='')&&(valor!=0)){       
        var st_a_descontar=$('#subtotal_linea'+fila).val();
        var precio_descontado=parseFloat(st_a_descontar)-(parseFloat(st_a_descontar)*(parseFloat(valor)/100));
        $('#subtotal'+fila).html(precio_descontado);
    }
    else{      
        $('#subtotal'+fila).html($('#subtotal_linea'+fila).val());        
    }
    for (var i=0;i<filas_detalle_pedido;i++){
        if ($('#subtotal'+i).length){
            if ($('#subtotal'+i).html()==''){
                var sumar=0;
            }
            else{
                var sumar=parseFloat($('#subtotal'+i).html());
            }
            total_pedido=parseFloat(total_pedido)+sumar;
        }
    }
    $('#total').val(total_pedido);
}

function cargar_pedidos(){
    $.ajax({
        url:'./pedidos/carga_pedidos.php',
        type:'POST',
        success: function(a){
            $('#modal-body-facturar').html(a);
        }
    })
}

function facturar_pedidos(id){
    $.ajax({
        url: './pedidos/facturar_pedidos.php',
        type: 'POST',
        data:'id='+id,
        success: function(a){
            $('#modal-body-facturar').html(a);
        }
    })
}


function generar_planilla_carga(id){
    var fecha_entrega=$('#fecha_entrega_'+id).val();
    $.ajax({
            url:'./distribucion/generar_planilla_carga.php',
            type:'POST',
            data:'id_movil='+id,
            success: function(a){
                if (a=='0'){
                    if (fecha_entrega!=''){
                        $.ajax({
                            url:'./distribucion/generar_planilla_carga.php',
                            type:'POST',
                            data:'id_movil='+id+'&fecha_entrega='+fecha_entrega,
                            success: function(a){
                                $('#span_num_composicion').html(a);
                                $('#btn_imprimir'+id).css('display','table-cell');
                                $('#btn_imprimir'+id).html('Imprimir Composicion N° '+id);
                                $('#btn_generar'+id).css('display','none');
                                $('#fecha_entrega_'+id).css('display','none');
                            }
                        })
                    }
                    else{
                        alertas('Debe ingresar una fecha de entrega');
                    }
                }
                else{
                    alertas ('Existen pedidos sin facturar, por favor dirijase al modo comercial y facture los pedidos');
                }
            }            
    })
}