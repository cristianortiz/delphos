    <table id="tabla_avisos">
       <thead>
          <tr>                                                     
             <th>Fecha</th>
              <th>Aviso</th> 
             <th>Acciones</th>
           </tr>
       </thead>
       <tbody>                
       <?
        foreach($avisos as $row){
          echo '<tr id="fila'.$row['id'].'">                 
                  <td id="f1"> '.$row['fecha'] .'</td> 
                  <td id="f2"> '.word_limiter($row['contenido'],5) .'</td>                      
                  <td id="f3"><a href ='.$row['id'].' class="editar_pi">Editar</a> | <a href="'.$row['id'].'" class="eliminar_pi">Borrar</a></td>
                </tr> ';           
        }?>
       </tbody>
     </table>
  
