<?php  $cms_sub2 = $this->All_function_model->get_menu_pid_Mposition(56,'MainMenu'); ?>
<ul class="menuchild" id='menuchild'>
                                        
		<?php foreach ($cms_sub2 as $val){ 
        if($val['menu_title']=='Committees')
        {
          $committee1 = $this->All_function_model->get_about_committee_cat();	
            
        ?>
        <li class="has-sub <?php echo (isset($page_id) && $page_id==58)?'active':'';?>"><a href="<?php echo base_url('about/committees/'.$committee1[0]['seo_url']); ?>">Committees</a><span class="icon-menu"></span>
        <ul>
        <?php foreach($committee1 as $val){ ?>
        <li class="<?php echo (isset($url_name2) && $val['seo_url']==$url_name2)?'active':''; ?>"><a href="<?php echo base_url('about/committees/'.$val['seo_url']); ?>"><?php echo $val['name']?></a><span class="icon-menu"></span></li>
        <?php } ?>
        </ul>
        <?php 
        }else{
        ?>
        <li class="<?php echo (isset($url_name2) && $val['url_name']==$url_name2)?'active':''; ?>"><a href="<?php echo base_url($val['url_name']);?>"><?php echo $val['menu_title'];?></a><span class="icon-menu"></span></li>
        <?php }}?>
                                        
</ul>





                                    	 
                                         