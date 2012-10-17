<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

    function __construct()
    {
        // Función constructora aquí podemos hacer la carga de algunos elementos adicionales cómo librerías, helpers, etc...
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Usuarios_model');
        $data = array();

    }

    public function editar()
    {
        if ($this->session->userdata('logged_in') != true) {
            redirect('login');
        }

        $config["base_url"] = base_url() . "panel_principal/usuarios/editar";
        $config["total_rows"] = $this->Usuarios_model->record_count('academico');
        $config["per_page"] = ROWS_FOR_PAGES;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $usuarios['lista_usuarios'] = $this->Usuarios_model->filas_paginadas('academico', $config["per_page"],$page);
        $usuarios['links'] = $this->pagination->create_links();

        $titulo_panel = 'Usuarios: Administrar cuentas de usuario';
        $enlace_panel = 'usuarios';
        $btn_nuevo = 'nuevo_usuario';
        $label_nuevo = 'Nuevo Usuario';
        $btn_eliminar = 'btn_eliminar_usuarios';
        $label_eliminar = 'Eliminar';
        
        $usuarios['datos_panel'] = array(
            'titulo_panel' => $titulo_panel,
            'btn_nuevo' => $btn_nuevo,
            'label_nuevo' => $label_nuevo,
            'btn_eliminar' => $btn_eliminar,
            'label_eliminar' => $label_eliminar);
        
        $this->load->view('admin/contenido/editar_usuarios', $usuarios, true); // CARGAMOS el template del sitio, con el contenido principal

        $data['header'] = 'admin/header/header_main';
        $data['aside'] = 'admin/sidebar/menu_lateral';
        $data['contenido'] = 'admin/contenido/editar_usuarios';
        $data['footer'] = 'admin/footer/footer_admin';

        $this->load->view('admin/template_manager', $data); // CARGAMOS

    }

    /*******************************************************************************************************************************
    SECCION DE GESTION DE CONTENIDO PARA EL  PANEL INFERIOR O CINTA DE MENSAJES, RECUPERACION, EDICION, CREACION y ELIMINACION
    DE MENSAJES 
    *********************************************************************************************************************************/

    /* este metodo recupera los datos de un aviso en particular por su id, y los carga en el form  via JSON que luego sera
    mostrado en el cuadro de dialogo para las operaciones edicion o eliminacion
    */
    public function consultar_usuario($id)
    {
        $respuesta = $this->Usuarios_model->get_usuario($id);
       
        echo json_encode($respuesta);
    }

    public function crear_nuevo_usuario()
    {
        $datos = array();   
        $datos['username']  = $this->input->post('username');
        $datos['password']  = $this->input->post('password');
        $datos['email']     = $this->input->post('email');
        $datos['perfil_id'] = $this->input->post('perfil_id');

        $respuesta = $this->Usuarios_model->crear_nuevo_usuario($datos);
        $aux = 1;
        echo json_encode(array('aux' => $aux, 'text' => 'Usuario creado correctamente'));


    }

    /* metodo que recibe los datos del form de edicion de mensajes del panel inferior y realiza la actualizacion a traves del metodo
    correspondiente en el modelo Panel_inferior_model()
    */
    public function editar_usuario()
    { 
        $id = $this->input->post('id');
        
        $datos = array();
        $datos['username']  = $this->input->post('username');
        $datos['password']  = $this->input->post('password');
        $datos['email']     = $this->input->post('email');
        $datos['perfil_id'] = $this->input->post('perfil_id');

        $respuesta = $this->Usuarios_model->editar_usuario($id,$datos);
        $aux = 1;
        echo json_encode(array('aux' => $aux, 'text' => 'Informacion editada correctamente'));
    }

    /*Metodo para la eliminacion de un aviso de la cinta de mensajes en base a su id
    */
    public function eliminar_usuarios()
    {
        $array_id = $this->input->post('array_id'); 
        $respuesta = $this->Usuarios_model->eliminar_usuarios($array_id);

        //Devolvemos mediante notacion JSON los datos del aviso eliminado
         echo json_encode(array( 'text' => 'Usuarios eliminados correctamente'));
    }
    /*******************************************************************************************************************************
    FIN SECCION DE GESTION DE CONTENIDO PARA EL  PANEL INFERIOR O CINTA DE MENSAJES*/

}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
