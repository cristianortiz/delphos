$(document).ready(function() {
	var base_url = 'http://localhost/delphos/';
// 	var base_url = 'http://146.83.74.15/delphos/';

   	var checkboxes_usuarios = new Array();    
	var usuarios = 'usuarios/editar';
	$("a.editar_princ").tooltip('Haga click para editar este articulo del panel principal ', {
		mode: 'tr',
		width: 200
	});

/*--------------------------------------------------------------------------------------------------------------------
  funcion para marcar y desmarcar todos los check de envio de documentos de una tabla
 */
	$("input.check_all").click(function(event) {
		if ($(this).is(":checked")) {
			$("input.marcar_usuarios:checkbox:not(:checked)").attr("checked", "checked");
		} else {
			$("input.marcar_usuarios:checkbox:checked").removeAttr("checked");
		}
	});
    
/*-----------------------------------------------------------------------------------------------------------------------
  Esta funcion permite obtener los checkboxs en estado checked  si se ha marcado algun contenido para se eliminado, 
  si hay alguno  en ese estado se abre el cuadro para poder eliminar el contenido del panel correspondiente*/
  
	$("#btn_eliminar_usuarios").click(function() {
		$("input.marcar_usuarios:checked").each(function() {
			checkboxes_usuarios.push($(this).val());
		})
		if (checkboxes_usuarios.length != 0) {
		   
			$('#eliminar_usuarios').dialog('open');
		} 
        else{
			alert('No hay documentos seleccionados!');
		}
	});
	$('#eliminar_usuarios').dialog({
		autoOpen: false,
		width: '450px',
		height: '350',
		modal: true,
		buttons: {
			'Eliminar': function() {
				$.ajax({
					url: base_url + 'usuarios/eliminar_usuarios',
					type: 'POST',
					dataType: 'json',
					data: {
						'array_id': checkboxes_usuarios,
					},
					// respuesta en formato JSON desde el metodo eliminar_articulo()					
					success: function(response) {
						// si la eliminacion del aviso ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						$('#eliminar_usuarios').dialog('close');
                        
                        //abro cuadro de dialogo de confirmacion y lo cargo con la respuesta desde el server
						$('#eliminar_usuarios_ok > h4').html(response.text);
						$('#eliminar_usuarios_ok').dialog('option', 'title', 'Eliminacion Exitosa').dialog('open');
					} //fin success                   
				}); //fin llamada ajax()*/
				return false;
			},
			//boton que cierra el cuadro de dialogo
			'Cancelar': function() {
				$(this).dialog('close');
			}
		}
	}); //fin del cuadro de dialogo ""eliminarDialog" 
	$('#eliminar_usuarios_ok').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
				document.location = base_url +  'usuarios/editar/';
			}
		},
		modal: true
	}); 

	 /*----------------------------------------------------------------------------------------------------------------------------
	  Seccion para CREAR un aviso nuevo en la cinta dae mensajes, se captura el evento click adael enlace Nuevo Aviso,
	  se abre un cuadro de dialogo con un formulario para crear el nuevo usuario, se valida y se muestra un mensaje de confirmacion.
	  */
	$('#edicion_panel ').delegate('input#nuevo_usuario', 'click', function(event) {
		event.preventDefault();
	
		$('#crear_nuevo_usuario').dialog('open');
	})
    //configuracion para el plugin de control de caracteres en el textearea
	
	//configuracion del cuadro de dialogo para actualizar    
	$('#crear_nuevo_usuario').dialog({
		autoOpen: false,
		width: '450px',
		height: '400',
		modal: true,
		buttons: {
			'Crear': function() {
				$.ajax({
					url: base_url + 'usuarios/crear_nuevo_usuario',
					type: 'POST',
					dataType: 'json',
					data: $('#crear_nuevo_usuario form').serialize(),
					// respuesta en formato JSON desde el metodo crear_aviso_pi()					
					success: function(response) {
						if (response.aux != 2) {
							$('#crear_nuevo_usuario').dialog('close');
							$('#crear_usuario_ok > h4').html(response.text);
							$('#crear_usuario_ok').dialog('option', 'title', 'Crear Nuevo Usuario').dialog('open');
						}
						$('#crear_usuario_ok > h4').html(response.text);
					} //fin success                   
				}); //fin llamada ajax()
				return false;
			},
			//boton que cierra el cuadro de dialogo
			'Cancelar': function() {
				$(this).dialog('close');
			
			}
		}
	}); //fin del cuadro de dialogo ""crearDialog" 
    
    $('#crear_usuario_ok').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				document.location = base_url + usuarios;
			}
		},
		modal: true
	});
 /*--------------------------------------------------------------------------------------------------------------------------------
  Seccion para EDITAR un aviso de la cinta dae mensajes, se captura el evento click adael enlace editar, se consultan los
  datos del aviso, se carga un cuadro de dialogo para actualizar y se muestra un aviso de confirmacion,
 */
	$('#tabla_avisos').delegate('a.editar_usuario', 'click', function(event) {
		event.preventDefault();
		var id = $(this).attr('href');
		//envio una consulta para recuperar datos del aviso consultado y cargarlos en el form de actualizacion via ajaxs
		$.ajax({
			url: base_url + 'usuarios/consultar_usuario/' + id,
			type: 'POST',
			dataType: 'json',
			success: function(respuesta) {
				// se cargan en el form de actualizacion los datos del aviso a editar                   
				$('#form_editar_usuarios #username').val(respuesta.username);
				$('#form_editar_usuarios #password').val(respuesta.password);
                $('#form_editar_usuarios #email').val(respuesta.email);
               	$('#form_editar_usuarios div#perfil_aux').html(respuesta.perfil_id);
                $('#form_editar_usuarios #id').val(id);
				//abrimos el cuadro de dialogo que contendra el form de actualizacion             
				$('#editar_usuarios').dialog('open');
			}
		});
		return false;
	})

	//configuracion del cuadro de dialogo para actualizar    
	$('#editar_usuarios').dialog({
		autoOpen: false,
		width: '450px',
		height: '350',
		modal: true,
		buttons: {
			'Editar': function() {
				//$( '#ajaxLoadAni' ).fadeIn( 'slow' );
				$.ajax({
					url: base_url + 'usuarios/editar_usuario',
					type: 'POST',
					dataType: 'json',
					data: $('#editar_usuarios form').serialize(),
					// respuesta en formato JSON desde el metodo editar_aviso_pi()					
					success: function(response) {
						if (response.aux == 2) // si el texto esta vacio
						{
							$('#editar_usuario > h4').html(response.text);
						}
						// si la actualizacion de la deuda ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						if (response.aux == 1) {
							$('#editar_usuarios').dialog('close');
							$('#editar_usuario_ok > h4').html(response.text);
							$('#editar_usuario_ok').dialog('option', 'title', 'Edicion Exitosa').dialog('open');
							
						}
					} //fin success                   
				}); //fin llamada ajax()
				return false;
			},
			//boton que cierra el cuadro de dialogo
			'Cancelar': function() {
				$(this).dialog('close');
			}
		}
	}); //fin del cuadro de dialogo ""editarDialog"  
	//cuadro de dialogo de confirmacion de una edicion de aviso  
	$('#editar_usuario_ok').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				document.location = base_url + usuarios+'/editar';
			}
		},
		modal: true
	}); //fin del cuadro de dialogo ""msDialog_pi"  

/* FIN TABLA DE EDICION DE AVISOS DEL PANEL INFERIOR O CINTA DE MENSAJES*/
});
