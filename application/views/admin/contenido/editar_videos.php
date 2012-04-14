<div id="edicion_panel">
	<h2>
		Panel Principal
	</h2>
	<nav>
		<ul>
			<li>
				<a href="<?echo base_url('panel_principal');?>">Articulos</a>
			</li>
			<li>
				<a href="<?echo base_url('panel_principal/videos');?>">Videos</a>
			</li>
			<li>
				<a href="<?echo base_url('panel_principal/opciones');?>">Opciones</a>
			</li>
		</ul>
	</nav>
	<h3>
		Subir Videos
	</h3>
	<div id="contenedor_form_video">
		<form method="post" action="" class="form_videos" id="upload_file">
			<label for="desc">
				Descripcion
			</label>
			<input type="text" name="desc" id="desc" value="" />
			<label for="userfile">
				Video
			</label>
			<input type="file" name="userfile" id="userfile" size="20" />
			<input type="submit" name="submit" id="submit" value="Subir Video"/>
          
		</form>
	</div>
	<h3>
		Lista de Videos
	</h3>
	<div id="files">
	</div>
	<table id="tabla_avisos">
		<thead>
			<tr>
				<th>
					Nombre
				</th>
				<th>
					Descripcion
				</th>
				<th>
					Acciones
				</th>
			</tr>
		</thead>
		<tbody>
			<? foreach($videos as $row){ echo '<tr id="fila'.$row[ 'id']. '">                 
			<td id="f1"> '.$row[ 'nombre'] . '</td> 
			<td id="f2"> '.$row[ 'descripcion'] . '</td>
			<td id="f4"><a href="'.$row[ 'id']. '" class="eliminar_video">Borrar</a></td>
			</tr> '; }?>
		</tbody>
	</table>
	<div class="page_numbers">
		<p>
			<?php echo $links; ?>
		</p>
	</div>

	<div id="video_ok_dialog">
		<p>
		</p>
	</div>
</div>