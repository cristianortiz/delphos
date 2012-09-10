       <?
       $this->load->view('admin/contenido/cabecera_panel_edicion');
        if(empty($texto)){
            if($estado == ACTIVO){
	           echo '<h3>No hay Articulos Activos, para crear Articulos presione "Nuevo Articulo"</h3>';
            }
            else{
                 echo '<h3>No hay Articulos Desactivados en el Panel Principal</h3>';
            }
         }
         else{ ?>
      
     <table id="tabla_avisos">
       <thead>
          <tr>
             <th><input name="all" type="checkbox" value="1" class="check_todos"/></th>  
             <th>Fecha</th>                                                     
             <th>Titulo</th>
              <th>Descripcion</th> 
              <th>Contenido</th>            
             <th>Acciones</th>
           </tr>
       </thead>
       <tbody>                   
       <?
     
        foreach($texto as $row){
          echo '<tr id="fila'.$row['id'].'">
                  <td id="fcheck"><input class="enviar_documento" type="checkbox" name="" value="'.$row['id'].'" /></td>
                  <td id="f0"> '.strftime("%d-%m-%Y", strtotime($row['fecha'])) .'</td>                  
                  <td id="f1"> '.$row['titulo'] .'</td> 
                  <td id="f2"> '.$row['descripcion'] .'</td>
                  <td id="f3"> '.word_limiter(str_replace('<h2>',"",$row['contenido']),5) .'</td>
                  
                                
                  <td id="f4"><a href ='.$row['id'].' class="editar_princ"><img  src="'.base_url('recursos/images/edit.png').'"  /></a>';
                      if(!empty($row['imagen'])){
                        
                        echo '<a href ='.$row['id'].' class="borrar_imagen"><img  src="'.base_url('recursos/images/picture_delete.png').'"  /></a>' ;   
                       }
                       else{
                           echo '<a href ='.$row['id'].' class="subir_imagen"><img  src="'.base_url('recursos/images/upload_file.png').'"  /></a>
                           
                           </td>               
                 </tr>';
                       } 
                                                     
          }
        }?>
       </tbody>
     </table>
   	<div class="page_numbers"><p><?php echo $links; ?></p></div>
     
     <!-- seccion de cuadros de dialogos, ocultos, desplegados por JQuery, para crear, editar y eliminar contenido -->
     
          
     <!-- cuadros de dialogo para el boton  Nuevo Articulo, del panel principal -->
     <div id="nuevo_articulo_dialog"  style="width: 500px;" title="Nuevo Articulo">
       <form id="form_nuevo_articulo">
       <table border="0">
        <tr>
          <td>Titulo</td>
          <td><input type="text" id="titulo" size="15" name="titulo" value=""/></td>
        </tr>
        <tr>         
          <td>Descripcion</td>
          <td><input type="text" id="desc" size="15" name="desc" value="" /></td>
        </tr>
        </table>    
        <label for="contenido">Contenido</label>    
            <textarea  class="area-texto" rows="2" cols="20"name="contenido" id="contenido"></textarea><br />
            <label for="userfile">Imagen</label>
			<input type="file" name="articulo_img" id="articulo_img" size="20" />     
       
       <p></p>
       </form>
     </div> 
     
       <!-- cuadros de dialogo para el boton  Eliminar, del panel principal -->
     <div id="eliminar_dialog_princ" title="Eliminar Articulo">     
       <h3>¿Seguro desea eliminar los articulos seleccionados?</h3>
       <input type="hidden" value="<? echo $input_panel;?>" id="input_panel" />
       <input type="hidden" value="<? echo $input_contenido;?>" id="input_contenido" />
       <input type="hidden" value="<? echo $estado;?>" id="input_estado" />             
     </div> 
     
      <!-- cuadros de dialogo para el boton  Desactivar, del panel principal -->
     <div id="desactivar_dialog_princ" title="Desactivar Articulos">     
       <h3>¿Seguro desea Desactivar los Articulos seleccionados?</h3><br />
       <h4> Los Articulos desactivados solo estaran visibles en la seccion Historial</h4>          
     </div> 
     
      <!-- cuadros de dialogo para el boton  Reactivar, del panel principal, seccion Historial -->
     <div id="activar_dialog_princ" title="Reactivar Articulos">     
       <h3>¿Seguro desea Reactivar r los Articulos seleccionados?</h3><br />
       <h4> Los Articulos Reactivados seran nuevamente visibles en el panel Principal, seccion articulos</h4>          
     </div> 
      <!-- cuadros de dialogo para el en lace de Editar Articulo, en la tabla de articulos del panel principal -->
     <div id="editarPrincipal"  style="width: 500px;" title="Editar Principal">
       <form id="form-edicion-princ">
       <table border="0">
        <tr>
          <td>Titulo</td>
          <td><input type="text" id="titulo" size="30" name="titulo" value=""/></td>
        </tr>
        <tr>         
          <td>Descripcion</td>
          <td><input type="text" id="desc" size="30" name="desc" value="" /></td>
        </tr>
        </table>    
        <label for="contenido">Contenido</label>    
            <textarea  class="area-texto" rows="5" name="contenido" id="contenido"></textarea>     
        <input type="hidden" id="id" name="id" value=""/>
                          
       <p></p>
       </form>
     </div> 
                 
       <!-- cuadro de dialogo para el enlace Adjuntar Imagen, en la tabla de articulos del panel principal -->
      <div id="subir_img_dialog" title="Adjuntar Imagen">
      <form method="post" action="" class="form_subir_img" id="form_subir_img">		
			<h4>Seleccione la imagen a adjuntar</h4>
			<input type="file" name="userfile" id="userfile" size="20" />
            <input type="hidden" id="id" name="id" value=""/>		  
		</form>        
     </div>
     
     <!-- cuadro de dialogo para el enlace Eliminar Imagen, en la tabla de articulos del panel principal -->
      <div id="borrar_img_dialog" title="Eliminar Imagen">
        <form id="form_borrar_imagen">
           <h3>¿Seguro desea eliminar este archivo de imagen?</h3><br />    
           <input type="hidden" id="id" name="id" />
           <input type="hidden" id="nombre_imagen" name="nombre_imagen" />      
          <h4></h4>
       </form>
     </div> 
  
    <!-- cuadros de dialogos de confirmacion y finalizacion para cada una de las acciones anteriores -->   
      <div id="imagen_ok_dialog">
         <h4></h4>
      </div>
       <div id="articulo_ok_dialog">
         <h4></h4>
      </div>  
        
      <div id="eliminar_dialog_ok">
         <p></p><br/> 
      </div>
       <div id="desactivar_dialog_ok">
         <p></p><br/> 
      </div>
       <div id="activar_dialog_ok">
         <p></p><br/> 
      </div>
          
     <div id="msgDialog">
         <p></p><br/> 
     </div>                                                        
