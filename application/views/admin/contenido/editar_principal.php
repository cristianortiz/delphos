
 <div id="edicion_panel">
  <h2>Contenidos Panel Principal</h2>
 <nav>
    <ul>
		<li><a href="<?echo base_url('panel_principal');?>">Articulos</a></li>
		<li><a href="<?echo base_url('panel_principal/videos');?>">Videos</a></li>
		<li><a href="<?echo base_url('panel_principal/opciones');?>">Opciones</a></li>
		
	</ul>
  </nav>


 <h3>Articulos</h3>
 <h3>En la tabla siguiente puede editar o eliminar los Articulos que se mostraran en el panel principal</h3>
 
     <table id="tabla_avisos">
       <thead>
          <tr>                                                     
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
                  <td id="f1"> '.$row['titulo'] .'</td> 
                  <td id="f2"> '.$row['descripcion'] .'</td>
                  <td id="f3"> '.word_limiter(str_replace('<h2>',"",$row['contenido']),5) .'</td>                                   
                  <td id="f4"><a href ='.$row['id'].' class="editar_princ">Editar</a> | <a href="'.$row['id'].'" class="eliminar_princ">Borrar</a></td>
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

