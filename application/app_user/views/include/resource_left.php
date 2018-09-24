<ul class="menuchild" id='menuchild'>
                                    	 <li class="has-sub <?php echo (isset($url_name2) && $url_name2=='directory')?'active':'';?>"><a href="<?php echo base_url('rdirectory/'.$rdirectory[0]['seo_url']) ?>">Directory <span class="icon-menu"></span></a>
                                         	<ul>
                                               <?php foreach($rdirectory as $val){ ?>
                                               <li class="<?php echo (isset($page[0]['seo_url']) && $val['seo_url']==$page[0]['seo_url'])?'active':'';?>"><a href="<?php echo base_url('rdirectory/'.$val['seo_url']) ?>"><?php echo $val['name'];?><span class="icon-menu"></span></a></li>
                                                <?php } ?>
                                            </ul>
                                         </li>
                                         
                                         <li class="<?php echo (isset($url_name) && $url_name=='toolkit')?'active':'';?>"><a href="<?php echo base_url('toolkit') ?>">Toolkit<span class="icon-menu"></span></a></li>
                                          <li class="has-sub <?php echo (isset($url_name2) && $url_name2=='publications')?'active':'';?>"><a href="<?php echo base_url('publications') ?>">Publications<span class="icon-menu"></span></a>
                                         	<ul>
                                            <?php foreach($pub as $val){ ?>
                                            <li class="<?php echo (isset($page[0]['seo_url']) && $val['seo_url']==$page[0]['seo_url'])?'active':'';?>"><a href="<?php echo base_url('rdirectory/'.$val['seo_url']) ?>"><a href="<?php echo base_url('publications/'.$val['seo_url']) ?>"><?php echo $val['name'];?></a></li>
                                            
                                            <?php } ?>
                                            	
                                            </ul>
                                         
                                         </li>
                                         <li class="<?php echo (isset($url_name) && $url_name=='our-network')?'active':'';?>"><a href="<?php echo base_url('our-network') ?>">Our Network<span class="icon-menu"></span></a></li>                                        	
</ul>