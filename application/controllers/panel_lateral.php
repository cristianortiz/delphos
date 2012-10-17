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
    /* Metodo que recupera los avisos del panel lateral y los despliega en formato tabla en la seccion de administracion para ser editados
    */
    public function editar($estado)
    {
        if ($this->session->userdata('logged_in') != true) {
            redirect('login');
        }

        //seccion de configuracion del sistema de paginacion de resultados
        $config = array();
        if ($estado == ACTIVO) {
            $config["base_url"] = base_url() . "panel_lateral/editar/activo";
        } else {
            $config["base_url"] = base_url() . "panel_lateral/editar/desactivado";
        }
        $config["total_rows"] = $this->Home_model->record_count('lateral', $estado);
        $config["per_page"] = ROWS_FOR_PAGES;
        $config["uri_segment"] = 4;

        //inicializazion del sistema de paginacion de resultados
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        //configuracion de los datos a desplegar en la vista de edicicion del panel lateral
        $lateral["avisos"] = $this->Home_model->filas_paginadas('lateral', $config["per_page"],$page, $estado); //recuperar noticias segun estado y cantidad de resultador visibles por pagina
        $lateral["links"] = $this->pagination->create_links(); //creacion de links de paginacion pagina 1,2,3 etc
        $lateral['estado'] = $estado;
        $lateral['input_panel'] = 'panel_lateral';
        $lateral['input_contenido'] = 'noticia';

        $enlace_panel = $lateral['input_panel'];
        $btn_nuevo = 'nueva_noticia';
        $label_nuevo = 'Nueva Noticia ';

        if ($estado == ACTIVO) {
            $titulo_panel = 'Panel Lateral: Noticias Activas';
            $btn_estado = 'btn_desactivar';
            $label_estado = 'Desactivar';
        } else {
            $titulo_panel = 'Panel Lateral: Historial Noticias Desactivadas';
            $btn_estado = 'btn_activar';
            $label_estado = 'Activar';

        }

        //configuracion de la barra de menu superior de la vista de edicion con los enlaces de cada menu, y los botones de accion,
        $cabecera['links_cabecera'] = array(
            array('enlace' => "$enlace_panel/editar/activo", 'enlace_label' => "Noticias"),
            array('enlace' => "$enlace_panel/opciones_lateral", 'enlace_label' => "Opciones"),
            array('enlace' => "$enlace_panel/editar/desactivado", 'enlace_label' =>"Historial")
            );
            
        //creacion de los botones de accion Nuevo, Desactivar/Activar, y sus etiquetas
        $cabecera['datos_panel'] = array(
            'titulo_panel' => $titulo_panel,
            'estado' => $estado,
            'btn_estado' => $btn_estado,
            'label_estado' => $label_estado,
            'btn_nuevo' => $btn_nuevo,
            'label_nuevo' => $label_nuevo);
            
        //carga de los datos anteriores en la vista cabecera
        $this->load->view('admin/contenido/cabecera_panel_edicion', $cabecera, true);

        //carga de la vista anterior y de las tablas de edicion con las noticias en la vista de edicion del panel lateral
        $this->load->view('admin/contenido/editar_avisos_lat', $lateral, true); 
        
        //carga de de los componentes del template general del sitio para "enmarcar"" las vistas cargadas anteriormente
        $data['header'] = 'admin/header/header_main';
        $data['aside'] = 'admin/sidebar/menu_lateral';
        $data['contenido'] = 'admin/contenido/editar_avisos_lat';
        $data['footer'] = 'admin/footer/footer_admin';
        
        //carga de la vista completa con todos los contenidos en el template general
        $this->load->view('admin/template_manager', $data);
    }
    
    /*Metodo que cambia el estado de una noticia entre ACTIVO y DESACTIVADO */
    public function cambiar_estado_noticia()
    {
        $array_id = $this->input->post('array_id');
        $estado = $this->input->post('estado');
        $datos = array('estado' => $estado);
        $respuesta = $this->Panel_lateral_model->cambiar_estado_noticia($array_id, $datos);
        if ($estado == 'desactivado') {
            $respuesta['text'] = "<h3>Noticias Desactivadas Correctamente</h3>";
        } else {

            $respuesta['text'] = "<h3> Noticias Reactivadoa Correctamente</h3>";
        }
        echo json_encode($respuesta);
    }
    /*******************************************************************************************************************************
    SECCION DE GESTION DE CONTENIDO PARA LAS NOTICIAS DEL PANEL LATERAL, RECUPERACION, EDICION, CREACION y ELIMINACION
    DE NOTICIAS
    *********************************************************************************************************************************/

    /* este metodo recupera los datos de una noticia en particular por su id, y los carga en el form de edicion correspondiente via JSON que luego sera
    mostrado en el cuadro de dialogo para las operaciones edicion o eliminacion
    */
    public function consultar_noticia_lat($id)
    {
        $respuesta = $this->Panel_lateral_model->get_aviso($id);
        echo json_encode($respuesta);      
    }

    /*Metodo que crea una nueva noticia en el panel lateral, recibe los datos via JSON desde el cuadro de dialogo emergente que aparece 
      al presionarl el boton  Nueva Noticia en la vista de edicion del panel lateral, 
    */
    public function crear_noticia_lat()
    {
        $contenido = $this->input->post('contenido');
        $estado = ACTIVO;

        if (!empty($contenido)) {
            if (strlen($contenido) < MAX_CHAR_LAT) {
                $respuesta = $this->Panel_lateral_model->crear_noticia($contenido, $estado);
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

    /*Este metodo crea una noticia a partir del RSS que genera el sitio web diicc, usando la libreria RSSParse, luego de leer el feed
    separa el contenido  texto  del feed de la imagen asociada. si la noticia trae una, se almacena solo el texto en el panel Lateral, tambien comprueba que
    se cumpla el maximo de caracteres permitido antes de crear la noticia en el panel lateral
    */
    public function crear_noticia_RSS()
    {
        //cargamos la libreria RSS y le pasamos la informacion del feed que queremos abrir    
        $this->load->library('RSSParser', array('url' =>'http://146.83.74.15/sitiodiicc/index.php/noticias-diicc?format=feed&type=rss','life' => 2));    
        //leemos el RSS Feed usand los metodos de la libreria RSSParser
        $rss_data = $this->rssparser->getFeed(6);

        //recorremos el contenido del feed y separamos el texto de la imagen del mismo, en el caso del Panel Lateral solo nos interesa el texto
        foreach ($rss_data as $row) {
            $content = "";
            $content = explode("<img", strip_tags($row['description'], "<img>")); //se separa el texto de la imagen del contenido del feed que se lee
            $contenido = $content[0]; // el texto de la noticia a crear a partir del procesamiento previo del feed
            $estado = ACTIVO; // seteamos la noticia como activa para que se muestre en el panel lateral

            /*si el texto de la noticia del feed que se procesa supera el maximo de caracteres permitidos por el panel lateral
            se aplica una funcion para cortar el texto y ajustarlo al maximo permitido.*/
            if (!empty($contenido)) {
                if (strlen($contenido) < MAX_CHAR_LAT) {
                    $respuesta = $this->Panel_lateral_model->crear_noticia($contenido, $estado);
                    echo '<p>contenido completo : ' . $contenido . '</p>';
                } else {
                    $contenido_reducido = character_limiter($contenido, 150);

                    //se verifica si ya existe esta noticia en el panel lateral basado en el contenido de la misma, es importante no modificar este atributo en el futuro
                    $existe_noticia = $this->Panel_lateral_model->verificar_noticia($contenido_reducido);
                    if ($existe_noticia['resultado'] == 0) {

                        // si no existe la noticia se guarda en el panel lateral, activada y lista para desplegar en el panel
                        $respuesta = $this->Panel_lateral_model->crear_noticia($contenido_reducido, $estado);
                        echo '<p>contenido reducido : ' . $contenido_reducido . ' Numero caracteres: ' .
                            strlen($contenido) . '</p>';
                    } else {
                        echo '<p>este contenido ya existe : ' . $contenido_reducido . ' </p>';
                    }
                }
            }
        } //fin foreach
    }

    /* Metodo para editar una noticia existente, recibe los datos via Json desde el cuadro ed dialogo con el form de edicion en la vista edicion del
       Panel Lateral y efectua la edicion de la noticia previo filtro de los datos
    */
    public function editar_noticia_lat()
    {
         //recibimos los datos de la noticia via POST desde el form de edicion en la vista   
        $id = $this->input->post('id');
        $contenido = $this->input->post('contenido');
        $datos = array('contenido' => $contenido, ); //se arma un array con los datos para editar la noticia
        
        //si el contenido no esta vacio y no supera e maximo de carac. permitidos en el panel lateral por noticia, se realiza la edicion
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

    /*Metodo para la eliminacion de una noticia del panel lateral en base a su id */
    public function eliminar_noticia()
    {
         //recibimos los datos de la noticia via POST desde el form de eliminacion en la vista       
        $array_id = $this->input->post('array_id');
        $respuesta = $this->Panel_lateral_model->eliminar_noticia($array_id);
        $respuesta['text'] = "<b>Noticia Eliminada Correctamente<b>";
        echo json_encode($respuesta);
    }

    /*Metodo para desplegar la vista de Opciones dentro de la vista de edicion del panel lateral, aparece al apretar en enlace
        Opciones desde la barra de menu de la vista de edicion del panel lateral
    */
    public function opciones_lateral()
    {
        //configuramos datos de la vista a mostrar
        $titulo_panel = 'Panel Lateral: Opciones';
        $enlace_panel = 'panel_lateral';
        
        
        //configuramos datos de la vista cabecera con los enlaces de la barra de menu
        $cabecera['links_cabecera'] = array(
            array('enlace' => "$enlace_panel/editar/activo", 'enlace_label' => "Noticias"),
            array('enlace' => "$enlace_panel/opciones_lateral", 'enlace_label' => "Opciones"),
            array('enlace' => "$enlace_panel/editar/desactivado", 'enlace_label' =>"Historial"));

        $cabecera['datos_panel'] = array('titulo_panel' => $titulo_panel);

        //cargamos los datos en la vista de cabecera     
        $this->load->view('admin/contenido/cabecera_panel', $cabecera, true);
        
        //obtenemos el tipo de visualizacion texto o video, este dato se usa en las opciones de configuracion que ofrece esta vista
        $visualizar['opcion'] = $this->Home_model->get_visualizacion();
        
        // cargamos la vista cabecera y los datos anteriores en la vista de opciones del panel de edicion lateral.
        $this->load->view('admin/contenido/opciones_panel_lateral', $visualizar, true); 
        
         //carga de de los componentes del template general del sitio para "enmarcar"" las vistas cargadas anteriormente
        $data['header'] = 'admin/header/header_main';
        $data['aside'] = 'admin/sidebar/menu_lateral';
        $data['contenido'] = 'admin/contenido/opciones_panel_lateral';
        $data['footer'] = 'admin/footer/footer_admin';
        
        //carga de la vista completa con todos los contenidos anteriormente configuradios en el template general
        $this->load->view('admin/template_manager', $data);
    }

    public function num_noticias_lateral()
    {
        $respuesta = $this->Home_model->get_visualizacion();
        echo json_encode($respuesta);
    }

 /*Metodo que configura parametros de visualizacion para las noticias del panel lateral como el numero de caracteres por noticia,
    es llamado desde la vista Opciones del panen lateral
 */
    public function configurar_noticias()
    {
        $id = $this->input->post('id');
        $num_noticias_lat = $this->input->post('num_noticias_lat');
        $max_caracteres_lat = $this->input->post('max_caracteres_lat');

        $datos = array('num_noticias_lat' => $num_noticias_lat, 'max_caracteres_lat' =>$max_caracteres_lat);

        $respuesta = $this->Panel_lateral_model->configurar_noticias($id, $datos);
        $respuesta['text'] = "Configuracion Exitosa";
        echo json_encode($respuesta);
    }

    /*******************************************************************************************************************************
    FIN SECCION DE GESTION DE CONTENIDO PARA EL  PANEL LATERAL DE NOTICIAS
    ******************************************************************************************************************************/

} // fin clase panel_lateral

/* End of file welcome.php */
/* Location: ./application/controllers/panel_lateral.php */
