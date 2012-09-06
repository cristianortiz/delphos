  <?php
       $this->load->view('admin/contenido/cabecera_panel_edicion');
        if(empty($avisos)){
            if($estado == ACTIVO){
	           echo '<h3>No hay Noticias Activas, para crear Noticias presione "Nueva Noticia"</h3>';
            }
            else{
                 echo '<h3>No hay Noticias Desactivadas en el Panel Lateral</h3>';
            }
         }
         else{ ?>
      
     <table id="tabla_avisos">
       <thead>
          <tr> 
             <th><input name="all" type="checkbox" value="1" class="check_todos"/></th>                                                     
             <th>Fecha</th>
              <th>Noticia</th> 
             <th>Acciones</th>
           </tr>
       </thead>
       <tbody>                
       <?php
        foreach($avisos as $row){
          echo '<tr id="fila'.$row['id'].'">                 
                   <td style="width:5%;" id="fcheck"><input class="enviar_documento" type="checkbox" name="" value="'.$row['id'].'" /></td>
                  <td style="width:10%;" id="f1"> '.strftime("%d-%m-%Y", strtotime($row['fecha'])) .'</td> 
                  <td style="width:80%;" id="f2"> '.word_limiter($row['contenido'],15) .'</td>                      
                  <td style="width:5%;" id="f3"><a href ='.$row['id'].' class="editar_lat"><img  src="'.base_url('recursos/images/edit.png').'"  /></a>
                                                
                </tr> ';           
        }
     }  ?>
       </tbody>
     </table> 
     <div class="page_numbers">
      <p><?php echo $links; ?></p>
     </div> 
     
     <!-- seccion de cuadros de dialogos, ocultos, desplegados por JQuery, para crear, editar y elminar un aviso
          desde la cinta de mensajes -->
          
      <!-- cuadros de dialogo para el boton  Eliminar, del panel lateral -->
     <div id="eliminar_dialog_princ" title="Eliminar Noticia">     
       <h3>¿Seguro desea eliminar las noticias seleccionadas?</h3>
       <input type="hidden" value="<? echo $input_panel;?>" id="input_panel" />
       <input type="hidden" value="<? echo $input_contenido;?>" id="input_contenido" />
       <input type="hidden" value="<? echo $estado;?>" id="input_estado" />            
     </div> 
     
      <!-- cuadros de dialogo para el boton  Desactivar, del panel lateral -->
     <div id="desactivar_dialog_princ" title="Desactivar Noticias">     
       <h3>¿Seguro desea Desactivar las Noticias seleccionados?</h3><br />
       <h4> Los Noticias desactivadas solo estaran visibles en la seccion Historial</h4>          
     </div> 
     
      <!-- cuadros de dialogo para el boton  Reactivar, del panel lateral, seccion Historial -->
     <div id="activar_dialog_princ" title="Reactivar Noticias">     
       <h3>¿Seguro desea Reactivar las Noticias seleccionadas?</h3><br />
       <h4> Las Noticias Reactivadas seran nuevamente visibles en el panel Lateral, seccion Noticias</h4>          
     </div> 
     
       <!-- cuadros de dialogo para el boton  Nueva Noticia, del panel lateral, -->     
      <div id="crearDialog_lat" style="width: 400px;" title="Crear Nueva Noticia">
        <form id="form-crear-lat">
            <h3>Contenido de la Noticia</h3><br />      
            <textarea class="area-texto" rows="4" name="contenido" id="contenido"></textarea>                      
         </form>
          <h4></h4>
      </div> 
      
      <!-- cuadros de dialogo para el enlace Editar Noticia, de la tabla de noticias del  panel lateral, -->   
     <div id="editarDialog_lat" style="width: 400px;" title="Editar Noticia">
       <form id="form-edicion-lat">
       <h3>Contenido del aviso</h3><br />      
       <textarea  class="area-texto" rows="4" name="contenido" id="contenido"></textarea>
       <input type="hidden" id="id" name="id" />
       <p></p>
       </form>
     </div> 
     
      <!-- cuadros de dialogos de confirmacion y finalizacion para cada una de las acciones anteriores -->   
     <div id="eliminar_dialog_ok">
         <p></p><br/> 
      </div>
       <div id="desactivar_dialog_ok">
         <p></p><br/> 
      </div>
       <div id="activar_dialog_ok">
         <p></p><br/> 
      </div>
    
     <div id="msgDialog_lat">
         <h4></h4><br/>
         <p></p> 
</div>                                                        
 </div>
 