<div id="edicion_panel">  
 <nav>
    <ul>
		<li><a href="<?echo base_url('panel_principal/editar');?>">Articulos</a></li>
		<li><a href="<?echo base_url('panel_principal/videos');?>">Videos</a></li>
		<li><a href="<?echo base_url('panel_principal/opciones');?>">Opciones</a></li>		
	</ul>
  </nav>
  <h4>Bienvenido <?php echo strtoupper($this->session->userdata('username'));?> <a id="session_panel" href="<? echo base_url('login/cerrar_sesion');?>">Cerrar Sesion</a></h4>
  <h2> Panel Principal: Articulos </h2>
  <h3>Crear Nuevo Articulo <a class="nuevo_articulo" href="#">Nuevo Articulo</a></h3>
  
 <h3>Lista de Articulos del Panel Principal</h3>
     <table id="tabla_avisos">
       <thead>
          <tr> 
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
                  <td id="f0"> '.$row['fecha'] .'</td>                  
                  <td id="f1"> '.$row['titulo'] .'</td> 
                  <td id="f2"> '.$row['descripcion'] .'</td>
                  <td id="f3"> '.word_limiter(str_replace('<h2>',"",$row['contenido']),5) .'</td>
                                
                  <td id="f4"><a href ='.$row['id'].' class="editar_princ"><img  src="'.base_url('recursos/images/edit.png').'"  /></a>';
                      if(!empty($row['imagen'])){
                        
                        echo '<a href ='.$row['id'].' class="borrar_imagen"><img  src="'.base_url('recursos/images/picture_delete.png').'"  /></a>' ;   
                       }
                       else{
                           echo '<a href ='.$row['id'].' class="subir_imagen"><img  src="'.base_url('recursos/images/upload_file.png').'"  /></a>';
                       } 
                                             
                       echo' <a href="'.$row['id'].'" class="eliminar_princ"><img  src="'.base_url('recursos/images/trash_full.png').'"  /></a></td>
                </tr> ';           
        }?>
       </tbody>
     </table> 
     
     <!-- seccion de cuadros de dialogos, ocultos, desplegados por JQuery, para crear, editar y elminar un aviso
          desde la cinta de mensajes 
      <div id="crearDialog_princ" title="Crear Nuevo Articulo">
        <form id="form-crear-princ">
            <h3>Crear el Articulo</h3><br /> 
                 
            <textarea  name="contenido" id="contenido"></textarea>     
            <p></p>
         </form>
      </div> 
     -->
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
        
     <div id="eliminar_dialog_princ" title="Eliminar Articulo">
       <form id="form-eliminar-princ">
       <h3>¿Seguro desea eliminar este articulo?</h3><br />       
       <textarea readonly="readonly" name="contenido" id="contenido"></textarea>
       <input type="hidden" id="id" name="id" />
       <p></p>
       </form>
     </div> 
     
      <div id="subir_img_dialog" title="Adjuntar Imagen">
      <form method="post" action="" class="form_subir_img" id="form_subir_img">		
			<h4>Seleccione la imagen a adjuntar</h4>
			<input type="file" name="userfile" id="userfile" size="20" />
            <input type="hidden" id="id" name="id" value=""/>		  
		</form>        
     </div>
      <div id="borrar_img_dialog" title="Eliminar Imagen">
        <form id="form_borrar_imagen">
           <h3>¿Seguro desea eliminar este archivo de imagen?</h3><br />    
           <input type="hidden" id="id" name="id" />
           <input type="hidden" id="nombre_imagen" name="nombre_imagen" />      
          <h4></h4>
       </form>
     </div> 
      <div id="imagen_ok_dialog">
         <h4></h4>
      </div>
       <div id="articulo_ok_dialog">
         <h4></h4>
      </div>  
        
      <div id="eliminar_dialog">
         <p></p><br/> 
      </div>
      
     <div id="msgDialog">
         <p></p><br/> 
     </div>                                                        
