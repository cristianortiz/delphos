
 <div id="menu-edicion">
 <div class="block_session">Bienvenido <?php echo $this->session->userdata('username');?></div>
  <div class="session_close"><a href="<?echo base_url('login/cerrar_sesion');?>">Cerrar Sesion</a></div>

       
         <ul class="ca-menu">
          <? if( $this->session->userdata('perfil') == ADMIN){ ?> 
            <li><a href="<?echo base_url('panel_principal/editar/activo');?>"><h2 class="ca-main">Panel Principal</h2>
                        	<h3 class="ca-sub">Edite el panel principal</h3></a>
            </li>               
            <li><a href="<?echo base_url('panel_lateral/editar/activo');?>"><h2 class="ca-main">Panel Lateral</h2>
			             	<h3 class="ca-sub">Edite los mensajes laterales</h3></a>
           </li>               
            <li><a href="<?echo base_url('panel_inferior/editar');?>"><h2 class="ca-main">Panel Inferior</h2>
			             	<h3 class="ca-sub">Edite la cinta de avisos</h3></a>
            </li>
             <li><a href="#"><h2 class="ca-main">Usuarios y Perfiles</h2>
			             	<h3 class="ca-sub">Crear y editar usuarios y sus perfiles de acceso</h3></a>
        
          <? }
          if( $this->session->userdata('perfil') == EDIT_NT){?>
          
            <li><a href="<?echo base_url('panel_lateral/editar');?>"><h2 class="ca-main">Panel Lateral</h2>
			             	<h3 class="ca-sub">Edite los mensajes laterales</h3></a>
             </li>               
            <li><a href="#"><h2 class="ca-main">Mis Datos</h2>
			             	<h3 class="ca-sub">Modificar la informacion asociada a su cuenta de usuario</h3></a>                
            </li>
           
          <?} 
          if( $this->session->userdata('perfil') == EDIT_AV){?>
          
            <li><a href="<?echo base_url('panel_inferior/editar');?>"><h2 class="ca-main">Panel Inferior</h2>
			             	<h3 class="ca-sub">Edite la cinta de avisos</h3></a>
            </li>
            <li><a href="#"><h2 class="ca-main">Mis Datos</h2>
			             	<h3 class="ca-sub">Modificar la informacion asociada a su cuenta de usuario</h3></a>                
            </li>
           
          <?}?>                       
    </ul>                                   
 </div>

