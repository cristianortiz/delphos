<!DOCTYPE html>
<html>
    <head manifest="/manifiesto/manifiesto.cache">
        <title>Panel Informativo DELPHOS</title>
        <!-- esta etiqueta refresca automaticamente la pagina cada 5 segundos -->
	      <meta http-equiv="refresh" content="5000" />
          <meta http-equiv="Content-Type" content="text/html; charset=Latin1" />
        <meta name="keywords" content="weblog, html5, ejemplo, tutorial html5" />
        <link href="recursos/css/estilo-admin.css" rel="stylesheet" type="text/css" />
        <link href="recursos/css/content-rotator.css" rel="stylesheet" type="text/css" />
       
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