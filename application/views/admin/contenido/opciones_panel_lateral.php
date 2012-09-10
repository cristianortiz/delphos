  <?$this->load->view('admin/contenido/cabecera_panel');?>
 <form id="config_panel_lateral" class="visualizar">
 <fieldset>
 <legend>Configuracion de Noticias Visibles</legend>
 <label for="opcion">Cantidad de Noticias Visibles</label><br />
    <select  name="num_noticias_lat" id="num_noticias_lat">
	<option value="1">  1 </option>
	<option value="2" > 2 </option>
    <option value="3" > 3 </option>
    <option value="<? echo $opcion['num_noticias_lat'];?>" selected="" > <? echo $opcion['num_noticias_lat'];?></option>
          
</select>
         <div id="desplegar_opcion">Actual : <? echo $opcion['num_noticias_lat'];?> Noticias<br /><br />
 <label for="max_caracteres_lat">Maximo de Caracteres por Noticia</label><br />       
 <input type="text" size="5" id="max_caracteres_lat" name="max_caracteres_lat" value="<? echo $opcion['max_caracteres_lat'];?>" />   
</fieldset>


<input type="hidden" id="id" name="id" value="<? echo $opcion['id'] ?>" />
<input type="submit" value="Configurar" />
</form>
    
     <div id="msgDialogOpLat">
         <h4></h4>
</div>                                                        
 </div>

