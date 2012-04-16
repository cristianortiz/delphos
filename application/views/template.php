<?php
   include("application/third_party/mediafront/OSMPlayer.php");
   $player = new OSMPlayer( array(
    'playlist' => 'application/third_party/mediafront/playlist.xml'
   ));
?>
<!DOCTYPE html>
<html>
    <head manifest="/manifiesto/manifiesto.cache">
        <title>Panel Informativo DELPHOS</title>
        <!-- esta etiqueta refresca automaticamente la pagina cada 5 segundos -->
	      <meta http-equiv="refresh" content="5000" />
          <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="keywords" content="weblog, html5, ejemplo, tutorial html5" />
        <link href="recursos/css/estilo.css" rel="stylesheet" type="text/css" />
        <link href="recursos/css/content-rotator.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="recursos/js/carouFredSel-5.4.1/jquery.js"></script>
	    <script type="text/javascript" src="recursos/js/carouFredSel-5.4.1/jquery.carouFredSel-5.4.1-packed.js"></script>
        <script type="text/javascript" src="recursos/js/script.js"></script>
        <script type="text/javascript" src="recursos/js/jquery.easing.1.3.js"></script>   
         <?php print $player->getHeader(); ?>     
    </head>
    <body>
        <div id="cajaheader">
        </div>
        <div id="principal">
        <div id="contenido">
          <header>           
             <?php 
                /* vista header dela vista de admnistracion */
                $this->load->view($header);
             ?>      
          </header>
               <aside id="menu-editable">
                 
                    <?php 
                        /* vista aside (menu_lateral) de la vista de administracion */
                        $this->load->view($aside);
                    ?>
                       
                </aside>
            <section>
            <article>
                   <?php 
                        /* vista contenido_principal de la vista de administracion */
                        if($opcion =='texto')
                        {                           
                             $this->load->view($contenido);
                        } 
                        else{    
                        print $player->getPlayer();
                        }
                         ?>
                        
               </article>                                     
             </section>                                                
           </div>  
           </div>       
           <footer>
               <?php 
                /* vista footer de la vista de administracion */
                $this->load->view($footer);
              ?>  
           </footer>                                     
    </body>
</html>