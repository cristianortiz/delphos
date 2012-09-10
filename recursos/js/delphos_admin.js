$(document).ready(function() {
/* ------------------------------------------------------------------------------------------------------------------
   Seccion de configuracion de variables usadas por el script 
*/
	// URL primaria del sitio, configurar segun la ubicacion del servidor donde se aloje la pagina, debe ser igual al base_url() de CI   
	var base_url = 'http://localhost/delphos/';
	// 	var base_url = 'http://146.83.74.15/delphos/';
	//variables para completar urls del sitio, se suman al base_url para formar las rutas de acceso a los controladores y sus metodos
	var panel_inferior = 'panel_inferior/editar';
	var panel_lateral = 'panel_lateral/editar';
	var panel_principal = 'panel_principal/editar';
	// variables para controlar el maximo de caratectes permitido en cada aviso, noticia y articulo en los paneles lateral, inferior y proncipal
	
    var MAX_CHAR_LAT_UNO = 300;
    var MAX_CHAR_LAT_DOS = 150;
    var MAX_CHAR_LAT_TRES = 85;
    
    var MAX_CHAR_LAT = max_caracteres_lat();
	var MAX_CHAR_PI = 85;
	var MAX_CHAR_PRINC = 300;
	//array para mantener los input de seleccion multiple para eliminar y desactivar contenido en cada panel
	var checkboxes_princ = new Array();
    //variable para mentener el tipo de panel cuando se ejecuten acciones generales como desactivar y eliminar contenido de algun panel cualquiera
   	var input_tipo_panel = '';
    //variable para mentener el tipo de contenido a procesar cuando se ejecuten acciones generales como desactivar y eliminar contenido de algun panel cualquiera, se usa en conjunto con la variable anterior
   	var input_tipo_contenido = '';
    //variable para mentener el estado del contenido a procesar cuando se ejecuten acciones generales como desactivar y eliminar contenido de algun panel cualquiera, se usa para determinar que tabla de contenidos mostrar
   	var input_estado = ''; 
   
/* Fin seccion de configuracion

----------------------------------------------------------------------------------------------------------------
Funcion para la consulta dinamica de la cantidad de caracteres del panel lateral, este valor depende de la cantidad de noticias
que se deseen ver al mismo tiempo en el panel lateral deslizable y representa el  maximo ideal sin desbordar el tamaño del panel
*/
  function max_caracteres_lat()  {
        var  max_caracteres = 0;
        $.ajax({
            url:  base_url + 'panel_lateral/num_noticias_lateral/',
            type: 'post',
            dataType: 'json',
            async: false,
            success: function(respuesta) {
                max_caracteres = respuesta.max_caracteres_lat;
            }
        });
       return  max_caracteres;
    }   

 
/*----------------------------------------------------------------------------------------------------------------------------------
  Seccion de tooltips, mensajes informativos que se muestran para las distintas funciones definidas en las tablas de avisos, noticias
   videos y articulos del sistema */
	$("a.editar_princ").tooltip('Haga click para editar el texto de  este articulo del panel principal ', {
		mode: 'tr',
		width: 200
	});
	$("a.eliminar_princ").tooltip('Haga click para eliminar de forma permanente este articulo del panel principal.', {
		mode: 'tr',
		width: 200
	});
	$("a.borrar_imagen").tooltip('Haga click para borrar la imagen adjuntada a este articulo', {
		mode: 'tr',
		width: 200
	});
	$("a.subir_imagen").tooltip('Click para adjuntar una imagen a este articulo del panel principal', {
		mode: 'tr',
		width: 200
	});
	$("a.editar_pi").tooltip('Click para editar este aviso de la cinta en el panel inferior', {
		mode: 'tr',
		width: 200
	});
	$("a.eliminar_pi").tooltip('Click para borrar  este aviso de la cinta en el panel inferior', {
		mode: 'tr',
		width: 200
	});
	$("a.editar_lat").tooltip('Click para editar esta noticia del panel lateral', {
		mode: 'tr',
		width: 200
	});
	$("a.eliminar_lat").tooltip('Click para borrar esta noticia del panel lateral', {
		mode: 'tr',
		width: 200
	});
/* fin seccion tooltips

/*--------------------------------------------------------------------------------------------------------------------
  funcion para marcar y desmarcar todos los check de envio de documentos de una tabla
 */
	$("input.check_todos").click(function(event) {
		if ($(this).is(":checked")) {
			$("input.enviar_documento:checkbox:not(:checked)").attr("checked", "checked");
		} else {
			$("input.enviar_documento:checkbox:checked").removeAttr("checked");
		}
	});
/*-----------------------------------------------------------------------------------------------------------------------
  Esta funcion permite obtener los checkboxs en estado checked  si se ha marcado algun contenido para se eliminado, 
  si hay alguno  en ese estado se abre el cuadro para poder eliminar el contenido del panel correspondiente*/
	$("#btn_eliminar").click(function() {
		$("input.enviar_documento:checked").each(function() {
			checkboxes_princ.push($(this).val());
		})
		if (checkboxes_princ.length != 0) {
		    input_tipo_panel = $('#eliminar_dialog_princ > input#input_panel').val();
            input_tipo_contenido = $('#eliminar_dialog_princ > input#input_contenido').val();
            input_estado = $('#eliminar_dialog_princ > input#input_estado').val();
			$('#eliminar_dialog_princ').dialog('open');
		} else {
			alert('No hay documentos seleccionados!');
		}
	});
	$('#eliminar_dialog_princ').dialog({
		autoOpen: false,
		width: '450px',
		height: '350',
		modal: true,
		buttons: {
			'Eliminar': function() {
				$.ajax({
					url: base_url + input_tipo_panel +'/eliminar_' + input_tipo_contenido,
					type: 'POST',
					dataType: 'json',
					data: {
						'array_id': checkboxes_princ,
					},
					// respuesta en formato JSON desde el metodo eliminar_articulo()					
					success: function(response) {
						// si la eliminacion del aviso ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						$('#eliminar_dialog_princ').dialog('close');
						$('#eliminar_dialog_ok > p').html(response.text);
						$('#eliminar_dialog_ok').dialog('option', 'title', 'Eliminacion Exitosa').dialog('open');
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
	$('#eliminar_dialog_ok').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
				document.location = base_url + input_tipo_panel + '/editar/'+input_estado;
			}
		},
		modal: true
	});
    
/*-----------------------------------------------------------------------------------------------------------------------
  Esta funcion permite obtener los checkboxs en estado checked  si se ha marcado algun contenido para se DESACTIVADO, 
  si hay alguno  en ese estado se abre el cuadro para poder DESACTIVAR el contenido del panel correspondiente
*/
	$("#btn_desactivar").click(function() {
		$("input.enviar_documento:checked").each(function() {
			checkboxes_princ.push($(this).val());
		})
		if (checkboxes_princ.length != 0) {
		    input_tipo_panel = $('#eliminar_dialog_princ > input#input_panel').val();
            input_tipo_contenido = $('#eliminar_dialog_princ > input#input_contenido').val();
			$('#desactivar_dialog_princ').dialog('open');
		} else {
		  
			alert('No hay documentos seleccionados!');
		}
	});
	$('#desactivar_dialog_princ').dialog({
		autoOpen: false,
		width: '450px',
		height: '350',
		modal: true,
		buttons: {
			'Desactivar': function() {
				$.ajax({
					url: base_url + input_tipo_panel +'/cambiar_estado_' + input_tipo_contenido,
					type: 'POST',
					dataType: 'json',
					data: {
						'array_id': checkboxes_princ,
                        'estado'  : 'desactivado' 
					},
					// respuesta en formato JSON desde el metodo eliminar_articulo()					
					success: function(response) {
						// si la eliminacion del aviso ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						$('#desactivar_dialog_princ').dialog('close');
						$('#desactivar_dialog_ok > p').html(response.text);
						$('#desactivar_dialog_ok').dialog('option', 'title', 'Desactivacion Exitosa').dialog('open');
					} //fin success                   
				}); //fin llamada ajax()
				return false;
			},
			//boton que cierra el cuadro de dialogo
			'Cancelar': function() {
				$(this).dialog('close');
			}
		}
	}); //fin del cuadro de dialogo "desactivar_Dialog_princ" 
    
	$('#desactivar_dialog_ok').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
				document.location = base_url + input_tipo_panel+'/editar/activo';
			}
		},
		modal: true
	});

/*-----------------------------------------------------------------------------------------------------------------------
  Esta funcion permite obtener los checkboxs en estado checked  si se ha marcado algun contenido para se ACTIVADO, 
  si hay alguno  en ese estado se abre el cuadro para poder ACTIVAR el contenido del panel correspondiente, que se encuentre
  desactivado en la seccion Historial de cada panel
*/
	$("#btn_activar").click(function() {
		$("input.enviar_documento:checked").each(function() {
			checkboxes_princ.push($(this).val());
		})
		if (checkboxes_princ.length != 0) {
		   input_tipo_panel = $('#eliminar_dialog_princ > input#input_panel').val();
           input_tipo_contenido = $('#eliminar_dialog_princ > input#input_contenido').val();
			$('#activar_dialog_princ').dialog('open');
		} else {
		  
			alert('No hay documentos seleccionados!');
		}
	});    
    	$('#activar_dialog_princ').dialog({
		autoOpen: false,
		width: '450px',
		height: '350',
		modal: true,
		buttons: {
			'Reactivar': function() {
				$.ajax({
					url: base_url +  input_tipo_panel +'/cambiar_estado_' + input_tipo_contenido,
					type: 'POST',
					dataType: 'json',
					data: {
						'array_id': checkboxes_princ,
                        'estado'  : 'activo' 
					},
					// respuesta en formato JSON desde el metodo eliminar_articulo()					
					success: function(response) {
						// si la eliminacion del aviso ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						$('#activar_dialog_princ').dialog('close');
						$('#activar_dialog_ok > p').html(response.text);
						$('#activar_dialog_ok').dialog('option', 'title', 'Rectivacion Exitosa').dialog('open');
					} //fin success                   
				}); //fin llamada ajax()
				return false;
			},
			//boton que cierra el cuadro de dialogo
			'Cancelar': function() {
				$(this).dialog('close');
			}
		}
	}); //fin del cuadro de dialogo "activar_Dialog_princ" 
    
	$('#activar_dialog_ok').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
				document.location = base_url + input_tipo_panel+'/editar/desactivado';
			}
		},
		modal: true
	});
