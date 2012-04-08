<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
     function __construct() // Función constructora aquí podemos hacer la carga de algunos elementos adicionales cómo librerías, helpers, etc...
     {    
        parent::__construct();            
        $this->load->model('Login_model');               
     }    
        
    /*--------------------------------------------------------------------------------------------------------------------------------------------
     esta funcion  valida los campos del formulario de login usando el form_validator de CI ademas limpia los datos del POST
     y llama a la funcion callback_username_chek para validar si existe el usuario ingresado, si se pasan las validaciones se hace verifican los datos del
     usuario en la BD para iniciar sesion y determinar su perfil
    ----------------------------------------------------------------------------------------------------------------------------------------------*/    
	public function index()
   	{  	    
       $this->form_validation->set_rules('username', 'Usuario', 'trim|required|callback_username_check|xss_clean');//funcion personalizada de validacion para username
       $this->form_validation->set_rules('password', 'Password', 'trim|required'); // exige que se ingrese un password
       
       //si las validaciones fallan, cargo nuevamente el form mostrando los mensajes de error, en la vista form_login           
       if ($this->form_validation->run() == FALSE)
		{
		    $data['header']    ='header/header_main';
            $data['contenido'] ='admin/formularios/form_login';
            $data['footer']    ='admin/footer/footer_admin';  
                
            $this->load->view('admin/template_admin',$data);  // CARGAMOS el template del sitio de administracion, con el contenido principal
		}
        // si los datos pasan las validaciones se limpia el POST y se inicia el proceso de login para ingresar al sistema
		else
        {
	        $username = $this->input->post('username');
	        $password = $this->input->post('password'); 
             
            $admin = $this->Login_model->admin_check($username,$password); // verifica si el usuario es un administrador
                            
               // si el usuario es administrador se inicia sesion y se le redirige a la pagina de admnistracion
               if($admin['resultado'] > 0)
               {
                  $this->session->set_userdata(array('logged_in' =>true,'username' => $username,'perfil' => $admin['perfil_id']));
                  redirect("admin/manager");         
               }
               // si no es admnistrador se verifica que sea un usuario registrado
               else
               {       
                   $existe = $this->Login_model->login_user($username,$password);                  
                   // si es un usuario registrado se inicia sesion y se redirige a la pagina inicial del sistema
                   if($existe['resultado'] > 0)
                   {
                       $this->session->set_userdata(array('logged_in' =>true,'username' => $username,'perfil' => $existe['perfil_id']));
                       
                       redirect("admin/manager");                         
                   }
                   // si el login es incorrecto se carga nuevamente el form_login con el mensaje de error correspondiente
                   else
                   {                        
                      $data['header']    ='header/header_main';
                      $data['contenido'] ='admin/formularios/form_login';
                      $data['footer']    ='admin/footer/footer_admin';                      
                      $data['login_fail'] ='<div class="error_pass">El password ingresado es incorrecto</div>'; 
                      
                      $this->load->view('admin/template_admin',$data);  // CARGAMOS el template del sitio de administracion, con el contenido principal             
                                  
                   }
                }
    	   }
	}
    
    // funcion que consulta a la BD si existe el usuario ingresado en el campo Usuario, usando los callbacks del form_validator de CI
    function username_check($username)
	{
	  if($username!='admin')
      {
    	  $existe = $this->Login_model->username_check($username);
                      
             if($existe['resultado'] > 0 )
             {          
                return TRUE;
             }
             // si el usuario no existe se devuelve un mensaje de error personalizado
             else
             {                        
                $this->form_validation->set_message('username_check', 'El %s "'.$username.'" no esta registrado');
                return FALSE;
             }
       }
       else{
             return TRUE;
          }
	} 
              
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
?>