$(document).ready(function() {
    
    var base_url = 'http://localhost/delphos/';    
/*----------------------------------------------------------------------------------------------------------------------
  TABLA DE EDICION DE AVISOS DEL PANEL INFERIOR, CONTROLA LAS ACCIONES, AGREGAR, EDTIAR Y ELIMINAR AVISOS DE LA CINTA DE
  MENSAJES INFERIOR  
 -------------------------------------------------------------------------------------------------------------------------*/

/***************************************************************************************************************************
  Seccion para crear un aviso nuevo en la cinta dae mensajes, se captura el evento click adael enlace Nuevo Aviso, se consultan los
  se abre un cuadro de dialogo con un formulario para crear el aviso, se valida y se muestra un mensaje de confirmacion.
 ******************************************************************************************************************************/
 $( '#edicion_panel ').delegate( 'a.crear_aviso_pi', 'click', function(event) {event.preventDefault();
       
        $('#form-crear-pi #contenido').empty(); 
        $( '#crearDialog-pi' ).dialog( 'open' );
        
	   }) 
$('#crearDialog-pi').dialog({
        autoOpen: false,
        width: '450px',
        height: '350',
        modal: true,
        buttons: {
            'Crear': function() {
                
                $.ajax({
                    url: base_url+'panel_inferior/crear_aviso_pi',
                    type: 'POST',
					dataType: 'json',
                    data: $( '#crearDialog-pi form' ).serialize(),					
                    // respuesta en formato JSON desde el metodo crear_aviso_pi()					
                    success: function( response ) {
                       
                       if(response.aux != 2){                               
                                 $( '#crearDialog-pi' ).dialog( 'close' );
                                 $( '#msgDialog_pi > p' ).html( response.text );
		                         $( '#msgDialog_pi' ).dialog( 'option', 'title', 'Nuevo Aviso' ).dialog( 'open' );			                                      
                             }
                              
						   $( '#crearDialog-pi > p' ).html( response.text );      
    			        
                   } //fin success                   
              }); //fin llamada ajax()
             return false; 
         },           
			//boton que cierra el cuadro de dialogo
            'Cancelar': function() {
                $( this ).dialog( 'close' );
                //location = base_url+'/manager/panel_inferior';     
            }
        }
        
    }); //fin del cuadro de dialogo ""crearDialog"         
 /*
  Seccion para editar un aviso daae la cinta dae mensajes, se captura el evento click adael enlace editar, se consultan los
  datos del aviso, se carga un cuadro de dialogo para actualizar y se muestra un aviso daae confirmacion,
 */
 
 $( '#tabla_avisos').delegate( 'a.editar_pi', 'click', function(event) {event.preventDefault();
        var id = $( this ).attr( 'href' );
        
        //envio una consulta para recuperar datos del aviso consultado y cargarlos en el form de actualizacion via ajaxs
        $.ajax({
                url: base_url+'panel_inferior/consultar_aviso_pi/'+ id,
                type: 'POST',
		    	dataType: 'json',       
                success: function( respuesta )
                {					
			      // se cargan en el form de actualizacion los datos del aviso a editar                   
				  $('#form-edicion-pi #contenido' ).val(respuesta.contenido);
                  $( '#form-edicion-pi #id' ).val(id );                    
                  //abrimos el cuadro de dialogo que contendra el form de actualizacion             
                  $( '#editarDialog-pi' ).dialog( 'open' );
		       }					
		 });
         return false;		
	   }) 
       
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
                    url: base_url+'panel_inferior/editar_aviso_pi',
                    type: 'POST',
					dataType: 'json',
                    data: $( '#editarDialog-pi form' ).serialize(),
					
                    // respuesta en formato JSON desde el metodo editar_aviso_pi()					
                    success: function( response ) {
						
						if(response.aux==2)// si el texto esta vacio
						{
						   $( '#form-edicion-pi > p'  ).html(response.text );                            
											
						}																		
						// si la actualizacion de la deuda ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
                        if(response.aux==1)
					    {
					        $( '#editarDialog-pi' ).dialog( 'close' );
                            $( '#msgDialog_pi > p' ).html( response.text );
		                    $( '#msgDialog_pi' ).dialog( 'option', 'title', 'Edicion Exitosa' ).dialog( 'open' );
                            //$( '#ajaxLoadAni' ).fadeOut( 'slow' );		
						     
					        $('#fila'+response.id+' > td#f2').html(response.contenido);
				        }						
                   } //fin success                   
              }); //fin llamada ajax()
             return false; 
         },           
			//boton que cierra el cuadro de dialogo
            'Cancelar': function() {
                
               $( this ).dialog( 'close' );
            }
        }        
    }); //fin del cuadro de dialogo ""editarDialog"  
       
  //cuadro de dialogo de confirmacion de una edicion de aviso  
  $( '#msgDialog_pi' ).dialog({
        autoOpen: false,
        
        buttons: {
            'Ok': function() {
                document.location = base_url+'panel_inferior/';                           
            }
        },
        modal: true
    });  
          	  