/*----------------------------------------------------------------------------------------------------------------------
	 TABLA DE EDICION DE AVISOS DEL PANEL INFERIOR, CONTROLA LAS ACCIONES, AGREGAR, EDITAR Y ELIMINAR AVISOS DE LA CINTA DE
	 MENSAJES INFERIOR
	 
	 /*----------------------------------------------------------------------------------------------------------------------------
	  Seccion para CREAR un aviso nuevo en la cinta dae mensajes, se captura el evento click adael enlace Nuevo Aviso, se consultan los
	  se abre un cuadro de dialogo con un formulario para crear el aviso, se valida y se muestra un mensaje de confirmacion.
	  */
	$('#edicion_panel ').delegate('input#nuevo_aviso', 'click', function(event) {
		event.preventDefault();
		$('#form-crear-pi #contenido').empty();
		$('#crearDialog-pi').dialog('open');
	})
	var opciones_inferior = {
		'maxCharacterSize': MAX_CHAR_PI,
		'originalStyle': 'originalDisplayInfo',
		'warningStyle': 'warningDisplayInfo',
		'warningNumber': 40,
		'displayFormat': '#input Caracteres | #left Restantes | #words Palabras'
	};
	$('#crearDialog-pi #contenido').textareaCount(opciones_inferior);
	//configuracion del cuadro de dialogo para actualizar    
	$('#crearDialog-pi').dialog({
		autoOpen: false,
		width: '450px',
		height: '400',
		modal: true,
		buttons: {
			'Crear': function() {
				$.ajax({
					url: base_url + 'panel_inferior/crear_aviso_pi',
					type: 'POST',
					dataType: 'json',
					data: $('#crearDialog-pi form').serialize(),
					// respuesta en formato JSON desde el metodo crear_aviso_pi()					
					success: function(response) {
						if (response.aux != 2) {
							$('#crearDialog-pi').dialog('close');
							$('#msgDialog_pi > p').html(response.text);
							$('#msgDialog_pi').dialog('option', 'title', 'Nuevo Aviso').dialog('open');
						}
						$('#crearDialog-pi > p').html(response.text);
					} //fin success                   
				}); //fin llamada ajax()
				return false;
			},
			//boton que cierra el cuadro de dialogo
			'Cancelar': function() {
				$(this).dialog('close');
				//location = base_url+'/manager/panel_inferior';     
			}
		}
	}); //fin del cuadro de dialogo ""crearDialog" 
