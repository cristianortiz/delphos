 <div id="menu-lateral">
  <h3>Menu Principal</h3>     
         <ul class="ca-menu">
          <? if( $this->session->userdata('perfil') == ADMIN){ ?> 
            <li><a href="<?echo base_url('panel_principal/editar/activo');?>"><h2 class="ca-main">Panel Principal</h2>
                        	<h3 class="ca-sub">Edite el panel principal</h3></a>
            </li>               
            <li><a href="<?echo base_url('panel_lateral/editar/activo');?>"><h2 class="ca-main">Panel Lateral</h2>
			             	<h3 class="ca-sub">Edite los mensajes laterales</h3></a>
           </li>               
            <li><a href="<?echo base_url('panel_inferior/editar/activo');?>"><h2 class="ca-main">Panel Inferior</h2>
			             	<h3 class="ca-sub">Edite la cinta de avisos</h3></a>
            </li>
             
        
          <? }
          if( $this->session->userdata('perfil') == EDIT_NT){?>
          
            <li><a href="<?echo base_url('panel_lateral/editar/activo');?>"><h2 class="ca-main">Panel Lateral</h2>
			             	<h3 class="ca-sub">Edite los mensajes laterales</h3></a>
             </li>               
            <li><a href="#"><h2 class="ca-main">Mis Datos</h2>
			             	<h3 class="ca-sub">Modificar la informacion asociada a su cuenta de usuario</h3></a>                
            </li>
           
          <?} 
          if( $this->session->userdata('perfil') == EDIT_AV){?>
          
            <li><a href="<?echo base_url('panel_inferior/editar/activo');?>"><h2 class="ca-main">Panel Inferior</h2>
			             	<h3 class="ca-sub">Edite la cinta de avisos</h3></a>
            </li>
            <li><a href="#"><h2 class="ca-main">Mis Datos</h2>
			             	<h3 class="ca-sub">La informacion de su cuenta de usuario</h3></a>                
            </li>
           
          <?}?>                       
    </ul>                                   
 </div>

