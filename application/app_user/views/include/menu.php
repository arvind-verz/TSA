<div  id="cssmenu">
  <ul class="menu clearfix">
    <?php $topMenu = $this->All_function_model->get_menu_pid_Mposition(0,'MainMenu');
	foreach ($topMenu as $key => $val){
	$MenuSub = $this->All_function_model->get_menu_pid_Mposition($val['id'],'MainMenu');
	$selectMenu1 = $this->All_function_model->get_selected_menu_id($menu_id, $val['id'],'MainMenu');?>
    
    <?php if($val['menu_title']=='ABOUT US' || $url=='about-us'){ ?>
    <li <?php if($selectMenu1=='Y'){echo 'class="active"';}elseif($url==$val['url_name']){echo 'class="active"';}?>><a href="<?php echo base_url($val['url_name']);?>"><?php echo $val['menu_title'];?></a>
    <ul>
      <?php foreach ($MenuSub as $keym2 => $valm2){ 
      if($valm2['menu_title']=='Committees')
        {
          $committee1 = $this->All_function_model->get_about_committee_cat();	
            
        ?>
        <li class="<?php echo (isset($page_id) && $page_id==58)?'active':''; ?>"><a href="<?php echo base_url('about/committees/'.$committee1[0]['seo_url']); ?>"><?php echo $valm2['menu_title']?></a></li>
        <?php }else{ ?>      
        
    		<li class="<?php echo (isset($url_name2) && $valm2['url_name']==$url_name2)?'active':''; ?>"><a href="<?php echo base_url($valm2['url_name']);?>"><?php echo $valm2['menu_title'];?></a></li>
      <?php }} ?>
      </ul>
       </li>
    <?php }else{ ?>
    <li <?php if($selectMenu1=='Y'){echo 'class="active"';}elseif($url==$val['url_name']){echo 'class="active"';}?>>
      <?php if($val['link_type']=='external'){?>
      <a href="<?php if($val['external_url']=='#'){ echo 'javascript:void(0);';}else{ echo $val['external_url'];}?>" <?php if($val['link_target']=='new_tab'){echo 'target="_blank"';}?>><?php echo $val['menu_title'];?></a>
      <?php }elseif($val['link_type']=='internal'){?>
      <a href="<?php echo base_url($val['url_name']);?>" <?php if($val['link_target']=='new_tab'){echo 'target="_blank"';}?> 
	  <?php if($selectMenu1=='Y'){echo 'class="active"';}elseif($url==$val['url_name']){echo 'class="active"';}?>><?php echo $val['menu_title'];?></a>
      <?php }?>
      <?php if(count($MenuSub)>0){?>
      <ul>
        <?php foreach ($MenuSub as $keym2 => $valm2){
			$selectMenu2 = $this->All_function_model->get_selected_menu_id($menu_id, $valm2['id'],'MainMenu');?>
        <li <?php if($selectMenu2=='Y'){echo 'class="active"';}elseif($url==$valm2['url_name']){echo 'class="active"';}?>>
          <?php if($valm2['link_type']=='external'){?>
          <a href="<?php echo $valm2['external_url'];?>" <?php if($valm2['link_target']=='new_tab'){echo 'target="_blank"';}?>><?php echo $valm2['menu_title'];?></a>
          <?php }elseif($valm2['link_type']=='internal'){?>
          <a href="<?php echo base_url($valm2['url_name']);?>" <?php if($valm2['link_target']=='new_tab'){echo 'target="_blank"';}?>
          <?php if($selectMenu2=='Y'){echo 'class="active"';}elseif($url==$valm2['url_name']){echo 'class="active"';}?>><?php echo $valm2['menu_title'];?></a>
          <?php }?>
          <?php $Menu3 = $this->All_function_model->get_menu_pid_Mposition($valm2['id'],'MainMenu');
				if(count($Menu3)>0){?>
          <ul>
            <?php foreach ($Menu3 as $keym3 => $valm3){
				$selectMenu3 = $this->All_function_model->get_selected_menu_id($menu_id, $valm3['id'],'MainMenu');?>
            <li>
              <?php if($valm3['link_type']=='external'){?>
              <a href="<?php echo $valm3['external_url'];?>" <?php if($valm3['link_target']=='new_tab'){echo 'target="_blank"';}?>> <?php echo $valm3['menu_title'];?></a>
              <?php }elseif($valm3['link_type']=='internal'){?>
              <a href="<?php echo base_url($valm3['url_name']);?>" <?php if($valm3['link_target']=='new_tab'){echo 'target="_blank"';}?>
              <?php if($selectMenu3=='Y'){echo 'class="Select"';}elseif($url==$valm3['url_name']){echo 'class="Select"';}?>> <?php echo $valm3['menu_title'];?></a>
              <?php }?>
              <?php $Menu4 = $this->All_function_model->get_menu_pid_Mposition($valm3['id'],'MainMenu');
							if(count($Menu4)>0){?>
              <ul>
                <?php foreach ($Menu4 as $keym4 => $valm4){
					$selectMenu4 = $this->All_function_model->get_selected_menu_id($menu_id, $valm4['id'],'MainMenu');?>
                <li>
                  <?php if($valm4['link_type']=='external'){?>
                  <a href="<?php echo $valm4['external_url'];?>" <?php if($valm4['link_target']=='new_tab'){echo 'target="_blank"';}?>> <?php echo $valm4['menu_title'];?></a>
                  <?php }elseif($valm4['link_type']=='internal'){?>
                  <a href="<?php echo base_url($valm4['url_name']);?>" <?php if($valm4['link_target']=='new_tab'){echo 'target="_blank"';}?>
                  <?php if($selectMenu4=='Y'){echo 'class="Select"';}elseif($url==$valm4['url_name']){echo 'class="Select"';}?>> <?php echo $valm4['menu_title'];?></a>
                  <?php }?>
                  <?php $Menu5 = $this->All_function_model->get_menu_pid_Mposition($valm4['id'],'MainMenu');
												if(count($Menu5)>0){?>
                  <ul>
                    <?php foreach ($Menu5 as $keym5 => $valm5){?>
                    <li>
                      <?php if($valm5['link_type']=='external'){?>
                      <a href="<?php echo $valm5['external_url'];?>" <?php if($valm5['link_target']=='new_tab'){echo 'target="_blank"';}?>> <?php echo $valm5['menu_title'];?></a>
                      <?php }elseif($valm5['link_type']=='internal'){?>
                      <a href="<?php echo base_url($valm5['url_name']);?>" <?php if($valm5['link_target']=='new_tab'){echo 'target="_blank"';}?>> <?php echo $valm5['menu_title'];?></a>
                      <?php }?>
                    </li>
                    <?php } ?>
                  </ul>
                  <?php } ?>
                </li>
                <?php } ?>
              </ul>
              <?php } ?>
            </li>
            <?php } ?>
          </ul>
          <?php } ?>
        </li>
        <?php } ?>
      </ul>
      <?php }?>
    </li>
    <?php }?>
    <?php }?>
    <?php
    $rdirectory = $this->All_function_model->get_resource_directory();
	$pub = $this->All_function_model->get_resource_publication();
	?>
        <li <?php if(isset($url) && $url=='resource'){echo 'class="active"';} ?>><a href="<?php echo base_url('rdirectory/'.$rdirectory[0]['seo_url']) ?>">RESOURCES</a>
            <ul>
                 <li class="<?php echo (isset($url_name2) && $url_name2=='directory')?'active':'';?>"><a href="<?php echo base_url('rdirectory/'.$rdirectory[0]['seo_url']) ?>">Directory</a> 
                    <ul>
                         <?php foreach($rdirectory as $val){ ?>
                        	<li class="<?php echo ($val['seo_url']==$url_name)?'active':'';?>"><a href="<?php echo base_url('rdirectory/'.$val['seo_url']) ?>"><?php echo $val['name'];?></a></li>
                        <?php } ?>
                    </ul>
                 </li>
                 <li class="<?php echo ($url_name=='toolkit')?'active':'';?>"><a href="<?php echo base_url('toolkit') ?>">Toolkit</a></li>
                  <li class="<?php echo (isset($url_name2) && $url_name2=='publications')?'active':'';?>"><a href="<?php echo base_url('publications') ?>">Publications</a>
                    <ul>
                        <?php foreach($pub as $val){ ?>
                        <li class="<?php echo ($val['seo_url']==$url_name)?'active':'';?>"><a href="<?php echo base_url('publications/'.$val['seo_url']) ?>"><?php echo $val['name'];?></a></li>
                        <?php } ?>
                    </ul>
                 
                 </li>
                 <li class="<?php echo ($url_name=='our-network')?'active':'';?>"><a href="<?php echo base_url('our-network') ?>">Our Network</a></li>                                        	
           
            </ul>
        </li>
     
  </ul>
</div>