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
        <link rel="stylesheet" href="<? echo base_url('recursos/css/theme/style.css');?>" type="text/css" media="screen" />
        <script type="text/javascript" src="<? echo base_url('recursos/js/jquery-1.7.1.min.js');?>"></script>
	    <script type="text/javascript" src="recursos/js/carouFredSel-5.4.1/jquery.carouFredSel-5.4.1-packed.js"></script>
         <script type="text/javascript" src="<? echo base_url('recursos/js/projekktor-1.0.13r41.min.js');?>"></script> 
         <script type="text/javascript" src="recursos/js/jquery.easing.1.3.js"></script>       
        <script type="text/javascript" src="recursos/js/script.js"></script>
        
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
                       $this->load->view($contenido);                      
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