/*--------------------------------------------------------------------------------------------------------------------------------
  Seccion para EDITAR un aviso de la cinta dae mensajes, se captura el evento click adael enlace editar, se consultan los
  datos del aviso, se carga un cuadro de dialogo para actualizar y se muestra un aviso de confirmacion,
 */
	$('#tabla_avisos').delegate('a.editar_pi', 'click', function(event) {
		event.preventDefault();
		var id = $(this).attr('href');
		//envio una consulta para recuperar datos del aviso consultado y cargarlos en el form de actualizacion via ajaxs
		$.ajax({
			url: base_url + 'panel_inferior/consultar_aviso_pi/' + id,
			type: 'POST',
			dataType: 'json',
			success: function(respuesta) {
				// se cargan en el form de actualizacion los datos del aviso a editar                   
				$('#form-edicion-pi #contenido').val(respuesta.contenido);
				$('#form-edicion-pi #id').val(id);
				//abrimos el cuadro de dialogo que contendra el form de actualizacion             
				$('#editarDialog-pi').dialog('open');
			}
		});
		return false;
	})
	$('#editarDialog-pi #contenido').textareaCount(opciones_inferior);
	//configuracion del cuadro de dialogo para actualizar    
	$('#editarDialog-pi').dialog({
		autoOpen: false,
		width: '450px',
		height: '350',
		modal: true,
		buttons: {
			'Editar': function() {
				//$( '#ajaxLoadAni' ).fadeIn( 'slow' );
				$.ajax({
					url: base_url + 'panel_inferior/editar_aviso_pi',
					type: 'POST',
					dataType: 'json',
					data: $('#editarDialog-pi form').serialize(),
					// respuesta en formato JSON desde el metodo editar_aviso_pi()					
					success: function(response) {
						if (response.aux == 2) // si el texto esta vacio
						{
							$('#form-edicion-pi > p').html(response.text);
						}
						// si la actualizacion de la deuda ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						if (response.aux == 1) {
							$('#editarDialog-pi').dialog('close');
							$('#msgDialog_pi > p').html(response.text);
							$('#msgDialog_pi').dialog('option', 'title', 'Edicion Exitosa').dialog('open');
							//$( '#ajaxLoadAni' ).fadeOut( 'slow' );		
							$('#fila' + response.id + ' > td#f2').html(response.contenido);
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
	$('#msgDialog_pi').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				document.location = base_url + panel_inferior+'/activo';
			}
		},
		modal: true
	}); //fin del cuadro de dialogo ""msDialog_pi"  

/* FIN TABLA DE EDICION DE AVISOS DEL PANEL INFERIOR O CINTA DE MENSAJES
 	 
/*----------------------------------------------------------------------------------------------------------------------

 TABLA DE EDICION DE NOTICIAS DEL PANEL LATERAL, CONTROLA LAS ACCIONES, AGREGAR, EDTIAR Y ELIMINAR NOTICIAS  DEL PANEL DE
 NOTICIAS LATERAL
 
/*-----------------------------------------------------------------------------------------------------------------------------  
* Seccion para CREAR una noticia nueva en el panel laterla de noticias, se captura el evento click adael enlace Nueva Noticia,
* se consultan los datos de la noticia   se abre un cuadro de dialogo con un formulario para crear la noticia, se valida y se muestra
* un mensaje de confirmacion.
*/
	$('#edicion_panel ').delegate('input#nueva_noticia', 'click', function(event) {
		event.preventDefault();
		$('#form-crear-lat #contenido').empty();
		$('#crearDialog_lat > p').empty();
		$('#crearDialog_lat').dialog('open');
	})
	//opciones del plugin para controlar la cantidad de caracteres permitido al CREAR en una noticia del panel principal
	var opciones_lateral = {
		'maxCharacterSize': MAX_CHAR_LAT,
		'originalStyle': 'originalDisplayInfo',
		'warningStyle': 'warningDisplayInfo',
		'warningNumber': 40,
		'displayFormat': '#input Caracteres | #left Restantes | #words Palabras'
	};
	$('#crearDialog_lat  #contenido').textareaCount(opciones_lateral);
	$('#crearDialog_lat').dialog({
		autoOpen: false,
		width: '460px',
		height: '400',
		modal: true,
		buttons: {
			'Crear': function() {
				$.ajax({
					url: base_url + 'panel_lateral/crear_noticia_lat',
					type: 'POST',
					dataType: 'json',
					data: $('#crearDialog_lat form').serialize(),
					// respuesta en formato JSON desde el metodo editar_aviso_pi()					
					success: function(response) {
						if (response.aux != 2) {
							$('#crearDialog_lat').dialog('close');
							$('#msgDialog_lat > h4').html(response.text);
							$('#msgDialog_lat').dialog('option', 'title', 'Nueva Noticia').dialog('open');
						}
						//$('#crearDialog_lat > h4').html(response.text);
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
            
/*---------------------------------------------------------------------------------------------------------------------------
      Seccion para editar un aviso daae la cinta dae mensajes, se captura el evento click del enlace editar, se consultan los
      datos del aviso, se carga un cuadro de dialogo para actualizar y se muestra un aviso daae confirmacion,
    */
	$('#tabla_avisos').delegate('a.editar_lat', 'click', function(event) {
		event.preventDefault();
		var id = $(this).attr('href');
		//envio una consulta para recuperar datos del aviso consultado y cargarlos en el form de actualizacion via ajaxs
		$.ajax({
			url: base_url + 'panel_lateral/consultar_noticia_lat/' + id,
			type: 'POST',
			dataType: 'json',
			success: function(respuesta) {
				// se cargan en el form de actualizacion los datos del aviso a editar                   
				$('#form-edicion-lat #contenido').val(respuesta.contenido);
				$('#form-edicion-lat #id').val(id);
				//abrimos el cuadro de dialogo que contendra el form de actualizacion             
				$('#editarDialog_lat').dialog('open');
			}
		});
		return false;
	})
	//opciones del plugin para controlar la cantidad de caracteres permitido al EDITARs en una noticia del panel principal
	$('#editarDialog_lat #contenido').textareaCount(opciones_lateral);
	//configuracion del cuadro de dialogo para actualizar    
	$('#editarDialog_lat').dialog({
		autoOpen: false,
		width: '460px',
		height: '400',
		modal: true,
		buttons: {
			'Editar': function() {
				//$( '#ajaxLoadAni' ).fadeIn( 'slow' );
				$.ajax({
					url: base_url + 'panel_lateral/editar_noticia_lat',
					type: 'POST',
					dataType: 'json',
					data: $('#editarDialog_lat form').serialize(),
					// respuesta en formato JSON desde el metodo editar_aviso_pi()					
					success: function(response) {
						if (response.aux == 2) // si el texto esta vacio
						{
							$('#form-edicion-lat > p').html(response.text);
						}
						// si la actualizacion de la deuda ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						if (response.aux == 1) {
							$('#editarDialog_lat').dialog('close');
							$('#msgDialog_lat > p').html(response.text);
							$('#msgDialog_lat').dialog('option', 'title', 'Edicion Exitosa').dialog('open');
							$('#fila' + response.id + ' > td#f1').html(response.contenido);
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
	$('#msgDialog_lat').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
				document.location = base_url + panel_inferior +'/activo';
			}
		},
		modal: true
	}); //fin del cuadro de dialogo "msgDialog_lat" 
    
   $("#num_noticias_lat").change(function(){
                var op = $("#num_noticias_lat option:selected").val();
                switch(op){
                    case '1':
                     $(" input#max_caracteres_lat").val(MAX_CHAR_LAT_UNO);
                    break;
                     case '2':
                     $(" input#max_caracteres_lat").val(MAX_CHAR_LAT_DOS);
                    break;
                    case '3':
                     $(" input#max_caracteres_lat").val(MAX_CHAR_LAT_TRES);
                    break;
                    
                }
        });
  	$('#config_panel_lateral').submit(function() {
		$.ajax({
			type: 'POST',
			url: base_url + 'panel_lateral/configurar_noticias',
			dataType: 'json',
			data: $(this).serialize(),
			success: function(respuesta) {
			 
			  	$('#msgDialogOpLat > h4').html(respuesta.text);  
				$('#msgDialogOpLat').dialog('option', 'title', 'Configurar Noticias').dialog('open');
			}
		});
		return false;
	});
     $('#msgDialogOpLat').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
				document.location = base_url+'panel_lateral/opciones_lateral';     
			}
		},
		modal: true
	});      
        

/* FIN TABLA DE EDICION DE NOTICIAS DEL PANEL LATERAL


/*----------------------------------------------------------------------------------------------------------------------
  TABLA DE EDICION DE ARTICULOS Y TEXTO DEL PANEL PRINCIPAL, CONTROLA LAS ACCIONES, AGREGAR, EDITAR Y ELIMINAR TEXTO  DEL PANEL
  PRINCPAL
  */
/*----------------------------------------------------------------------------------------------------------------------------
 seccion para crear un nuevo articulo en el panel principal, se captura el enlace nuevo_articulo y se muestra un dialog con el form
 para crear un nuevo articulo mas su imagen adjuntada
 */
	$('#edicion_panel ').delegate('input#nuevo_articulo', 'click', function(event) {
		event.preventDefault();
		$('#form_nuevo_articulo #contenido').empty();
		$('#form_nuevo_articulo #titulo').empty();
		$('#form_nuevo_articulo #desc').empty();
		$('#nuevo_articulo_dialog').dialog('open');
	})
	var opciones_principal = {
		'maxCharacterSize': MAX_CHAR_PRINC,
		'originalStyle': 'originalDisplayInfo',
		'warningStyle': 'warningDisplayInfo',
		'warningNumber': 40,
		'displayFormat': '#input Caracteres | #left Restantes | #words Palabras'
	};
	$('#nuevo_articulo_dialog #contenido').textareaCount(opciones_principal);
	//configuracion del cuadro de dialogo para actualizar    
	$('#nuevo_articulo_dialog').dialog({
		autoOpen: false,
		width: '550px',
		height: '450',
		modal: true,
		buttons: {
			'Crear': function() {
				$.ajaxFileUpload({
					url: base_url + 'panel_principal/crear_nuevo_articulo',
					secureuri: false,
					fileElementId: 'articulo_img',
					dataType: 'json',
					//este plugin NO soporta serialize() para capturar los datos del form
					data: {
						'titulo': $('#form_nuevo_articulo #titulo').val(),
						'desc': $('#form_nuevo_articulo #desc').val(),
						'contenido': $('#form_nuevo_articulo #contenido').val()
					},
					success: function(data, status) {
						if (data.status != 'error') {
							$('#nuevo_articulo_dialog').dialog('close');
							$('#articulo_ok_dialog > h4').html(data.msg);
							$('#articulo_ok_dialog').dialog('option', 'title', 'Crear Nuevo Articulo').dialog('open');
						} else {
							$('#nuevo_articulo_dialog').dialog('close');
							$('#articulo_ok_dialog > h4').html(data.msg);
							$('#articulo_ok_dialog').dialog('option', 'title', 'Crear Nuevo Articulo').dialog('open');
						}
					}
				});
			},
			//boton que cierra el cuadro de dialogo
			'Cancelar': function() {
				$(this).dialog('close');
				//location = base_url+'/manager/panel_inferior';     
			}
		}
	}); //fin del cuadro de dialogo ""crearDialog"
	$('#articulo_ok_dialog').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				document.location = base_url + panel_principal +'/activo';
				$(this).dialog('close');
			}
		},
		modal: true
	});
/*------------------------------------------------------------------------------------------------------------------------------
   Seccion para editar un aviso daae la cinta dae mensajes, se captura el evento click adael enlace editar, se consultan los
   datos del aviso, se carga un cuadro de dialogo para actualizar y se muestra un aviso daae confirmacion,
  */
	$('#tabla_avisos').delegate('a.editar_princ', 'click', function(event) {
		event.preventDefault();
		var id = $(this).attr('href');
		//envio una consulta para recuperar datos del aviso consultado y cargarlos en el form de actualizacion via ajaxs
		$.ajax({
			url: base_url + 'panel_principal/consultar_texto/' + id,
			type: 'POST',
			dataType: 'json',
			success: function(respuesta) {
				// se cargan en el form de actualizacion los datos del aviso a editar 
				$('#form-edicion-princ #titulo').val(respuesta.titulo);
				$('#form-edicion-princ #desc').val(respuesta.descripcion);
				$('#form-edicion-princ #contenido').val(respuesta.contenido);
				$('#form-edicion-princ #id').val(id);
				//abrimos el cuadro de dialogo que contendra el form de actualizacion             
				$('#editarPrincipal').dialog('open');
			}
		});
		return false;
	})
	var opciones_principal = {
		'maxCharacterSize': MAX_CHAR_PRINC,
		'originalStyle': 'originalDisplayInfo',
		'warningStyle': 'warningDisplayInfo',
		'warningNumber': 40,
		'displayFormat': '#input Caracteres | #left Restantes | #words Palabras'
	};
	$('#editarPrincipal  #contenido').textareaCount(opciones_principal);
	//configuracion del cuadro de dialogo para actualizar    
	$('#editarPrincipal').dialog({
		autoOpen: false,
		width: '550px',
		height: '450',
		modal: true,
		buttons: {
			'Editar': function() {
				//$( '#ajaxLoadAni' ).fadeIn( 'slow' );
				$.ajax({
					url: base_url + 'panel_principal/editar_texto_principal',
					type: 'POST',
					dataType: 'json',
					data: $('#editarPrincipal form').serialize(),
					// respuesta en formato JSON desde el metodo editar_aviso_pi()					
					success: function(response) {
						if (response.aux == 2) // si el texto esta vacio
						{
							$('#form-edicion-princ > p').html(response.text);
						}
						// si la actualizacion de la deuda ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						if (response.aux == 1) {
							$('#editarPrincipal').dialog('close');
							$('#msgDialog > p').html(response.text);
							$('#msgDialog').dialog('option', 'title', 'Edicion Exitosa').dialog('open');
							//$( '#ajaxLoadAni' ).fadeOut( 'slow' );		
							$('#fila' + response.id + ' > td#f1').html(response.titulo);
							$('#fila' + response.id + ' > td#f2').html(response.description);
							$('#fila' + response.id + ' > td#f3').html(response.contenido);
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
	$('#msgDialog').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
				//document.location = base_url+'panel_lateral';     
			}
		},
		modal: true
	});
/*------------------------------------------------------------------------------------------------------------------------------
    Seccion para controlar el tipo de contenido visible en el panel principal, que puede ser Articulos con texto o imagenes animados
    o una lista de reproduccion de videos
  */
	$('#visualizar').submit(function() {
		$.ajax({
			type: 'POST',
			url: base_url + 'panel_principal/actualizar_opcion',
			dataType: 'json',
			data: $('#visualizar').serialize(),
			success: function(respuesta) {
			 
			  	$('#msgDialogOpcion > h4').html(respuesta.text);  
				$('#msgDialogOpcion').dialog('option', 'title', 'Elegir Visualizacion').dialog('open');
			}
		});
		return false;
	});
    $('#msgDialogOpcion').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
				document.location = base_url+'panel_principal/opciones';     
			}
		},
		modal: true
	});
    
/*-----------------------------------------------------------------------------------------------------------------------------
     Seccion apra subir un archivo de video al servidor, usando el plugin AjaxFileUpload y luego la libreria Upload de CI 
     */
	$('#upload_file').submit(function(event) {
		event.preventDefault();
		var desc = $('#desc').val();
		$.ajaxFileUpload({
			type: 'POST',
			url: base_url + 'panel_principal/do_upload/',
			secureuri: false,
			fileElementId: 'userfile',
			dataType: 'json',
			data: {
				'desc': desc
			},
			success: function(data, status) {
				$('#video_ok_dialog > p').html('<h3>' + data.msg + '</h3>');
				$('#video_ok_dialog').dialog('option', 'title', 'Subir Videos').dialog('open');
			}
		});
		return false;
	});
/*--------------------------------------------------------------------------------------------------------------------
    Seccion para capturar el enlace del video externo de youtube y guardarlo en la base de datos
     */
	$('#video-online').submit(function() {
		$.ajax({
			type: 'POST',
			url: base_url + 'panel_principal/subir_video_online',
			dataType: 'json',
			data: $('#video-online').serialize(),
			success: function(data) {
				$('#video_ok_dialog > p').html('<h3>' + data.msg + '</h3>');
				$('#video_ok_dialog').dialog('option', 'title', 'Subir Videos').dialog('open');
			}
		});
		return false;
	});
	$('#video_ok_dialog').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				document.location = base_url + 'panel_principal/videos';
				$(this).dialog('close');
			}
		},
		modal: true
	});
