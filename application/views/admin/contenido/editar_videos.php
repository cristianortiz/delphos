
 <div id="edicion_panel">
  <h2>Panel Principal</h2>
 <nav>
   <ul>
		<li><a href="<?echo base_url('panel_principal');?>">Articulos</a></li>
		<li><a href="<?echo base_url('panel_principal/videos');?>">Videos</a></li>
		<li><a href="<?echo base_url('panel_principal/opciones');?>">Opciones</a></li>
		
	</ul>
  </nav>
  <h3>Subir Videos</h3>
 <div id="contenedor_form_video">  
    <form method="post" action="" class="form_videos" id="upload_file">
      <label for="des">Descripcion</label>
      <input type="text" name="desc" id="desc" value="" />
      <label for="userfile">Video</label>
      <input type="file" name="userfile" id="userfile" size="20" />
      <input type="submit" name="submit" id="submit" value="Subir Video"/>
    </form>
 </div>  
   <h3>Lista de Videos</h3>
   <div id="files"></div>

      <table id="tabla_avisos">
       <thead>
          <tr>                                                     
             <th>Nombre</th>
              <th>Descripcion</th>  
             <th>Acciones</th>
           </tr>
       </thead>
       <tbody>                
       <?
        foreach($videos as $row){
          echo '<tr id="fila'.$row['id'].'">                 
                  <td id="f1"> '.$row['nombre'] .'</td> 
                  <td id="f2"> '.$row['descripcion'] .'</td>
                                                     
                  <td id="f4"><a href="'.$row['id'].'" class="eliminar_video">Borrar</a></td>
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
     <div id="editarPrincipal" title="Editar Principal">
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
            <textarea cols="60" rows="10" name="contenido" id="contenido"></textarea>     
        <input type="hidden" id="id" name="id" value=""/>
                          
       <p></p>
       </form>
     </div> 
    <!--
     <div id="eliminarDialog_princ" title="Eliminar Articulo">
       <form id="form-eliminar-princ">
       <h3>¿Seguro desea eliminar este articulo?</h3><br />
       
       <textarea readonly="readonly" name="contenido" id="contenido"></textarea>
       <input type="hidden" id="id" name="id" />
       <p></p>
       </form>
     </div> 
     -->
     <div id="msgDialog">
         <p></p><br/> 
</div>                                                        
 </div>