/*******************************************************************************************************************************
  Seccion para eliminar un aviso daae la cinta dae mensajes, se captura el evento click adael enlace eliminar, se consultan los
  datos del aviso, se carga un cuadro de dialogo para confirmar la eliminacion y se muestra un aviso de confirmacion,
 ********************************************************************************************************************************/ 
 
 $( '#tabla_avisos').delegate( 'a.eliminar_pi', 'click', function(event) {event.preventDefault();
 
        var id = $( this ).attr( 'href' );       
        //alert('Eliminar aviso con id :'+id);
       
       $.ajax({
                url: base_url+'panel_inferior/consultar_aviso_pi/'+ id,
                type: 'POST',
		    	dataType: 'json',       
                success: function( respuesta )
                {					
			     	// se cargan en el cuadro de confirmacion  los datos del aviso a eliminar 
				    $('#form-eliminar-pi #contenido' ).val(respuesta.contenido);
                    $( '#form-eliminar-pi #id' ).val(id );
                     
                    //abrimos el cuadro de dialogo que contendra el mensaje de confirmacion             
                    $( '#eliminarDialog-pi' ).dialog( 'open' );
		       }					
		 });
         return false;	
	   }) 	  
 
  //configuracion del cuadro de dialogo para eliminar un aviso  
  $( '#eliminarDialog-pi' ).dialog({
        autoOpen: false,
        width: '450px',
        height: '350',
        modal: true,
        buttons: {
            'Eliminar': function() {				
                $.ajax({
                    url: base_url+'panel_inferior/eliminar_aviso_pi',
                    type: 'POST',
					dataType: 'json',
                    data: $( '#eliminarDialog-pi form' ).serialize(),
					
                    // respuesta en formato JSON desde el metodo editar_aviso_pi()					
                    success: function( response ) 
                    {                   
						// si la eliminacion del aviso ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
                        
					        $( '#eliminarDialog-pi' ).dialog( 'close' );
                            $( '#msgDialog_pi > p' ).html( response.text );
		                    $( '#msgDialog_pi' ).dialog( 'option', 'title', 'Eliminacion Exitosa' ).dialog( 'open' );    									        						
                   } //fin success                   
              }); //fin llamada ajax()
             return false; 
         },           
			//boton que cierra el cuadro de dialogo
            'Cancelar': function() {
                $( this ).dialog( 'close' );
            }
        }
        
    }); //fin del cuadro de dialogo ""eliminarDialog"  
    
   /* FIN TABLA DE EDICION DE AVISOS DEL PANEL INFERIOR O CINTA DE MENSAJES
 /************************************************************************************************************************   
            
    
/*----------------------------------------------------------------------------------------------------------------------
  TABLA DE EDICION DE NOTICIAS DEL PANEL LATERAL, CONTROLA LAS ACCIONES, AGREGAR, EDTIAR Y ELIMINAR NOTICIAS  DEL PANEL DE
  NOTICIAS LATERAL
 -------------------------------------------------------------------------------------------------------------------------*/
