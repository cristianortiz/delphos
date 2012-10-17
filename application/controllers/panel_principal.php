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
    /* Metodo para mostrar los articulos del panel principal, si se hace clik en Articulos en la barra de menu,
    se mostraran solo los articulos activos,  y que aparecen en la seccion de Visualizacion del Panel, si se presiona
    en Historial, se mostraran los articulos desactivados.
    */
    public function editar($estado)
    {
        if ($this->session->userdata('logged_in') != true) {
            redirect('login');
        }
         $config = array();
        if($estado == ACTIVO){
            $config["base_url"] = base_url() . "panel_principal/editar/activo";
        }
        else{
            $config["base_url"] = base_url() . "panel_principal/editar/desactivado";
        }
        $config["total_rows"] = $this->Home_model->record_count('principal', $estado);
        $config["per_page"] = ROWS_FOR_PAGES;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $principal['texto'] = $this->Home_model->filas_paginadas('principal', $config["per_page"],$page, $estado);
        $principal['links'] = $this->pagination->create_links();
        $principal['estado'] = $estado;
        $principal['input_panel'] = 'panel_principal';
        $principal['input_contenido'] = 'articulo';

        $enlace_panel = 'panel_principal';
        $btn_nuevo = 'nuevo_articulo';
        $label_nuevo = 'Nuevo Articulo';


        if ($estado == ACTIVO) {
            $titulo_panel = 'Panel Principal: Articulos Activos';
            $btn_estado = 'btn_desactivar';
            $label_estado = 'Desactivar';
        } else {
            $titulo_panel = 'Panel Principal: Historial Articulos Desactivados';
            $btn_estado = 'btn_activar';
            $label_estado = 'Activar';

        }

        $cabecera['links_cabecera'] = array(
            array('enlace' => "$enlace_panel/editar/activo", 'enlace_label' => "Articulos"),
            array('enlace' => "$enlace_panel/videos", 'enlace_label' => "Videos"),
            array('enlace' => "$enlace_panel/opciones", 'enlace_label' => "Opciones"),
            array('enlace' => "$enlace_panel/editar/desactivado", 'enlace_label' =>
                    "Historial"));
        $cabecera['datos_panel'] = array(
            'titulo_panel' => $titulo_panel,
            'estado' => $estado,
            'btn_estado' => $btn_estado,
            'label_estado' => $label_estado,
            'btn_nuevo' => $btn_nuevo,
            'label_nuevo' => $label_nuevo);

        $this->load->view('admin/contenido/cabecera_panel_edicion', $cabecera, true);
        $this->load->view('admin/contenido/editar_principal_test', $principal, true); // CARGAMOS el template del sitio, con el contenido principal

        $data['header'] = 'admin/header/header_main';
        $data['aside'] = 'admin/sidebar/menu_lateral';
        $data['contenido'] = 'admin/contenido/editar_principal_test';
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
        $estado = ACTIVO;

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
                $file_id = $this->Panel_principal_model->crear_nuevo_articulo($data['file_name'],$desc, $titulo, $contenido, $estado);
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
    
     /*Este metodo crea una noticia a partir del RSS que genera el sitio web diicc, usando la libreria RSSParse, luego de leer el feed
    separa el contenido  texto  del feed de la imagen asociada. si la noticia trae una, se almacena solo el texto en el panel Lateral, tambien comprueba que
    se cumpla el maximo de caracteres permitido antes de crear la noticia en el panel lateral
    */
    public function crear_articulo_RSS()
    {
        //cargamos la libreria RSS y le pasamos la informacion del feed que queremos abrir    
        $this->load->library('RSSParser', array('url' =>'http://146.83.74.15/sitiodiicc/index.php/noticias-diicc?format=feed&type=rss','life' => 2));
        $articulo = array();
            
        //leemos el RSS Feed usand los metodos de la libreria RSSParser
        $rss_data = $this->rssparser->getFeed(6);

        //recorremos el contenido del feed y separamos el texto de la imagen del mismo, en el caso del Panel Lateral solo nos interesa el texto
        foreach ($rss_data as $row) {
            $content = "";
            $articulo['descripcion'] = $row['title'];
            $content = explode("<img", strip_tags($row['description'], "<img>")); //se separa el texto de la imagen del contenido del feed que se lee
            $articulo["contenido"] = $content[0]; // el texto de la noticia a crear a partir del procesamiento previo del feed
            $articulo["img"]= $content[1]; 
            $image_url = explode('src="',$articulo["img"]); // dentro de la etiqueta <img> separo el atributo 'src' de la url de la imagen
            $image_url = explode('" border',$image_url[1]); // separo el atributo border de la etiqueta <img> para aislar la url de la imagen
            $estado = ACTIVO; // seteamos el articulo como inactiva por motivos de testeo en el panel principal
            
             //echo '<p><b>Descripcion:</b> ' . $articulo['descripcion'] . ' <b>Contenido:</b> ' .$articulo['contenido'] . ' <b>URL IMG:</b> ' .$articulo['img']. ' <b>Caracteres</b> ' .strlen($articulo['contenido']);

            /*si el texto de la noticia del feed que se procesa supera el maximo de caracteres permitidos por el panel lateral
            se aplica una funcion para cortar el texto y ajustarlo al maximo permitido.*/
            if (!empty($articulo['contenido'])) {
                
                if (strlen($articulo['contenido']) > MAX_CHAR_PRINC) {
                    $articulo['contenido'] = character_limiter($articulo['contenido'], MAX_CHAR_PRINC);
                    
                } 
                else{               
                    //se verifica si ya existe esta noticia en el panel lateral basado en el contenido de la misma, es importante no modificar este atributo en el futuro
                    $existe = $this->Panel_principal_model->verificar_descripcion_articulo($articulo['descripcion']);
                    if ($existe['resultado'] == 0) {
                        
                        //este bloque guarda la imagen que trae la descripcion del la noticia del sfeed mediante su url, procesada anteriormente
                        $contents = file_get_contents($image_url[0]);                   // uso la url de la imagen previamente aislada para almacenar la imagen en server
                        $articulo_img = explode('images/',$image_url[0]);               //separo de la url de la imagen el nombre del archivo y su extension                     
                        $savefile = fopen('./recursos/images/'.$articulo_img[1], 'w'); // guardo en el servidor la imagen mediante su nombre de archivo extraido de su url
                        fwrite($savefile, $contents);
                        fclose($savefile);
                       
                        // si no existe la noticia se guarda en el panel principal, pero desactivada, bajo el titulo generido de Noticias DIICC 
                        $respuesta = $this->Panel_principal_model->crear_nuevo_articulo($articulo_img[1],$articulo["descripcion"], "Noticias DIICC",
                                                                                        $articulo["contenido"], $estado);
                                                                                        
                       // echo '<p><b>Descripcion:</b> ' . $articulo['descripcion'] . ' <b>Contenido:</b> ' .$articulo['contenido'] . ' <b>URL IMG:</b> ' .$image_url[0]. ' <b>Caracteres</b> ' .strlen($articulo['contenido']);
                           
                     } 
                      else {
                       //  echo '<p>este articulo ya existe : ' . $articulo["descripcion"] . ' <b>URL IMG:</b> ' .$image_url[0].'</p>';
                      }
                }
            }
            //echo '<p>salte directo aca</p>';
        } //fin foreach
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

    /*Metodo para la eliminacion permanente de un articulo del panel principal en base a su id
    */
    public function eliminar_articulo()
    {
        $array_id = $this->input->post('array_id');
        $respuesta = $this->Panel_principal_model->eliminar_articulo($array_id);
        $respuesta['text'] = "Articulo Eliminado Correctamente";
        echo json_encode($respuesta);
    }

    /*Metodo para la desactivacion manual de un articulo del panel principal en base a su id
    */
    public function cambiar_estado_articulo()
    {
        $array_id = $this->input->post('array_id');
        $estado = $this->input->post('estado');
        $datos = array('estado' => $estado);
        $respuesta = $this->Panel_principal_model->cambiar_estado_articulo($array_id, $datos);
        if ($estado == 'desactivado') {
            $respuesta['text'] = "<h3>Articulos Desactivados Correctamente</h3>";
        } else {

            $respuesta['text'] = "<h3>Articulos Reactivados Correctamente</h3>";
        }
        echo json_encode($respuesta);
    }

    /*******************************************************************************************************************************
    FIN SECCION DE GESTION DE CONTENIDO PARA EL  PANEL PRINCIPAL
    ******************************************************************************************************************************/


    public function videos()
    {

        if ($this->session->userdata('logged_in') != true) {
            redirect('login');
        }
        $config = array();
        $config["base_url"] = base_url() . "panel_principal/videos";
        $config["total_rows"] = $this->Home_model->record_count_videos('video');
        $config["per_page"] = ROWS_FOR_PAGES;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $principal['videos'] = $this->Home_model->filas_paginadas_videos('video', $config["per_page"],
            $page);
        $principal['links'] = $this->pagination->create_links();
        $titulo_panel = 'Panel Principal: Videos';
        $enlace_panel = 'panel_principal';

        $cabecera['links_cabecera'] = array(
            array('enlace' => "$enlace_panel/editar/activo", 'enlace_label' => "Articulos"),
            array('enlace' => "$enlace_panel/videos", 'enlace_label' => "Videos"),
            array('enlace' => "$enlace_panel/opciones", 'enlace_label' => "Opciones"),
            array('enlace' => "$enlace_panel/editar/desactivado", 'enlace_label' =>
                    "Historial"));
        $cabecera['datos_panel'] = array('titulo_panel' => $titulo_panel);

        $this->load->view('admin/contenido/cabecera_panel', $cabecera, true);
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
        $titulo_panel = 'Panel Principal: Opciones';
        $enlace_panel = 'panel_principal';

        $cabecera['links_cabecera'] = array(
            array('enlace' => "$enlace_panel/editar/activo", 'enlace_label' => "Articulos"),
            array('enlace' => "$enlace_panel/videos", 'enlace_label' => "Videos"),
            array('enlace' => "$enlace_panel/opciones", 'enlace_label' => "Opciones"),
            array('enlace' => "$enlace_panel/editar/desactivado", 'enlace_label' => "Historial")
                                        );
            
        $cabecera['datos_panel'] = array('titulo_panel' => $titulo_panel);

        $this->load->view('admin/contenido/cabecera_panel', $cabecera, true);
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
        $tiempo_mls = $tiempo * 60 * 1000;
        $datos = array('desplegar' => $opcion, 'tiempo' => $tiempo_mls);
        $respuesta = $this->Panel_principal_model->actualizar_opcion($id, $datos);
        if($opcion == TEXT_MODE){
            $respuesta['text'] = "<h3>Opcion 'Articulos' Configurada Correctamente</h3>";
        }
        else{
            $respuesta['text'] = "<h3>Opcion 'Videos' Configurada Correctamente</h3>";
        }
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

  
} // fin clase panel_principal


/* Location: ./application/controllers/panel_principal.php */
?>