/*------------------------------------------------------------------------------------------------------------------------------
    seccion para eliminar un video de la tabla, se elimina el registro en la BD y el archivo de video correspondiente en el servidor
     */
	$('#tabla_avisos').delegate('a.eliminar_video', 'click', function(event) {
		event.preventDefault();
		var id = $(this).attr('href');
		$.ajax({
			type: 'POST',
			url: base_url + 'panel_principal/consultar_video/' + id,
			dataType: 'json',
			success: function(data) {
				$('#form_borrar_video #nombre_video').val(data.nombre);
				$('#form_borrar_video > h4').html(data.desc);
				$('#form_borrar_video #tipo_video').val(data.tipo);
				$('#form_borrar_video #id').val(id);
				//abrimos el cuadro de dialogo que contendra el mensaje de confirmacion             
				$('#borrar_video_dialog').dialog('open');
			}
		});
		return false;
	});
	$('#borrar_video_dialog').dialog({
		autoOpen: false,
		width: '350px',
		height: '300',
		modal: true,
		buttons: {
			'Eliminar': function() {
				$.ajax({
					url: base_url + 'panel_principal/borrar_video',
					type: 'POST',
					dataType: 'json',
					data: $('#form_borrar_video').serialize(),
					// respuesta en formato JSON desde el metodo editar_aviso_pi()					
					success: function(data) {
						// si la eliminacion del aviso ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						$('#borrar_video_dialog').dialog('close');
						$('#video_ok_dialog > p').html('<h3>' + data.msg + '</h3>');
						$('#video_ok_dialog').dialog('option', 'title', 'Eliminar video').dialog('open');
					} //fin success                   
				}); //fin llamada ajax()
				return false;
			},
			//boton que cierra el cuadro de dialogo
			'Cancelar': function() {
				$(this).dialog('close');
			}
		}
	});
