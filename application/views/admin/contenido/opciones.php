  <?$this->load->view('admin/contenido/cabecera_panel');?>
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
	<option value="5"> 5 minutos</option>
	<option value="10"> 10 minutos</option>
    <option value="15" selected="" > 15 minutos</option>
    <option value="20"> 20 minutos</option>
    <option value="30"> 30 minutos</option>
    <option value="45"> 45 minutos</option>                   
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

