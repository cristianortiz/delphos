<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inicio extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//método index del controlador, desde esta función cargamos vistas obtenemos datos de los modelos, etc.
              
                //cargamos en la variable 'contenido' del array $data, la vista con el contenido principal del sitio.
                //tambien cargamos la vista con el formulario de login 
                 $data['contenido']  ='contenido/contenido_main';
                 $data['form_login'] ='formularios/form_login'; 
                
                 $this->load->view('template',$data);  // CARGAMOS el template del sitio, con el contenido principal
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/inicio.php */