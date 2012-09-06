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
    <h2> <?php echo $datos_panel['titulo_panel']; ?></h2>
  
 
