  <?
       $this->load->view('admin/contenido/cabecera_panel');?>
	<a class="subir-video" href="#">Subir Video</a>	<a class="video-online" href="#">Video Online</a>
	<div id="contenedor_form_video" class="subir-video">
    <h3>Sube un video desde tu PC</h3>
		<form method="post" action="" class="form_videos" id="upload_file">
			<label for="desc">
				Titulo
			</label>
			<input type="text" name="desc" id="desc" value="" />
			<label for="userfile">Video	</label>
			<input type="file" name="userfile" id="userfile" size="20" />
			<input type="submit" name="submit" id="submit" value="Subir Video"/>
          
		</form>
	</div>
    <div id="contenedor_form_video" class="video-online">
     <h3>Agrega un video online desde <span style="padding-left: 7px;"><img src="<? echo base_url('recursos/images/youtube-icon.png');?>"  /></span></h3>
		<form method="post" action="" class="form_videos" id="video-online">
			<label for="titulo">Titulo</label>
			<input type="text" name="titulo" id="titulo" value="" />
			<label for="enlace">Enlace Video
			</label>
		    	<input type="text" name="enlace" id="enlace" value="" />
			<input type="submit" name="submit" id="submit" value="Subir Video"/>
          
		</form>
	</div>
	<h3>
		Lista de Videos
	</h3>
	<div id="files">
	</div>
   	<?if(empty($videos)){
	     echo '<h3>No hay videos para mostrar<h/3>';}
         else{ ?>
	        <table id="tabla_avisos">
	         <thead>
			  <tr>
                <th>fecha</th>
				<th>Nombre</th>
				<th>Descripcion</th>
                <th>Tipo</th>
				<th>Acciones</th>
			  </tr>
		     </thead>
		     <tbody>		
             <?foreach($videos as $row){
		       echo '
              <tr id="fila'.$row[ 'id']. '">
                <td id="f1"> '.$row[ 'fecha'] . '</td>                 
		        <td id="f2"> '.$row[ 'nombre'] . '</td> 
		        <td id="f3"> '.$row[ 'descripcion'] . '</td>
                <td id="f4"> '.$row[ 'tipo'] . '</td>
		        <td id="f5"><a href="'.$row[ 'id']. '" class="eliminar_video">Borrar</a></td>
		      </tr> '; }
                 }?>
		</tbody>
	</table>
	<div class="page_numbers">
		<p>
			<?php echo $links; ?>
		</p>
	</div>
    <div id="borrar_video_dialog" title="Eliminar Video">
       <form id="form_borrar_video">
       <h3>¿Seguro desea eliminar el siguiente video?</h3><br />    
       <input type="hidden" id="id" name="id" />
       <input type="hidden" id="nombre_video" name="nombre_video" />
       <input type="hidden" id="tipo_video" name="tipo_video" />
       <h4></h4>
       </form>
     </div> 
	<div id="video_ok_dialog">
		<p>
		</p>
	</div>
</div>