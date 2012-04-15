<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Panel_principal extends CI_Controller
{

    function __construct()
    {
        // Función constructora aquí podemos hacer la carga de algunos elementos adicionales cómo librerías, helpers, etc...
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Panel_principal_model');
        $this->load->helper('text');
        $data = array();
        $footer = array();
    }
    /* Metodo que recupera los avisos del panel inferior desde la BD, y los pone en
    la cinta mensajes de la vista principal del panel      
    */
    public function editar()
    {
        $principal['texto'] = $this->Home_model->get_panel_principal();
        $this->load->view('admin/contenido/editar_principal', $principal, true); // CARGAMOS el template del sitio, con el contenido principal

        $data['header'] = 'admin/header/header_main';
        $data['aside'] = 'admin/sidebar/menu_lateral';
        $data['contenido'] = 'admin/contenido/editar_principal';
        $data['footer'] = 'admin/footer/footer_admin';

        $this->load->view('admin/template_manager', $data); // CARGAMOS

    }
    /*******************************************************************************************************************************
    SECCION DE GESTION DE CONTENIDO PARA LAS NOTICIAS DEL PANEL LATERAL, RECUPERACION, EDICION, CREACION y ELIMINACION
    DE NOTICIAS
    *********************************************************************************************************************************/

    /* este metodo recupera los datos de una noticia en particular por su id, y los carga en el form  via JSON que luego sera
    mostrado en el cuadro de dialogo para las operaciones edicion o eliminacion
    */
    public function consultar_texto($id)
    {
        $respuesta = $this->Panel_principal_model->get_texto($id);
        $response['contenido'] = (utf8_encode($respuesta['contenido']));
        $response['titulo'] = (utf8_encode($respuesta['titulo']));
        $response['descripcion'] = (utf8_encode($respuesta['descripcion']));
        echo json_encode($response);
    }

    public function crear_texto_principal()
    {
        $contenido = $this->input->post('contenido');

        if (!empty($contenido)) {
            $respuesta = $this->Panel_principal_model->crear_texto($contenido);
            $respuesta['aux'] = 1;
            $respuesta['text'] = "<b>Noticia creada exitosamente</b>";
            echo json_encode($respuesta);
            //Devolvemos mediante notacion JSON los datos del aviso nuevo creado
            //   echo  '{"contenido":"'.$contenido.'","text":"<b>Noticia creada exitosamente</b>","aux":"'.$aux.'"}';

        } else {
            // Si el textarea del form de creacion es enviado sin datos es rechazado
            $respuesta['text'] = "<b>Debe incluir el texto de la noticia por favor<b>";
            $respuesta['aux'] = 2;
            echo json_encode($respuesta);
            //echo '{"text":"'.$text.'","aux":"'.$aux.'"}';
        }
    }

    /* metodo que recibe los datos del form de edicion de mensajes del panel inferior y realiza la actualizacion a traves del metodo
    correspondiente en el modelo Panel_inferior_model()
    */
    public function editar_texto_principal()
    {
        $id = $this->input->post('id');
        $titulo = utf8_decode($this->input->post('titulo'));
        $descripcion = utf8_decode($this->input->post('desc'));
        $contenido = utf8_decode($this->input->post('contenido'));

        $datos = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'contenido' => $contenido,
            );

        if (!empty($contenido)) {
            $respuesta = $this->Panel_principal_model->editar_texto($id, $datos);
            $respuesta['aux'] = 1;
            $respuesta['text'] = "<b>Articulo Editado Correctamente</b>";
            $respuesta['id'] = $id;
            $respuesta['titulo'] = utf8_encode($titulo);
            $respuesta['descripcion'] = utf8_encode($descripcion);
            $respuesta['contenido'] = word_limiter(str_replace('<h2>', "", utf8_encode($contenido)),
                5);
            echo json_encode($respuesta);

        } else {
            // Si el textarea del form de edicion es enviado sin datos es rechazado
            $respuesta['text'] = "Debe incluir el texto de la noticia por favor";
            $respuesta['aux'] = 2;
            echo json_encode($respuesta);

        }
    }

    /*Metodo para la eliminacion de un aviso de la cinta de mensajes en base a su id
    */
    public function eliminar_texto()
    {
        $id = $this->input->post('id');
        $contenido = $this->input->post('contenido');
        $respuesta = $this->Panel_lateral_model->eliminar_aviso($id);
        $respuesta['text'] = "<b>Noticia Eliminada Correctamente<b>";
        $respuesta['id'] = $id;
        echo json_encode($respuesta);
    }

    /*******************************************************************************************************************************
    FIN SECCION DE GESTION DE CONTENIDO PARA EL  PANEL PRINCIPAL
    ******************************************************************************************************************************/
    public function videos()
    {
        $config = array();
        $config["base_url"] = base_url() . "panel_principal/videos";
        $config["total_rows"] = $this->Home_model->record_count('video');
        $config["per_page"] = ROWS_FOR_PAGES;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $principal['videos'] = $this->Home_model->filas_paginadas('video',$config["per_page"], $page);
        $principal['links'] = $this->pagination->create_links(); 
        
        
        $this->load->view('admin/contenido/editar_videos', $principal, true); // CARGAMOS el template del sitio, con el contenido principal

        $data['header'] = 'admin/header/header_main';
        $data['aside'] = 'admin/sidebar/menu_lateral';
        $data['contenido'] = 'admin/contenido/editar_videos';
        $data['footer'] = 'admin/footer/footer_admin';

        $this->load->view('admin/template_manager', $data); // CARGAMOS
    }

    public function do_upload()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';

        if (empty($_POST['desc'])) {
            $status = "error";
            $msg = "Please enter a title";
        }

        if ($status != "error") {
            $config['upload_path'] = './recursos/videos/';
            $config['allowed_types'] = 'webm|ogg|mp4|flv|pdf';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = false;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $file_id = $this->Panel_principal_model->insert_file($data['file_name'], $_POST['desc']);
                if ($file_id) {
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
      public function borrar_video($id)
    {
        $id = $this->input->post('id');
        $opcion = $this->input->post('opcion');
        $datos = array('desplegar' => $opcion, );
        $respuesta = $this->Panel_principal_model->actualizar_opcion($id, $datos);
        $respuesta['text'] = "<b>Opcion '" . $opcion . "' Configurada Correctamente<b>";
        $respuesta['id'] = $id;
        echo json_encode($respuesta);
    }

    public function opciones()
    {
        $visualizar['opcion'] = $this->Home_model->get_visualizacion();
        $this->load->view('admin/contenido/opciones', $visualizar, true); // CARGAMOS el template del sitio, con el contenido principal

        $data['header'] = 'admin/header/header_main';
        $data['aside'] = 'admin/sidebar/menu_lateral';
        $data['contenido'] = 'admin/contenido/opciones';
        $data['footer'] = 'admin/footer/footer_admin';

        $this->load->view('admin/template_manager', $data); // CARGAMOS
    }
    
    public function actualizar_opcion()
    {
        $id = $this->input->post('id');
        $opcion = $this->input->post('opcion');
        $datos = array('desplegar' => $opcion, );
        $respuesta = $this->Panel_principal_model->actualizar_opcion($id, $datos);
        $respuesta['text'] = "<b>Opcion '" . $opcion . "' Configurada Correctamente<b>";
        $respuesta['id'] = $id;
        echo json_encode($respuesta);
    }
} // fin clase panel_lateral

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
