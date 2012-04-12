<!DOCTYPE html>
<html>
    <head manifest="/manifiesto/manifiesto.cache">
        <title>Panel Informativo DELPHOS</title>
        <!-- esta etiqueta refresca automaticamente la pagina cada 5 segundos -->
	      <meta http-equiv="refresh" content="5000" />
          <meta http-equiv="Content-Type" content="text/html; charset=Latin1" />
        <meta name="keywords" content="weblog, html5, ejemplo, tutorial html5" />
        <link href="<?echo base_url('recursos/css/estilo-admin.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?echo base_url('recursos/css/smoothness/jquery-ui-1.8.2.custom.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?echo base_url('recursos/css/content-rotator.css');?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?echo base_url('recursos/js/jquery-1.4.2.min.js');?>"></script>   
        <script type="text/javascript" src="<?echo base_url('recursos/js/jquery-ui-1.8.6.custom.min.js');?>"></script>
        <script type="text/javascript" src="<?echo base_url('recursos/js/AjaxUploader/ajaxfileupload.js');?>"></script>
         <script type="text/javascript" src="<?echo base_url('recursos/js/jquery.validate.min.js');?>"></script>   
        <script type="text/javascript" src="<?echo base_url('recursos/js/delphos_admin.js');?>"></script>
        
        
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
           
           <?php
              if(!empty($aside))
              {
                 echo '<aside>';                   
                      /* vista aside (menu_lateral) de la vista de administracion */
                      $this->load->view($aside);
                 echo '</aside>';
               }
            ?>          
              
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