 <div class="rotator">
                      <ul id="rotmenu">
                        
                          <?php foreach ($texto as $item):?>
                             <li>
                                <a href="<?php echo 'rot'.$item['id'];?>"></a>
                                <div style="display:none;">
                                 <div class="info_image"><?php echo $item['imagen'];?></div>                                 
                                  <div class="info_heading"><?php echo $item['descripcion'];?></div>
                                   <div class="info_title"><?php echo strtoupper($item['titulo']);?></div>
                                  
                                  <div class="info_description">
                                    <?php echo $item['contenido'];?>
                                  </div>
                               </div>
                             </li>  
                                
                            <?php endforeach;?>                           
                      </ul>
                      <div id="rot1">
                            <img src="recursos/images/1.jpg" width="100%" height="100%" class="bg" alt=""/>
                           
                            <div class="heading">
                                <h1></h1>
                            </div>
                             <div class="title">
                                <h3></h3>
                            </div>
                            <div class="description">
                               <p></p>        
                            </div>    
                      </div>
                    </div>
                   </div>                    