 <div id="edicion_panel"> 
      <h4>Bienvenido <?php echo strtoupper($this->session->userdata('username'));?> <a id="session_panel" href="<? echo base_url('login/cerrar_sesion');?>">Cerrar Sesion</a></h4>
  <h2> <?php echo $datos_panel['titulo_panel']; ?> </h2>
   <div class="nuevo_articulo">
            <input class="button" id="<? echo $datos_panel['btn_nuevo'];?>" type="submit" value="<? echo $datos_panel['label_nuevo'];?>"/>
            <input class="button" id="<? echo $datos_panel['btn_eliminar'];?>" type="submit" value="<? echo $datos_panel['label_eliminar'];?>"/>          
        </div>
       <?
        if(empty($lista_usuarios)){
          
                 echo '<h3>No se ha creado ninguna cuenta de usuario</h3>';         
         }
         else{ ?>
      
     <table id="tabla_avisos">
       <thead>
          <tr>
             <th><input name="all" type="checkbox" value="1" class="check_all"/></th>  
             <th>Usuario</th>                                                     
             <th>Password</th>
              <th>Email</th> 
              <th>Perfil</th>            
             <th>Acciones</th>
           </tr>
       </thead>
       <tbody>                   
       <?   
        foreach($lista_usuarios as $row){
          echo '<tr id="fila'.$row['id'].'">
                  <td id="fcheck"><input class="marcar_usuarios" type="checkbox" name="" value="'.$row['id'].'" /></td>               
                  <td id="f1"> '.$row['username'] .'</td> 
                  <td id="f1"> '. preg_replace("/[A-Za-z0-9]/","*",$row['password']).'</td> 
                  <td id="f2"> '.$row['email'] .'</td>
                  <td id="f3"> '.$row['perfil_id'].'</td>                 
                  <td id="f4"><a href ='.$row['id'].' class="editar_usuario"><img  src="'.base_url('recursos/images/edit.png').'"  />                         
                  </td>               
                </tr>';                                            
         }
       ?>
       </tbody>
     </table>
     <?} ?>
   	<div class="page_numbers"><p><?php echo $links; ?></p></div>
     
     <!-- seccion de cuadros de dialogos, ocultos, desplegados por JQuery, para crear, editar y eliminar contenido -->
     
          
     <!-- cuadros de dialogo para el boton  Nuevo Articulo, del panel principal -->
     <div id="crear_nuevo_usuario"  style="width: 500px;text-align: left;font-size: 14px;" title="Nuevo Usuario">
       <form id="form_nuevo_usuario">
         <table border="0">
          <tr>
           <td>Nombre de Usuario</td>
           <td><input type="text" id="username" size="15" name="username" value=""/></td>
         </tr>
         <tr>         
          <td>Password </td>
          <td><input type="password" id="password" size="15" name="password" value="" /></td>
         </tr>
         <tr>
           <td>Email </td>
           <td><input type="text" id="email" size="15" name="email" value="" /></td>
         </tr>
         <tr>
          <td>Perfil </td>
           <td>
            <select  name="perfil_id" id="perfil_id">
	           <option value="editor">Editor</option>
	           <option value="editor_noticias">Editor Noticias</option>
               <option value="editor_avisos" selected="" >Editor Avisos</option>                             
            </select>
          </td>
        </tr>
       </table>                    
       <p></p>
       </form>
     </div> 
     
       <!--cuadros de dialogo para el boton  Eliminar, del la vista de edicion de usuarios -->
     <div id="eliminar_usuarios" title="Eliminar Usuarios">     
       <h3>¿Eliminar las cuentas de usuarios seleccionadas?</h3>
                   
     </div> 
     
     
      <!-- cuadros de dialogo para el en lace de Editar Articulo, en la tabla de articulos del panel principal -->
     <div id="editar_usuarios"  style="width: 500px;text-align: left;font-size: 14px;" title="Editar Info del Usuario">
       <form id="form_editar_usuarios">
       <table border="0">
        <tr>
          <td>Nombre de Usuario</td>
           <td><input type="text" id="username" size="15" name="username" value=""/></td>
         </tr>
         <tr>         
          <td>Password </td>
          <td><input type="password" id="password" size="15" name="password" value="" /></td>
         </tr>
         <tr>
           <td>Email </td>
           <td><input type="text" id="email" size="15" name="email" value="" /></td>
         </tr>
         <tr>
          <td>Perfil </td>
           <td>
            <select  name="perfil_id" id="perfil_id">
	           <option value="editor">Editor</option>
	           <option value="editor_noticias">Editor Noticias</option>
               <option value="editor_avisos" selected="" >Editor Avisos</option>                             
            </select>
          </td>
          <tr>
           <td>Perfil Actual: </td>
            <td><div id="perfil_aux"></div></td> 
         </tr>  
        </table>  
        <input type="hidden" id="id" name="id" value=""/>
                          
       <h4></h4>
       </form>
     </div> 
                   
    <!-- cuadros de dialogos de confirmacion y finalizacion para cada una de las acciones anteriores -->   
    
       <div id="editar_usuario_ok">
         <h4></h4>
      </div>  
        
      <div id="eliminar_usuarios_ok">
         <h4></h4>
      </div>
       
          
     <div id="crear_usuario_ok">
         <h4></h4>
     </div>                                                        
