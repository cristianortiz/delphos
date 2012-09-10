  <?php
       $this->load->view('admin/contenido/cabecera_panel_edicion');
        if(empty($avisos)){
            if($estado == ACTIVO){
	           echo '<h3>No hay Avisos Activos, para crearlos  presione "Nuevo Aviso"</h3>';
            }
            else{
                 echo '<h3>No hay Avisos Desactivados en el Panel Inferior</h3>';
            }
         }
         else{ ?>
 
     <table id="tabla_avisos">
       <thead>
          <tr>
             <th><input name="all" type="checkbox" value="1" class="check_todos"/></th>                                                      
             <th>Fecha</th>
              <th>Aviso</th> 
             <th>Acciones</th>
           </tr>
       </thead>
       <tbody>                
       <?
        foreach($avisos as $row){
          echo '<tr id="fila'.$row['id'].'">
                  <td style="width:10%;" id="fcheck"><input class="enviar_documento" type="checkbox" name="" value="'.$row['id'].'" /></td>                 
                  <td style="width:10%;" id="f1"> '.strftime("%d-%m-%Y", strtotime($row['fecha'])) .'</td> 
                  <td id="f2"> '.word_limiter($row['contenido'],8) .'</td>                      
                  <td style="width:10%;" id="f3"><a href ='.$row['id'].' class="editar_pi"><img  src="'.base_url('recursos/images/edit.png').'"  /></a>
                   </td>
                </tr> ';           
        }
     }  ?>
       </tbody>
     </table>
     <div class="page_numbers"><p><?php echo $links; ?></p>
     </div> 
             
      <!-- seccion de cuadros de dialogos, ocultos, desplegados por JQuery, para crear, editar y elminar un aviso
          desde la cinta de mensajes -->
          
      <!-- cuadros de dialogo para el boton  Eliminar, del panel Inferior -->
     <div id="eliminar_dialog_princ" title="Eliminar Aviso">     
       <h3>¿Seguro desea eliminar los avisos seleccionados?</h3>
       <input type="hidden" value="<? echo $input_panel;?>" id="input_panel" />
       <input type="hidden" value="<? echo $input_contenido;?>" id="input_contenido" />
       <input type="hidden" value="<? echo $estado;?>" id="input_estado" />             
     </div> 
     
      <!-- cuadros de dialogo para el boton  Desactivar, del panel Inferior -->
     <div id="desactivar_dialog_princ" title="Desactivar Avisos">     
       <h3>¿Seguro desea Desactivar los Avisos seleccionados?</h3><br />
       <h4> Los Avisos desactivados solo estaran visibles en la seccion Historial</h4>          
     </div> 
     
      <!-- cuadros de dialogo para el boton  Reactivar, del panel lateral, seccion Historial -->
     <div id="activar_dialog_princ" title="Reactivar Avisos">     
       <h3>¿Seguro desea Reactivar los Avisos seleccionados?</h3><br />
       <h4> Los Avisos Reactivadas seran nuevamente visibles en el panel Inferior, seccion Avisos</h4>          
     </div>     
      <div id="crearDialog-pi"  style="width: 400px;" title="Crear Nuevo Aviso">
        <form id="form-crear-pi">
            <h3>Contenido del aviso</h3><br />      
            <textarea class="area-texto" rows="4"  name="contenido" id="contenido"></textarea>     
         </form>
         <p></p>
      </div> 
     
     <div id="editarDialog-pi" style="width: 400px;" title="Editar Aviso">
       <form id="form-edicion-pi">
       <h3>Contenido del aviso</h3><br />      
       <textarea  class="area-texto" rows="4"  name="contenido" id="contenido"></textarea>
       <input type="hidden" id="id" name="id" />
       <p></p>
       </form>
     </div> 
      
     <!-- cuadros de dialogos de confirmacion y finalizacion para cada una de las acciones anteriores -->   
     <div id="eliminar_dialog_ok">
         <h4></h4><br/> 
      </div>
       <div id="desactivar_dialog_ok">
         <p></p><br/> 
      </div>
       <div id="activar_dialog_ok">
         <p></p><br/> 
      </div>
     <div id="msgDialog_pi">
         <p></p><br/> 
</div>                                                        
 </div>

