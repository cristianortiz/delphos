<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
     function __construct() // Funci�n constructora aqu� podemos hacer la carga de algunos elementos adicionales c�mo librer�as, helpers, etc...
     {    
        parent::__construct();            
        $this->load->model('Login_model');               
     }    
    
    public function index()
	{
	     /*cargamos la vista login de la seccion de administracion del panel*/
         $data['header']    ='admin/header/header_main';
         //$data['aside']     ='sidebar/menu_lateral';
         $data['contenido'] ='admin/formularios/form_login';
         $data['footer']    ='admin/footer/footer_admin';                  
         $this->load->view('admin/template_admin',$data);  // CARGAMOS el template del sitio de administracion, con el contenido principal
	}
    
    public function manager()
	{
		//m�todo index del controlador, desde esta funci�n cargamos vistas obtenemos datos de los modelos, etc.
              
        //cargamos en la variable 'contenido' del array $data, la vista con el contenido principal del sitio.
       //tambien cargamos la vista con el formulario de login 
        /*cargamos la vista login de la seccion de administracion del panel*/
         
         $data['header']    ='admin/header/header_main';
         $data['contenido'] ='admin/contenido/menu_edicion';
         $data['footer']    ='admin/footer/footer_admin';  
                
         $this->load->view('admin/template_manager',$data);  // CARGAMOS                       
	}
    
     public function manager2()
	{
		//m�todo index del controlador, desde esta funci�n cargamos vistas obtenemos datos de los modelos, etc.
              
        //cargamos en la variable 'contenido' del array $data, la vista con el contenido principal del sitio.
       //tambien cargamos la vista con el formulario de login 
        /*cargamos la vista login de la seccion de administracion del panel*/
         
         $data['header']    ='admin/header/header_main';
         $data['contenido'] ='admin/contenido/menu_edicion';
         $data['footer']    ='admin/footer/footer_admin';  
                
         $this->load->view('admin/template_manager',$data);  // CARGAMOS                       
	}
}
/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
?>