/*----------------------------------------------------------------------------------------------------------------------------
  Seccion para controlar la subida de videos del panel principal, desplegar div para insertar un archivo desde el pc o mostrar el div
  para pegar un enlace de video externo de youtube,
   */
	$("a.subir-video").click(function(event) {
		event.preventDefault();
		$('div.video-online').slideUp('slow');
		$('div.subir-video').slideDown('slow');
	});
	$("a.video-online").click(function(event) {
		event.preventDefault();
		$('div.subir-video').slideUp('slow');
		$('div.video-online').slideDown('slow');
	});
/*----------------------------------------------------------------------------------------------------------------------------
    Seccion para actualizar la imagen que se ha adjuntado previamente, captura el archivo de imagen y lo actualiza en en el servidor
    y en la BD
    */
	$('#tabla_avisos').delegate('a.subir_imagen', 'click', function(event) {
		event.preventDefault();
		var id = $(this).attr('href');
		$('#form_subir_img #id').val(id);
		$('#subir_img_dialog').dialog('open');
	});
	//Cuadro de dialogo que permite subir un tipo de documento categoria otro y su nombre asociado
	$('#subir_img_dialog').dialog({
		autoOpen: false,
		buttons: {
			'Cancelar': function() {
				$(this).dialog('close');
			},
			'Aceptar': function() {
				var id = $('#id').val();
				$.ajaxFileUpload({
					url: base_url + 'panel_principal/actualizar_imagen',
					secureuri: false,
					fileElementId: 'userfile',
					dataType: 'json',
					//este plugin NO soporta serialize() para capturar los datos del form
					data: {
						'id': $('#form_subir_img #id').val()
					},
					success: function(data, status) {
						if (data.status != 'error') {
/*$('#adjuntar_otros_dialog').dialog('close');
								$('#fila' + id + ' > td#f6' + id).html(data.nombre_archivo);
								$('#fila' + id + ' > td#f7' + id).html('<a class="ver_arch" href="' + base_url_upload + data.ruta_ver + '" > <img src="' + base_url + 'recursos/images/new.png"  /></a> <a class="remover_otros" href="' + data.ruta_elim + '" ><img src="' + base_url + 'recursos/images/delete_file.png"  /></a> ');
								$('#fila' + id + ' > td#f8' + id).html('<input class="enviar_documento" type="checkbox" name="" value="' + id + '" />');
								alert(data.msg);
                                */
							$('#subir_img_dialog').dialog('close');
							$('#imagen_ok_dialog > h4').html(data.msg);
							$('#imagen_ok_dialog').dialog('option', 'title', 'Actualizar Imagen').dialog('open');
						} else {
							$('#subir_img_dialog').dialog('close');
							$('#imagen_ok_dialog > h4').html(data.msg);
							$('#imagen_ok_dialog').dialog('option', 'title', 'Actualizar Imagen').dialog('open');
						}
					}
				});
			}
		},
		width: '350px',
		height: '250',
		modal: true
	});
