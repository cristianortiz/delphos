  <?$this->load->view('admin/contenido/cabecera_panel');?>
 <form id="visualizar" class="visualizar">
 <fieldset>
 <legend>Configurar manualmente el tipo de visualizacion</legend>
 <label for="opcion">Elegir Visualizacion</label>
    <select  name="opcion" id="opcion">
    <option value="#">-----</option>
	<option value="video">Lista de Videos</option>
	<option value="texto" >Mostrar Articulos</option>   
</select>
    <?php if($opcion['desplegar'] == TEXT_MODE){
        echo ' <div id="desplegar_opcion">Actual : Articulos</div>';
    }
    else{
        echo ' <div id="desplegar_opcion">Actual : Videos</div>';
    }
    ?>
</fieldset>
<br />
 <!--  <fieldset>
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
</fieldset>-->
<input type="hidden" id="id" name="id" value="<? echo $opcion['id'] ?>" />
<input type="submit" value="Configurar" />
</form>
    
     <div id="msgDialogOpcion">
         <h4></h4>
</div>                                                        
 </div>

