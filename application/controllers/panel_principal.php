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
        //$this->output->enable_profiler(TRUE);
    }
    /* Metodo que recupera los avisos del panel inferior desde la BD, y los pone en
    la cinta mensajes de la vista principal del panel      
    */
    public function editar()
    {
        if ($this->session->userdata('logged_in') != true) {
            redirect('login');
        }
        $config = array();
        $config["base_url"] = base_url() . "panel_principal/editar";
        $config["total_rows"] = $this->Home_model->record_count('principal');
        $config["per_page"] = ROWS_FOR_PAGES;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $principal['texto'] = $this->Home_model->filas_paginadas('principal', $config["per_page"],$page);
        $principal['links'] = $this->pagination->create_links();
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
        $response['contenido'] = $respuesta['contenido'];
        $response['titulo'] = $respuesta['titulo'];
        $response['descripcion'] = $respuesta['descripcion'];
        echo json_encode($response);
    }


    public function crear_nuevo_articulo()
    {
        $contenido = $this->input->post('contenido');
        $titulo = $this->input->post('titulo');
        $desc = $this->input->post('desc');

        $status = "";
        $msg = "";
        $file_element_name = 'articulo_img';
        $ruta = './recursos/images';
        if (!file_exists($ruta)) {
            //creamos el directorio para la empresa nueva agregada y le asignamos permisos de lec/esct
            mkdir($ruta, 0777);
        }
        if ($status != "error") {
            $config['upload_path'] = $ruta;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = false;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $url = base_url('recursos/images') . '/' . $data['file_name'];
                $file_id = $this->Panel_principal_model->crear_nuevo_articulo($data['file_name'],
                    $desc, $titulo, $contenido);
                if ($file_id) {
                    $status = "success";
                    $msg = "Articulo Creado  Correctamente";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "No hemos podido crear el articulo, intente de nuevo por favor";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    /* metodo que recibe los datos del form de edicion de mensajes del panel inferior y realiza la actualizacion a traves del metodo
    correspondiente en el modelo Panel_inferior_model()
    */
    public function editar_texto_principal()
    {
        $id = $this->input->post('id');
        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('desc');
        $contenido = $this->input->post('contenido');

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
            $respuesta['titulo'] = $titulo;
            $respuesta['descripcion'] = $descripcion;
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
    public function eliminar_articulo()
    {
        $id = $this->input->post('id');
        $contenido = $this->input->post('contenido');
        $respuesta = $this->Panel_principal_model->eliminar_texto($id);
        $respuesta['text'] = "<h3>Articulo Eliminado Correctamente</h3>";
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
        $principal['videos'] = $this->Home_model->filas_paginadas('video', $config["per_page"],$page);
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

        $descripcion = $this->input->post('desc');

        $ruta = './recursos/videos';
        if (!file_exists($ruta)) {
            //creamos el directorio para la empresa nueva agregada y le asignamos permisos de lec/esct
            mkdir($ruta, 0777);
        }
        if ($status != "error") {
            $config['upload_path'] = $ruta;
            $config['allowed_types'] = 'mp4|ogg|webm';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = false;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $url = base_url('recursos/videos') . '/' . $data['file_name'];
                $file_id = $this->Panel_principal_model->insert_file($data['file_name'], $descripcion,
                    $url, 'video/' . str_replace(".", "", $data['file_ext']));
                if ($file_id) {
                    $status = "success";
                    $msg = "Video Subido Correctamente";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "No hemos podido subir el archivo, intente de nuevo por favor";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function subir_video_online()
    {
        $titulo = $this->input->post('titulo');
        $enlace = $this->input->post('enlace');

        $file_id = $this->Panel_principal_model->insert_file('video online', $titulo, $enlace,
            'video/youtube');
        if ($file_id) {
            $status = "success";
            $msg = "Video Subido Correctamente";
        } else {

            $status = "error";
            $msg = "No hemos podido agregar el enlace, intente de nuevo por favor";
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));

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
        $tiempo = $this->input->post('tiempo');
        $tiempo_mls = $tiempo*60*1000;
        $datos = array('desplegar' => $opcion, 'tiempo' => $tiempo_mls);
        $respuesta = $this->Panel_principal_model->actualizar_opcion($id, $datos);
        $respuesta['text'] = "<h3>Opcion '" . $opcion ."' Configurada Correctamente</h3>";
        $respuesta['id'] = $id;
        $respuesta['status'] = 'succes';
        echo json_encode($respuesta);
    }
    
     public function cambiar_a_texto()
    {
        $id = $this->input->post('id');
        $opcion = $this->input->post('opcion');
        $datos = array('desplegar' => $opcion);
        $respuesta = $this->Panel_principal_model->actualizar_opcion($id, $datos);      
        $respuesta['id'] = $id;
        $respuesta['status'] = 'succes';
        echo json_encode($respuesta);
    }

    public function recupera_tiempo()
    {
        $id = $this->input->post('id');
        $respuesta = $this->Panel_principal_model->recupera_tiempo();
        $respuesta['status'] = 'succes';
        echo json_encode($respuesta);
    }

    public function cambiar_a_video()
    {
        $id = $this->input->post('id');
        $opcion = $this->input->post('opcion');

        $visualizar = $this->Home_model->get_visualizacion();
        if ($visualizar['desplegar'] == TEXT_MODE) {

            $datos = array('desplegar' => $opcion, );
            $respuesta = $this->Panel_principal_model->actualizar_opcion($id, $datos);
            $respuesta['status'] = 'succes';
            echo json_encode($respuesta);
        } else {
            $respuesta['status'] = 'error';
            echo json_encode($respuesta);
        }

    }

    public function consultar_video($id)
    {
        $respuesta = $this->Panel_principal_model->get_video($id);
        echo json_encode(array(
            'nombre' => utf8_encode($respuesta['nombre']),
            'id' => $id,
            'desc' => $respuesta['descripcion'],
            'tipo' => $respuesta['tipo']));
    }
    public function borrar_video()
    {
        //parametros para la respuesta a la llamada de Ajax
        $status = "";
        $msg = "";

        $id = $this->input->post('id');
        $nombre_video = $this->input->post('nombre_video');
        $tipo_video = $this->input->post('tipo_video');
        try {

            $file_id = $this->Panel_principal_model->borrar_video($id);

            if ($tipo_video != 'video/youtube') {
                unlink('./recursos/videos/' . $nombre_video);
            }
            $status = "success";
            $msg = "Video borrado exitosamente!";
        }
        catch (exception $e) {
            $status = "error";
            $msg = $e->getMessage();
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }


    public function actualizar_imagen()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';

        $id = $this->input->post('id');
        $ruta = './recursos/images';
        if (!file_exists($ruta)) {
            //creamos el directorio para la empresa nueva agregada y le asignamos permisos de lec/esct
            mkdir($ruta, 0777);
        }
        if ($status != "error") {
            $config['upload_path'] = $ruta;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = false;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $url = base_url('recursos/images') . '/' . $data['file_name'];
                $file_id = $this->Panel_principal_model->actualizar_imagen($data['file_name'], $id);
                if ($file_id) {
                    $status = "success";
                    $msg = "Imagen Subida Correctamente";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "No hemos podido subir el archivo, intente de nuevo por favor";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function consultar_imagen($id)
    {
        $respuesta = $this->Panel_principal_model->get_imagen($id);
        echo json_encode(array('nombre' => $respuesta['imagen'], 'id' => $id));
    }
    public function borrar_imagen()
    {
        //parametros para la respuesta a la llamada de Ajax
        $status = "";
        $msg = "";

        $id = $this->input->post('id');
        $nombre_video = $this->input->post('nombre_imagen');

        try {

            $file_id = $this->Panel_principal_model->borrar_imagen($id);
            unlink('./recursos/images/' . $nombre_video);
            $status = "success";
            $msg = "Imagen borrada exitosamente!";
        }
        catch (exception $e) {
            $status = "error";
            $msg = $e->getMessage();
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }


} // fin clase panel_lateral

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
?>