/*
/***************************************************************************************************************************
  Seccion para crear una noticia nueva en el panel laterla de noticias, se captura el evento click adael enlace Nueva Noticia,
   se consultan los datos de la noticia   se abre un cuadro de dialogo con un formulario para crear la noticia, se valida y se muestra un mensaje de confirmacion.
 ******************************************************************************************************************************/
 $( '#edicion_panel').delegate( 'a.crear_noticia_lat', 'click', function(event) {event.preventDefault();
       
        $('#form-crear-lat #contenido').empty(); 
        $( '#crearDialog_lat' ).dialog( 'open' );       
	   }) 
$('#crearDialog_lat').dialog({
        autoOpen: false,
        width: '450px',
        height: '350',
        modal: true,
        buttons: {
            'Crear': function() {				
                $.ajax({
                    url: base_url+'panel_lateral/crear_noticia_lat',
                    type: 'POST',
					dataType: 'json',
                    data: $( '#crearDialog_lat form' ).serialize(),
					
                    // respuesta en formato JSON desde el metodo editar_aviso_pi()					
                    success: function( response ) {						
						 if(response.aux != 2){                               
                                 $( '#crearDialog_lat' ).dialog( 'close' );
                                 $( '#msgDialog_lat > p' ).html( response.text );
		                         $( '#msgDialog_lat' ).dialog( 'option', 'title', 'Nueva Noticia' ).dialog( 'open' );			                                      
                             }
                             
						   $( '#crearDialog_lat > p' ).html( response.text );  
                   } //fin success                   
              }); //fin llamada ajax()
             return false; 
         },           
			//boton que cierra el cuadro de dialogo
            'Cancelar': function() {
                $( this ).dialog( 'close' );   
            }
        }
        
    }); //fin del cuadro de dialogo ""crearDialog"         
 /*
  Seccion para editar un aviso daae la cinta dae mensajes, se captura el evento click adael enlace editar, se consultan los
  datos del aviso, se carga un cuadro de dialogo para actualizar y se muestra un aviso daae confirmacion,
 */
 
 $( '#tabla_avisos').delegate( 'a.editar_lat', 'click', function(event) {event.preventDefault();
        var id = $( this ).attr( 'href' );
        
        //envio una consulta para recuperar datos del aviso consultado y cargarlos en el form de actualizacion via ajaxs
        $.ajax({
                url: base_url+'panel_lateral/consultar_noticia_lat/'+ id,
                type: 'POST',
		    	dataType: 'json',       
                success: function( respuesta )
                {					
			      // se cargan en el form de actualizacion los datos del aviso a editar                   
				  $('#form-edicion-lat #contenido' ).val(respuesta.contenido);
                  $( '#form-edicion-lat #id' ).val(id );                    
                  //abrimos el cuadro de dialogo que contendra el form de actualizacion             
                  $( '#editarDialog_lat' ).dialog( 'open' );
		       }					
		 });
         return false;		
	   }) 
       
   //configuracion del cuadro de dialogo para actualizar    
  $('#editarDialog_lat').dialog({
        autoOpen: false,
        width: '450px',
        height: '350',
        modal: true,
        buttons: {
            'Editar': function() {
                //$( '#ajaxLoadAni' ).fadeIn( 'slow' );
				
                $.ajax({
                    url: base_url+'panel_lateral/editar_noticia_lat',
                    type: 'POST',
					dataType: 'json',
                    data: $( '#editarDialog_lat form' ).serialize(),
					
                    // respuesta en formato JSON desde el metodo editar_aviso_pi()					
                    success: function( response ) {
						
						if(response.aux==2)// si el texto esta vacio
						{
						   $( '#form-edicion-lat > p'  ).html(response.text );                            											
						}																		
						// si la actualizacion de la deuda ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
                        if(response.aux==1)
					    {
					        $( '#editarDialog_lat' ).dialog( 'close' );
                            $( '#msgDialog_lat > p' ).html( response.text );
		                    $( '#msgDialog_lat' ).dialog( 'option', 'title', 'Edicion Exitosa' ).dialog( 'open' );
               						     
					        $('#fila'+response.id+' > td#f1').html(response.contenido);
				        }						
                   } //fin success                   
              }); //fin llamada ajax()
             return false; 
         },           
			//boton que cierra el cuadro de dialogo
            'Cancelar': function() {
                
                $( this ).dialog( 'close' );
            }
        }
        
    }); //fin del cuadro de dialogo ""editarDialog"  
    
    
  //cuadro de dialogo de confirmacion de una edicion de aviso  
  $( '#msgDialog_lat' ).dialog({
        autoOpen: false,
        
        buttons: {
            'Ok': function() {
                $( this ).dialog( 'close' );
                document.location = base_url+'panel_lateral';     
            }
        },
        modal: true
    });  
          	  
