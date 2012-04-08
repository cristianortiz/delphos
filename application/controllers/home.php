<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home
 * 
 * @package sacfar
 * @author cristian
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class Home extends CI_Controller {

     function __construct() {
// Función constructora aquí podemos hacer la carga de algunos elementos adicionales cómo librerías, helpers, etc...
                parent::__construct();
                $this->load->model('Home_model');
                $this->load->model('Panel_principal_model');  
                $data = array();
                $avisos = array();
    }        
    
	/**
	 * Home::index()
	 * Metodo de la clase Home que carga los contenidos del panel desde la BD
     * Segun la configuracion despliega solo texto o una lista de videos
	 * @return void
	 */
	public function index()
	{
        $footer['avisos'] = $this->Home_model->get_panel_inferior();
        $this->load->view('footer/footer',$footer,true); 
        
        $lateral['noticias'] = $this->Home_model->get_panel_lateral();
        $this->load->view('sidebar/sidebar',$lateral,true); 
        
        $visualizar = $this->Home_model->get_visualizacion();
        
        if($visualizar['desplegar'] =='texto')
        {                  
              $principal['texto'] = $this->Home_model->get_panel_principal();
              $this->load->view('contenido/contenido_texto',$principal,true); 
              $vista ='contenido/contenido_texto';
              $opcion = $visualizar['desplegar'];
        }
        else{
              $principal['video'] = $this->Panel_principal_model->get_videos();
              $this->load->view('contenido/contenido_videos',$principal,true); 
              $vista ='contenido/contenido_videos';
              $opcion = $visualizar['desplegar'];
            }
              
       //se arma el array data[] con el contenido de cada seccion del panel para ser cargados en la vista template
         $data['header']    ='header/header_main';
         $data['aside']     ='sidebar/sidebar';
         $data['contenido'] =$vista;
         $data['opcion']    =$opcion;
         $data['footer']    ='footer/footer'; 
                
         $this->load->view('template',$data);  // CARGAMOS el template del sitio, con el contenido principal
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */