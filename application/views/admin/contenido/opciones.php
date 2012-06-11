 <div id="edicion_panel"> 
 <nav>
    <ul>	
		<li><a href="<? echo base_url('panel_principal/editar'); ?>">Articulos</a></li>
		<li><a href="<? echo base_url('panel_principal/videos'); ?>">Videos</a></li>
		<li><a href="<? echo base_url('panel_principal/opciones'); ?>">Opciones</a></li>			
	</ul>
  </nav>
<h4>Bienvenido <?php echo strtoupper($this->session->userdata('username')); ?> <a id="session_panel" href="<? echo
base_url('login/cerrar_sesion'); ?>">Cerrar Sesion</a></h4>  
<h2>Panel Principal: Opciones</h2>

 
 <form id="visualizar" class="visualizar">
 <fieldset>
 <legend>Configurar manualmente el tipo de visualizacion</legend>
 <label for="opcion">Elegir Visualizacion</label>
    <select  name="opcion" id="opcion">
	<option value="video">Mostrar Videos</option>
	<option value="texto" selected="">Mostrar Articulos</option>   
</select>
</fieldset>
<br />
 <fieldset>
 <legend>Tiempo de reproduccion Articulos</legend>
 <label for="opcion">Duracion Articulos</label>
    <select  name="tiempo" id="tiempo">
	<option value="50000"> 5 minutos</option>
	<option value="100000"> 10 minutos</option>
    <option value="150000" selected="" > 15 minutos</option>
    <option value="200000"> 20 minutos</option>
    <option value="300000"> 30 minutos</option>
    <option value="4500000"> 45 minutos</option>                   
</select>
</fieldset>
<br />
<input type="hidden" id="id" name="id" value="<? echo $opcion['id'] ?>" />
<input type="submit" value="Configurar" />

<p></p>
</form>
    
     <div id="msgDialog">
         <p></p><br/> 
</div>                                                        
 </div>

