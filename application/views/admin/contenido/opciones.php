 <div id="edicion_panel">
  
 <nav>
    <ul>
	
		<li><a href="<?echo base_url('panel_principal7editar');?>">Articulos</a></li>
		<li><a href="<?echo base_url('panel_principal/videos');?>">Videos</a></li>
		<li><a href="<?echo base_url('panel_principal/opciones');?>">Opciones</a></li>
		
	
	</ul>
  </nav>
<h4>Bienvenido <?php echo strtoupper($this->session->userdata('username'));?> <a id="session_panel" href="<? echo base_url('login/cerrar_sesion');?>">Cerrar Sesion</a></h4>  
<h2>Panel Principal: Opciones</h2>
<h3>Configurar  para reproducir lista de videos o articulos texto animado</h3>
 
 <form id="visualizar">
 <label for="opcion">Elegir Visualizacion</label>
    <select  name="opcion" id="opcion">
	<option value="video">Mostrar Videos</option>
	<option value="texto">Mostrar Articulos</option>   
</select>
<input type="hidden" id="id" name="id" value="<?echo $opcion['id'] ?>" />
<input type="submit" value="Configurar" />

<p></p>
</form>
     <!-- seccion de cuadros de dialogos, ocultos, desplegados por JQuery, para crear, editar y elminar un aviso
          desde la cinta de mensajes 
      <div id="crearDialog_princ" title="Crear Nuevo Articulo">
        <form id="form-crear-princ">
            <h3>Crear el Articulo</h3><br /> 
                 
            <textarea  name="contenido" id="contenido"></textarea>     
            <p></p>
         </form>
      </div> 
     
     
   
     <div id="eliminarDialog_princ" title="Eliminar Articulo">
       <form id="form-eliminar-princ">
       <h3>�Seguro desea eliminar este articulo?</h3><br />
       
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

