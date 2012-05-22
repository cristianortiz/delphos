<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
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
        $this->load->view('footer/footer', $footer, true);

        $lateral['noticias'] = $this->Home_model->get_panel_lateral();
        $this->load->view('sidebar/sidebar', $lateral, true);

        $visualizar = $this->Home_model->get_visualizacion();

        if ($visualizar['desplegar'] == TEXT_MODE) {
            $principal['texto'] = $this->Home_model->get_panel_principal();
            $this->load->view('contenido/contenido_texto', $principal, true);
            $vista = 'contenido/contenido_texto';
           
           
        } else {
            
            $vista = 'contenido/contenido_videos';          
        }

        //se arma el array data[] con el contenido de cada seccion del panel para ser cargados en la vista template
        $data['header'] = 'header/header_main';
        $data['aside'] = 'sidebar/sidebar';
        $data['contenido'] = $vista;
        $data['footer'] = 'footer/footer';

        $this->load->view('template', $data); // CARGAMOS el template del sitio, con el contenido principal
    }

    public function editar_xml()
    {
        $archivo = fopen('recursos/videos/lista.xml', "w+");
        $encabezado = '<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" 
xmlns:jwplayer="http://developer.longtailvideo.com/trac/"> 
  <channel> 
    <title>MRSS Playlist Playlist</title> ';
        $escritor = fwrite($archivo, $encabezado);
        fclose($archivo);
        $archivo1 = fopen('recursos/videos/lista.xml', "a");
        $videos = $this->Panel_principal_model->get_videos();
        foreach ($videos as $row) {

            $item = '<item> 
                       <title>' . $row['nombre'] . '</title> 
                       <media:content url="' . base_url('recursos/' . $row['url']) .
                '/' . $row['nombre'] . '"/> 
                       <media:thumbnail url="' . base_url('recursos/images/preview.jpg') .
                '"/>
                       <description>' . $row['descripcion'] . '</description> 
                       <jwplayer:duration>03:00</jwplayer:duration> 
                    </item>';

            $escritor = fwrite($archivo1, $item);
        }
        //introduce final
        $final = '</channel> 
                 </rss>';
        $escritor = fwrite($archivo1, $final);
        fclose($archivo1);


    }

    public function carga_playlist()
    {
        $videos = $this->Panel_principal_model->get_videos();
        $inicio =  '[';
        $cuerpo = '';
        foreach($videos as $row){
            
            $cuerpo = $cuerpo. '{"0":{"src":"'.$row['url'].'","type":"'.$row['tipo'].'"},"config":{"title":"'.$row['descripcion'].'"}},';
            
            }
        $fin = ']';
        
        $lista = $inicio.$cuerpo.$fin;
        $lista = str_replace(",]", "]", $lista);
        
        echo  $lista;
            
        /*echo '[{"0":{"src":"http://uberelectron.s3.amazonaws.com/uberelectron1.mp4","type":"video/mp4"},"config":{"title":"Hello World."}},
             {"0":{"src":"http://www.youtube.com/watch?v=wXE2pn_s818","type":"video/youtube"},"config":{"title":"Farbrausch"}},
             {"0":{"src":"http://localhost/delphos/recursos/videos/sintel.mp4","type":"video/mp4"},"config":{"title":"Vide0 de Sintel"}}]';*/
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */
?>