/*------------------------------------------------------------------------------------------------------------------------------
    seccion para eliminar un video de la tabla, se elimina el registro en la BD y el archivo de video correspondiente en el servidor
     */
	$('#tabla_avisos').delegate('a.borrar_imagen', 'click', function(event) {
		event.preventDefault();
		var id = $(this).attr('href');
		$.ajax({
			type: 'POST',
			url: base_url + 'panel_principal/consultar_imagen/' + id,
			dataType: 'json',
			success: function(data) {
				$('#form_borrar_imagen #nombre_imagen').val(data.nombre);
				$('#form_borrar_imagen #id').val(id);
				$('#form_borrar_imagen > h4').html(data.nombre);
				//abrimos el cuadro de dialogo que contendra el mensaje de confirmacion             
				$('#borrar_img_dialog').dialog('open');
			}
		});
		return false;
	});
	$('#borrar_img_dialog').dialog({
		autoOpen: false,
		width: '350px',
		height: '300',
		modal: true,
		buttons: {
			'Eliminar': function() {
				$.ajax({
					url: base_url + 'panel_principal/borrar_imagen',
					type: 'POST',
					dataType: 'json',
					data: $('#form_borrar_imagen').serialize(),
					// respuesta en formato JSON desde el metodo editar_aviso_pi()					
					success: function(data) {
						// si la eliminacion del aviso ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
						$('#borrar_img_dialog').dialog('close');
						$('#imagen_ok_dialog > h4').html(data.msg);
						$('#imagen_ok_dialog').dialog('option', 'title', 'Eliminar Imagen').dialog('open');
					} //fin success                   
				}); //fin llamada ajax()
				return false;
			},
			//boton que cierra el cuadro de dialogo
			'Cancelar': function() {
				$(this).dialog('close');
			}
		}
	});
	$('#imagen_ok_dialog').dialog({
		autoOpen: false,
		buttons: {
			'Ok': function() {
				document.location = base_url + 'panel_principal/editar';
				$(this).dialog('close');
			}
		},
		modal: true
	});
});