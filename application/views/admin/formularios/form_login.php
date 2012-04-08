<div id="login">                      
           <? 
              $attributes = array('id' => 'form_login');
              echo form_open('login', $attributes);
           ?>
           <table border="0">
             <th><h2>Login</h2></th>
             <tr> 
                <td>Usuario</td>   
                 <td><input  type="text"  id="username"  name="username" value="<?php echo set_value('username'); ?>" />
                 </td>
                 <td><?php echo form_error('username', '<div class="error_user">', '</div>');?></td>
            </tr> 
             <tr>   
               <td>Password </td>           
               <td><input type="password" id="password" name="password" /> 
               </td>
               <td><? echo form_error('password', '<div class="error_pass">', '</div>');if(!empty($login_fail)){echo $login_fail;}?></td>
             </tr> 
               <td></td>          
               <td><input type="submit" value="Ingresar" /> 
               </td>
           </table>    
            </form>
            
</div>
