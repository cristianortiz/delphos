<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Panel_lateral extends CI_Controller
{

    function __construct()
    {
        // Función constructora aquí podemos hacer la carga de algunos elementos adicionales cómo librerías, helpers, etc...
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Panel_lateral_model');
        $data = array();
        $footer = array();
    }
    /* Metodo que recupera los avisos del panel inferior desde la BD, y los pone en
    la cinta mensajes de la vista principal del panel      
    */
    public function editar($estado)
    {
          if ($this->session->userdata('logged_in') != true) {
            redirect('login');
        }
        $config = array();
        $config["base_url"] = base_url() . "panel_lateral/editar";
        $config["total_rows"] = $this->Home_model->record_count('lateral',$estado);
        $config["per_page"] = ROWS_FOR_PAGES;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $lateral["avisos"] = $this->Home_model->filas_paginadas('lateral', $config["per_page"],$page,$estado);
        $lateral["links"] = $this->pagination->create_links();
        $lateral['estado'] = $estado;
        $lateral['input_panel'] = 'panel_lateral';
        $lateral['input_contenido'] = 'noticia'; 
        
        $enlace_panel = 'panel_lateral';
        $btn_nuevo ='nueva_noticia'; 
        $label_nuevo ='Nueva Noticia ';
        
         if($estado == ACTIVO){
            $titulo_panel = 'Panel Lateral: Noticias Activas';
            $btn_estado ='btn_desactivar'; 
            $label_estado ='Desactivar';
        }
        else{
            $titulo_panel = 'Panel Lateral: Historial Noticias Desactivadas';
            $btn_estado ='btn_activar'; 
            $label_estado ='Activar';
            
        }
         $cabecera['links_cabecera'] = array( array( 'enlace' => "$enlace_panel/editar/activo", 
                                        'enlace_label' => "Noticias"                                   
                                    ),
                             
                               array( 'enlace' =>  "$enlace_panel/opciones", 
                                        'enlace_label' => "Opciones"        
                                    ),
                                array( 'enlace' =>  "$enlace_panel/editar/desactivado", 
                                        'enlace_label' => "Historial"        
                                    )     
                              
                             );
          $cabecera['datos_panel'] = array( 'titulo_panel' => $titulo_panel,          
                                             'estado'=> $estado,
                                             'btn_estado'=>$btn_estado,
                                             'label_estado'=> $label_estado,
                                             'btn_nuevo'=>$btn_nuevo,
                                             'label_nuevo'=> $label_nuevo
                                                
                                    );     
                                              
        $this->load->view('admin/contenido/cabecera_panel_edicion',$cabecera,true);
        
        $this->load->view('admin/contenido/editar_avisos_lat', $lateral, true); // CARGAMOS el template del sitio, con el contenido principal

        $data['header'] = 'admin/header/header_main';
        $data['aside'] = 'admin/sidebar/menu_lateral';
        $data['contenido'] = 'admin/contenido/editar_avisos_lat';
        $data['footer'] = 'admin/footer/footer_admin';

        $this->load->view('admin/template_manager', $data);
    }
    
     public function cambiar_estado_noticia()
    {
        $array_id = $this->input->post('array_id');
        $estado = $this->input->post('estado');
        $datos = array('estado' => $estado);
        $respuesta = $this->Panel_lateral_model->cambiar_estado_noticia($array_id,$datos);
        if($estado == 'desactivado'){
            $respuesta['text'] = "<h3>Noticias Desactivadas Correctamente</h3>";
        }
        else{
            
            $respuesta['text'] = "<h3> Noticias Reactivadoa Correctamente</h3>";
        }
        echo json_encode($respuesta);
    }
    /*******************************************************************************************************************************
    SECCION DE GESTION DE CONTENIDO PARA LAS NOTICIAS DEL PANEL LATERAL, RECUPERACION, EDICION, CREACION y ELIMINACION
    DE NOTICIAS
    *********************************************************************************************************************************/

    /* este metodo recupera los datos de una noticia en particular por su id, y los carga en el form  via JSON que luego sera
    mostrado en el cuadro de dialogo para las operaciones edicion o eliminacion
    */
    public function consultar_noticia_lat($id)
    {
        $respuesta = $this->Panel_lateral_model->get_aviso($id);
        echo json_encode($respuesta);
        // echo  '{"contenido":"'.$respuesta['contenido'].'","id":"'.$respuesta['id'].'"}';
    }

    public function crear_noticia_lat()
    {
        $contenido = $this->input->post('contenido');
        $estado = ACTIVO;

        if (!empty($contenido)) {
            if (strlen($contenido) < MAX_CHAR_LAT) {
                $respuesta = $this->Panel_lateral_model->crear_noticia($contenido,$estado);
                $respuesta['aux'] = 1;
                $respuesta['contenido'] = $contenido;
                $respuesta['text'] = "<b>Noticia creada exitosamente</b>";
                echo json_encode($respuesta);
            } else {
                // Si el textarea del form de creacion supera el maximo de caracteres permitido
                $respuesta['text'] = "<b>El texto supera el maximo de carateres permitido<b>";
                $respuesta['aux'] = 2;
                echo json_encode($respuesta);
            }
        } else {
            // Si el textarea del form de creacion es enviado sin datos es rechazado
            $respuesta['text'] = "<b>La noticia debe incluir el texto por favor<b>";
            $respuesta['aux'] = 2;
            echo json_encode($respuesta);
        }
    }

    /* metodo que recibe los datos del form de edicion de mensajes del panel inferior y realiza la actualizacion a traves del metodo
    correspondiente en el modelo Panel_inferior_model()
    */
    public function editar_noticia_lat()
    {
        $id = $this->input->post('id');
        $contenido = $this->input->post('contenido');

        $datos = array('contenido' => $contenido, );
        if (!empty($contenido)) {
            if (strlen($contenido) < MAX_CHAR_LAT) {
                $respuesta = $this->Panel_lateral_model->editar_aviso($id, $datos);
                $respuesta['aux'] = 1;
                $respuesta['contenido'] = $contenido;
                $respuesta['text'] = "<b>Noticia Editada Correctamente</b>";
                echo json_encode($respuesta);
            } else {
                // Si el textarea del form de creacion supera el maximo de caracteres permitido
                $respuesta['text'] = "<b>El texto supera el maximo de carateres permitido<b>";
                $respuesta['aux'] = 2;
                echo json_encode($respuesta);
            }
        } else {
            // Si el textarea del form de creacion es enviado sin datos es rechazado
            $respuesta['text'] = "<b>Debe incluir el texto del aviso por favor<b>";
            $respuesta['aux'] = 2;
            echo json_encode($respuesta);
        }
    }

    /*Metodo para la eliminacion de una noticia del panel lateral en base a su id
    */
    public function eliminar_noticia()
    {
        $array_id = $this->input->post('array_id');
        $respuesta = $this->Panel_lateral_model->eliminar_noticia($array_id);
        $respuesta['text'] = "<b>Noticia Eliminada Correctamente<b>";
        echo json_encode($respuesta);
    }

    /*******************************************************************************************************************************
    FIN SECCION DE GESTION DE CONTENIDO PARA EL  PANEL LATERAL DE NOTICIAS
    ******************************************************************************************************************************/

} // fin clase panel_lateral

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