/*******************************************************************************************************************************
  Seccion para eliminar un aviso daae la cinta dae mensajes, se captura el evento click adael enlace eliminar, se consultan los
  datos del aviso, se carga un cuadro de dialogo para confirmar la eliminacion y se muestra un aviso de confirmacion,
 ********************************************************************************************************************************/ 
 $( '#tabla_avisos').delegate( 'a.eliminar_lat', 'click', function(event) {event.preventDefault();
 
        var id = $( this ).attr( 'href' );       
        //alert('Eliminar aviso con id :'+id);
       
       $.ajax({
                url: base_url+'panel_lateral/consultar_noticia_lat/'+ id,
                type: 'POST',
		    	dataType: 'json',       
                success: function( respuesta )
                {					
			     	// se cargan en el cuadro de confirmacion  los datos del aviso a eliminar 
				    $('#form-eliminar-lat #contenido' ).val(respuesta.contenido);
                    $( '#form-eliminar-lat #id' ).val(id );
                     
                    //abrimos el cuadro de dialogo que contendra el mensaje de confirmacion             
                    $( '#eliminarDialog_lat' ).dialog( 'open' );
		       }					
		 });
        return false; 	
	   }) 	  
 
  //configuracion del cuadro de dialogo para eliminar un aviso  
  $( '#eliminarDialog_lat' ).dialog({
        autoOpen: false,
        width: '450px',
        height: '350',
        modal: true,
        buttons: {
            'Eliminar': function() {
                //$( '#ajaxLoadAni' ).fadeIn( 'slow' );				
                $.ajax({
                    url: base_url+'panel_lateral/eliminar_noticia_lat',
                    type: 'POST',
					dataType: 'json',
                    data: $( '#eliminarDialog_lat form' ).serialize(),
					
                    // respuesta en formato JSON desde el metodo editar_aviso_pi()					
                    success: function( response ) 
                    {
                    
						// si la eliminacion del aviso ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
                        
					        $( '#eliminarDialog_lat' ).dialog( 'close' );
                            $( '#msgDialog_lat > p' ).html( response.text );
		                    $( '#msgDialog_lat' ).dialog( 'option', 'title', 'Eliminacion Exitosa' ).dialog( 'open' );
                            //$( '#ajaxLoadAni' ).fadeOut( 'slow' );		
						     
					        $('#fila'+response.id).remove();
				        						
                   } //fin success                   
              }); //fin llamada ajax()
            return false;  
         },           
			//boton que cierra el cuadro de dialogo
            'Cancelar': function() {
                $( this ).dialog( 'close' );
            }
        }
        
    }); //fin del cuadro de dialogo ""eliminarDialog"  
 /***********************************************************************************************************
  FIN TABLA DE EDICION DE NOTICIAS DEL PANEL LATERAL  
 ************************************************************************************************************/                
    
/*----------------------------------------------------------------------------------------------------------------------
  TABLA DE EDICION DE ARTICULOS Y TEXTO DEL PANEL PRINCIPAL, CONTROLA LAS ACCIONES, AGREGAR, EDTIAR Y ELIMINAR TEXTO  DEL PANEL
  PRINCPAL
 -------------------------------------------------------------------------------------------------------------------------*/
