$(document).ready(function(){
    //variables de servidor
    
    var base_url        = 'http://localhost/delphos/index.php';
    var base_url_images = 'http://localhost/sysmatmvc/';
	/* variables que representan el total de una deuda extraido de la BD, puede cambiar segun el numero	
	   de hermanos de un alumno que tambien estudien en el colegio*/
    
    //Funcion que permite validar el formulario de login
         $("#form_login").validate({ 
          rules: { 
	        usuario: "required",
            password: "required"
			
          },
          messages: { 
            usuario: "Ingrese un nombre de usuario porfavor",
            password: "Ingrese una contraseña porfavor"
          },          
          submitHandler:function(){
                $.ajax({
                type: 'POST',
                url: base_url+'/login/login_user',
                data: $('#form_login').serialize(),
                // Mostramos un mensaje con la respuesta de PHP
                success: function(data) {
                  if(data=='1'){
		              document.location =base_url+'/plantilla/';		 
		          }	
	              else{
		              $('#res_login').html('Login incorrecto, verifique usuario y contraseña').addClass('error'); 			
		          }   
                }
                })
          }        
         });
         
	
}); //fin document ready
