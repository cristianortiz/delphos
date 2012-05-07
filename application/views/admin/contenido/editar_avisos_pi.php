 <div id="edicion_panel">
  <h4>Bienvenido <?php echo strtoupper($this->session->userdata('username'));?> <a id="session_panel" href="<? echo base_url('login/cerrar_sesion');?>">Cerrar Sesion</a></h4>
  
 <h2>Panel Inferior: Editar Cinta de Avisos</h2>
 <h3>Agregar Nuevos Mensajes <a id="crear_aviso" class="crear_aviso_pi" href="#">Nuevo Aviso</a></h3>
 <h3>Mensajes de la Cinta de Avisos</h3>
 
     <table id="tabla_avisos">
       <thead>
          <tr>                                                     
             <th>Fecha</th>
              <th>Aviso</th> 
             <th>Acciones</th>
           </tr>
       </thead>
       <tbody>                
       <?
        foreach($avisos as $row){
          echo '<tr id="fila'.$row['id'].'">                 
                  <td id="f1"> '.strftime("%d-%m-%Y", strtotime($row['fecha'])) .'</td> 
                  <td id="f2"> '.word_limiter($row['contenido'],5) .'</td>                      
                  <td id="f3"><a href ='.$row['id'].' class="editar_pi">Editar</a> | <a href="'.$row['id'].'" class="eliminar_pi">Borrar</a></td>
                </tr> ';           
        }?>
       </tbody>
     </table>
     <div class="page_numbers"><p><?php echo $links; ?></p></div>
     
   
     
     <!-- seccion de cuadros de dialogos, ocultos, desplegados por JQuery, para crear, editar y elminar un aviso
          desde la cinta de mensajes -->
      <div id="crearDialog-pi" title="Crear Nuevo Aviso">
        <form id="form-crear-pi">
            <h3>Contenido del aviso</h3><br />      
            <textarea  name="contenido" id="contenido"></textarea>     
         </form>
         <p></p>
      </div> 
     
     <div id="editarDialog-pi" title="Editar Aviso">
       <form id="form-edicion-pi">
       <h3>Contenido del aviso</h3><br />
       
       <textarea  name="contenido" id="contenido"></textarea>
       <input type="hidden" id="id" name="id" />
       <p></p>
       </form>
     </div> 
     
     <div id="eliminarDialog-pi" title="Eliminar Aviso">
       <form id="form-eliminar-pi">
       <h3>¿Seguro desea eliminar el sgte. mensaje?</h3><br />
       
       <textarea readonly="readonly" name="contenido" id="contenido"></textarea>
       <input type="hidden" id="id" name="id" />
       <p></p>
       </form>
     </div> 
     <div id="msgDialog_pi">
         <p></p><br/> 
</div>                                                        
 </div>

