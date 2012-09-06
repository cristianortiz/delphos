<div id="edicion_panel">  
 <nav>
    <ul>
         <?php foreach($links_cabecera as $row){
                    echo '<li><a href="'. base_url($row['enlace']).'">'.$row['enlace_label'].'</a></li>';           
               }
        ?>		
	</ul>
  </nav>
   <h4>Bienvenido <?php echo strtoupper($this->session->userdata('username'));?> <a id="session_panel" href="<? echo base_url('login/cerrar_sesion');?>">Cerrar Sesion</a></h4>
  <h2> <?php echo $datos_panel['titulo_panel']; ?> </h2>
  <?php if($datos_panel['estado'] == ACTIVO){?>
   <div class="nuevo_articulo">
            <input class="button" id="<? echo $datos_panel['btn_nuevo'];?>" type="submit" value="<? echo $datos_panel['label_nuevo'];?>"/>          
             <input class="button" id="btn_eliminar" type="submit" value="Eliminar"/>
             <input class="button" id="<? echo $datos_panel['btn_estado'];?>" type="submit" value="<? echo $datos_panel['label_estado'];?>"/>
        </div>
       <?php }
       else{?>
            <div class="nuevo_articulo">    
             <input class="button" id="btn_eliminar" type="submit" value="Eliminar"/>
             <input class="button" id="<? echo $datos_panel['btn_estado'];?>" type="submit" value="<? echo $datos_panel['label_estado'];?>"/>
        </div>
        
       <?php }?>
  
 