/*
 /*
  Seccion para editar un aviso daae la cinta dae mensajes, se captura el evento click adael enlace editar, se consultan los
  datos del aviso, se carga un cuadro de dialogo para actualizar y se muestra un aviso daae confirmacion,
 */
 
 $( '#tabla_avisos').delegate( 'a.editar_princ', 'click', function(event) {event.preventDefault();
        var id        = $( this ).attr( 'href' );
        //envio una consulta para recuperar datos del aviso consultado y cargarlos en el form de actualizacion via ajaxs
       $.ajax({
                url: base_url+'panel_principal/consultar_texto/'+ id,
                type: 'POST',
		    	dataType: 'json',       
                success: function( respuesta )
                {					
			      // se cargan en el form de actualizacion los datos del aviso a editar 
                  $('#form-edicion-princ #titulo' ).val(respuesta.titulo);
                  $('#form-edicion-princ #desc' ).val(respuesta.descripcion);                   
				  $('#form-edicion-princ #contenido' ).val(respuesta.contenido);
                  $( '#form-edicion-princ #id' ).val(id );                    
                  //abrimos el cuadro de dialogo que contendra el form de actualizacion             
                  $( '#editarPrincipal' ).dialog( 'open' );                  
		       }					
		 });
         return false;		
	   }) 
       
   //configuracion del cuadro de dialogo para actualizar    
  $('#editarPrincipal').dialog({
        autoOpen: false,
        width: '800px',
        height: '550',
        modal: true,
        buttons: {
            'Editar': function() {
                //$( '#ajaxLoadAni' ).fadeIn( 'slow' );
				
                $.ajax({
                    url: base_url+'panel_principal/editar_texto_principal',
                    type: 'POST',
					dataType: 'json',
                    data: $( '#editarPrincipal form' ).serialize(),
					
                    // respuesta en formato JSON desde el metodo editar_aviso_pi()					
                    success: function( response ) {
						
						if(response.aux==2)// si el texto esta vacio
						{
						   $( '#form-edicion-princ > p'  ).html(response.text );                            
											
						}																		
						// si la actualizacion de la deuda ha sido exitosa se carga el mensaje de confirmacion en otro cuadro de dialogo
                        if(response.aux==1)
					    {
					        $( '#editarPrincipal' ).dialog( 'close' );
                            $( '#msgDialog > p' ).html( response.text );
		                    $( '#msgDialog' ).dialog( 'option', 'title', 'Edicion Exitosa' ).dialog( 'open' );
                            //$( '#ajaxLoadAni' ).fadeOut( 'slow' );		
						     
					        $('#fila'+response.id+' > td#f1').html(response.titulo);
                            $('#fila'+response.id+' > td#f2').html(response.description);
                            $('#fila'+response.id+' > td#f3').html(response.contenido);
				        }						
                   } //fin success                   
              }); //fin llamada ajax()
             return false; 
         },           
			//boton que cierra el cuadro de dialogo
            'Cancelar': function() {
                
                $( this ).dialog( 'close' );
            }
        }
        
    }); //fin del cuadro de dialogo ""editarDialog"  
    
    
  //cuadro de dialogo de confirmacion de una edicion de aviso  
  $( '#msgDialog' ).dialog({
        autoOpen: false,
        
        buttons: {
            'Ok': function() {
                $( this ).dialog( 'close' );
                //document.location = base_url+'panel_lateral';     
            }
        },
        modal: true
    });  
          	  
               
   
   $('#visualizar').submit(function() {	
   $.ajax({
      type: 'POST',
      url: base_url+'panel_principal/actualizar_opcion',
      dataType: 'json',
      data:  $('#visualizar').serialize(),
      success: function(respuesta) {
             $('#visualizar > p' ).html(respuesta.text);
             //$( '#form-eliminar-lat #id' ).val(id );
              }
        
   });
   return false;
});
  
  $(function() {
   $('#upload_file').submit(function(e) {
      e.preventDefault();
      $.ajaxFileUpload({
        type: 'POST',
         url         :'./do_upload/',
         secureuri      :false,
         fileElementId  :'userfile',
         dataType    : 'json',
         data        : {
            'desc'       : $('#desc').val()
         },
         success  : function (data, status)
         {
            if(data.status != 'error')
            {
               $('#files').html('<p>Cargando lista de archivos...</p>');
               refresh_files();
               $('#desc').val('');
            }
            alert(data.msg);
         }
      });
      return false;
   });
 	    	
});

});
