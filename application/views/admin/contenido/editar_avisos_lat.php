
 <div id="edicion_panel">
 <h4>Bienvenido <?php echo strtoupper($this->session->userdata('username'));?> <a id="session_panel" href="<? echo base_url('login/cerrar_sesion');?>">Cerrar Sesion</a></h4>
 <h2>Panel Lateral: Editar Noticias</h2>
 <h3>Agregar Noticias <a id="crear_aviso"  class="crear_noticia_lat" href="#">Nueva Noticia</a></h3>
 <h3>Lista de Noticias</h3>
     <table id="tabla_avisos">
       <thead>
          <tr>                                                     
             <th>Fecha</th>
              <th>Noticia</th> 
             <th>Acciones</th>
           </tr>
       </thead>
       <tbody>                
       <?
        foreach($avisos as $row){
          echo '<tr id="fila'.$row['id'].'">                 
                  <td id="f1"> '.strftime("%d-%m-%Y", strtotime($row['fecha'])) .'</td> 
                  <td id="f2"> '.word_limiter($row['contenido'],5) .'</td>                      
                  <td id="f3"><a href ='.$row['id'].' class="editar_lat">Editar</a> | <a href="'.$row['id'].'" class="eliminar_lat">Borrar</a></td>
                </tr> ';           
        }?>
       </tbody>
     </table> 
     <div class="page_numbers">
      <p><?php echo $links; ?></p>
     </div> 
     
     <!-- seccion de cuadros de dialogos, ocultos, desplegados por JQuery, para crear, editar y elminar un aviso
          desde la cinta de mensajes -->
      <div id="crearDialog_lat" title="Crear Nueva Noticia">
        <form id="form-crear-lat">
            <h3>Contenido de la Noticia</h3><br />      
            <textarea  name="contenido" id="contenido"></textarea>                
         </form>
          <p></p>
      </div> 
     
     <div id="editarDialog_lat" title="Editar Noticia">
       <form id="form-edicion-lat">
       <h3>Contenido del aviso</h3><br />
       
       <textarea  name="contenido" id="contenido"></textarea>
       <input type="hidden" id="id" name="id" />
       <p></p>
       </form>
     </div> 
     
     <div id="eliminarDialog_lat" title="Eliminar Noticia">
       <form id="form-eliminar-lat">
       <h3>¿Seguro desea eliminar esta noticia?</h3><br />
       
       <textarea readonly="readonly" name="contenido" id="contenido"></textarea>
       <input type="hidden" id="id" name="id" />
       <p></p>
       </form>
     </div> 
     <div id="msgDialog_lat">
         <p></p><br/> 
</div>                                                        
 </div>

