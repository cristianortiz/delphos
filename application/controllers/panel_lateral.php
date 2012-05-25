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
    public function editar()
    {
        $config = array();
        $config["base_url"] = base_url() . "panel_lateral/editar";
        $config["total_rows"] = $this->Home_model->record_count('lateral');
        $config["per_page"] = ROWS_FOR_PAGES;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $lateral["avisos"] = $this->Home_model->filas_paginadas('lateral', $config["per_page"],
            $page);
        $lateral["links"] = $this->pagination->create_links();
        $this->load->view('admin/contenido/editar_avisos_lat', $lateral, true); // CARGAMOS el template del sitio, con el contenido principal

        $data['header'] = 'admin/header/header_main';
        $data['aside'] = 'admin/sidebar/menu_lateral';
        $data['contenido'] = 'admin/contenido/editar_avisos_lat';
        $data['footer'] = 'admin/footer/footer_admin';

        $this->load->view('admin/template_manager', $data);
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

        if (!empty($contenido)) {
            if (strlen($contenido) < MAX_CHAR_LAT) {
                $respuesta = $this->Panel_lateral_model->crear_aviso($contenido);
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

    /*Metodo para la eliminacion de un aviso de la cinta de mensajes en base a su id
    */
    public function eliminar_noticia_lat()
    {
        $id = $this->input->post('id');
        $contenido = $this->input->post('contenido');
        $respuesta = $this->Panel_lateral_model->eliminar_aviso($id);
        $respuesta['text'] = "<b>Noticia Eliminada Correctamente<b>";
        $respuesta['id'] = $id;
        echo json_encode($respuesta);
    }

    /*******************************************************************************************************************************
    FIN SECCION DE GESTION DE CONTENIDO PARA EL  PANEL LATERAL DE NOTICIAS
    ******************************************************************************************************************************/

} // fin clase panel_lateral

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
