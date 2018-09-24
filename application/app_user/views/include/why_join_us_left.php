<?php  $cms_sub = $this->All_function_model->get_menu_pid_Mposition(61,'MainMenu'); ?>
                                    	 <ul class="menuchild" id='menuchild'>
                                         <?php foreach ($cms_sub as $val){ ?>
                                         <li class="<?php echo (isset($url_name2) && $val['url_name']==$url_name2)?'active':''; ?>"><a href="<?php echo base_url($val['url_name']);?>"><?php echo $val['menu_title'];?></a></li>
                                         <?php }?>
                                   		 </ul>