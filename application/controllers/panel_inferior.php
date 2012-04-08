<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel_inferior extends CI_Controller {


     function __construct() {
// Funci�n constructora aqu� podemos hacer la carga de algunos elementos adicionales c�mo librer�as, helpers, etc...
                parent::__construct();
                $this->load->model('Home_model'); 
                $this->load->model('Panel_inferior_model'); 
                $data = array();
                $footer = array();
    }
    
     /* Metodo que recupera los avisos del panel inferior desde la BD, y los pone en 
         la cinta mensajes de la vista principal del panel
        
     */      
    public function index()
	{
        $footer['avisos'] = $this->Home_model->get_panel_inferior();                       
        $this->load->view('admin/contenido/editar_avisos_pi',$footer,true); 
               
        $data['header']    ='admin/header/header_main';
        $data['aside']     ='admin/sidebar/menu_lateral';
        $data['contenido'] ='admin/contenido/editar_avisos_pi';
        $data['footer']    ='admin/footer/footer_admin';  
        
        $this->load->view('admin/template_manager',$data);           
         
	}
    
 /*******************************************************************************************************************************
   SECCION DE GESTION DE CONTENIDO PARA EL  PANEL INFERIOR O CINTA DE MENSAJES, RECUPERACION, EDICION, CREACION y ELIMINACION
   DE MENSAJES 
 *********************************************************************************************************************************/
    
    /* este metodo recupera los datos de un aviso en particular por su id, y los carga en el form  via JSON que luego sera
       mostrado en el cuadro de dialogo para las operaciones edicion o eliminacion
    */   
    public function consultar_aviso_pi($id)
	{	
       $respuesta = $this->Panel_inferior_model->get_aviso($id); 
       echo  json_encode($respuesta);
      // echo  '{"contenido":"'.$respuesta['contenido'].'","id":"'.$respuesta['id'].'"}';                              
	}
    
   public function crear_aviso_pi()
   {		        		          
       $contenido  = $this->input->post('contenido');             						 
      
	     if(!empty($contenido))
         { 	 		          
            $respuesta = $this->Panel_inferior_model->crear_aviso($contenido);
            $respuesta['aux'] = 1;	
            $respuesta['contenido'] =$contenido;
            $respuesta['text'] ="<b>Aviso creado exitosamente</b>";
             echo  json_encode($respuesta);						 
		 }
	     else {
		      // Si el textarea del form de creacion es enviado sin datos es rechazado
		     $respuesta['text'] = "<b>Debe incluir el texto del aviso por favor<b>";
			 $respuesta['aux'] = 2;	
             echo  json_encode($respuesta);		
			// echo '{"text":"'.$text.'","aux":"'.$aux.'"}';	   
           }								           
												           
	} 
           
    /* metodo que recibe los datos del form de edicion de mensajes del panel inferior y realiza la actualizacion a traves del metodo
       correspondiente en el modelo Panel_inferior_model()
    */
    public function editar_aviso_pi()
   {		        		   
       $id         = $this->input->post('id');
       $contenido  = $this->input->post('contenido');
       
       $datos = array(             
               'contenido' => $contenido,              
            );
	        		          
	     if(!empty($contenido))
         { 	 		          
            $respuesta = $this->Panel_inferior_model->editar_aviso($id,$datos);
            $respuesta['aux'] = 1;
            $respuesta['id']  = $id;
            $respuesta['contenido']=$contenido;
            $respuesta['text']= "<b>Aviso Actualizado Correctamente</b>"; 
            echo json_encode($respuesta);
            //Devolvemos mediante notacion JSON los datos del aviso editado	
            //echo  '{"id":"'.$id.'","contenido":"'.$contenido.'","text":"<b>Aviso Actualizado Correctamente</b>","aux":"'.$aux.'"}';
				
		 }
	     else {
		      // Si el textarea del form de edicion es enviado sin datos es rechazado
		     $respuesta['text'] = "<b>Debe incluir el texto del aviso por favor</b>";
			 $respuesta['aux'] = 2;
             echo json_encode($respuesta);			
			// echo '{"text":"'.$text.'","aux":"'.$aux.'"}';	   
           }								           
	}
    
   /*Metodo para la eliminacion de un aviso de la cinta de mensajes en base a su id
   */ 
    public function eliminar_aviso_pi()
   {		        		   
       $id         = $this->input->post('id');
       $contenido  = $this->input->post('contenido');       
       $respuesta  = $this->Panel_inferior_model->eliminar_aviso($id); 
       
       $respuesta['id']        = $id;
       $respuesta['contenido'] = $contenido;
       $respuesta['text']      =  "<b>Aviso Eliminado Correctamente</b>";        
          							 
       //Devolvemos mediante notacion JSON los datos del aviso eliminado	
       //echo  '{"id":"'.$id.'","contenido":"'.$contenido.'","text":"<b>Aviso Eliminado Correctamente</b>"}';											           
	}     
   /*******************************************************************************************************************************
     FIN SECCION DE GESTION DE CONTENIDO PARA EL  PANEL INFERIOR O CINTA DE MENSAJES*/
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */