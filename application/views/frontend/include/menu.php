<ul class="main-menu clearfix">
    <?php $topMenu = $this->Cms_model->get_menu_pid_Mposition(0,'MainMenu');
	foreach ($topMenu as $key => $val){
	$MenuSub = $this->Cms_model->get_menu_pid_Mposition($val['id'],'MainMenu');
	$selectMenu1 = $this->Cms_model->get_selected_menu_id($menu_id, $val['id'],'MainMenu');?>
    
    <?php  ?>
    <li <?php if($selectMenu1=='Y'){echo 'class="selected"';}elseif($url==$val['url_name']){echo 'class="selected"';}?>>
      <?php if($val['link_type']=='external'){?>
      <a href="<?php if($val['external_url']=='#'){ echo 'javascript:void(0);';}else{ echo $val['external_url'];}?>" <?php if($val['link_target']=='new_tab'){echo 'target="_blank"';}?>><?php echo $val['menu_title'];?></a>
      <?php }elseif($val['link_type']=='internal'){?>
      <a href="<?php echo site_url($val['url_name']);?>" <?php if($val['link_target']=='new_tab'){echo 'target="_blank"';}?> 
	  <?php if($selectMenu1=='Y'){echo 'class="selected"';}elseif($url==$val['url_name']){echo 'class="selected"';}?>><?php echo $val['menu_title'];?></a>
      <?php }?>
      <?php if(count($MenuSub)>0){?>
      <ul>
        <?php foreach ($MenuSub as $keym2 => $valm2){
			$selectMenu2 = $this->Cms_model->get_selected_menu_id($menu_id, $valm2['id'],'MainMenu');?>
        <li <?php if($selectMenu2=='Y'){echo 'class="selected"';}elseif($url==$valm2['url_name']){echo 'class="selected"';}?>>
          <?php if($valm2['link_type']=='external'){?>
          <a href="<?php echo $valm2['external_url'];?>" <?php if($valm2['link_target']=='new_tab'){echo 'target="_blank"';}?>><?php echo $valm2['menu_title'];?></a>
          <?php }elseif($valm2['link_type']=='internal'){?>
          <a href="<?php echo site_url($valm2['url_name']);?>" <?php if($valm2['link_target']=='new_tab'){echo 'target="_blank"';}?>
          <?php if($selectMenu2=='Y'){echo 'class="selected"';}elseif($url==$valm2['url_name']){echo 'class="selected"';}?>><?php echo $valm2['menu_title'];?></a>
          <?php }?>
          <?php $Menu3 = $this->Cms_model->get_menu_pid_Mposition($valm2['id'],'MainMenu');
				if(count($Menu3)>0){?>
          <ul>
            <?php foreach ($Menu3 as $keym3 => $valm3){
				$selectMenu3 = $this->Cms_model->get_selected_menu_id($menu_id, $valm3['id'],'MainMenu');?>
            <li>
              <?php if($valm3['link_type']=='external'){?>
              <a href="<?php echo $valm3['external_url'];?>" <?php if($valm3['link_target']=='new_tab'){echo 'target="_blank"';}?>> <?php echo $valm3['menu_title'];?></a>
              <?php }elseif($valm3['link_type']=='internal'){?>
              <a href="<?php echo site_url($valm3['url_name']);?>" <?php if($valm3['link_target']=='new_tab'){echo 'target="_blank"';}?>
              <?php if($selectMenu3=='Y'){echo 'class="Select"';}elseif($url==$valm3['url_name']){echo 'class="Select"';}?>> <?php echo $valm3['menu_title'];?></a>
              <?php }?>
              <?php $Menu4 = $this->Cms_model->get_menu_pid_Mposition($valm3['id'],'MainMenu');
							if(count($Menu4)>0){?>
              <ul>
                <?php foreach ($Menu4 as $keym4 => $valm4){
					$selectMenu4 = $this->Cms_model->get_selected_menu_id($menu_id, $valm4['id'],'MainMenu');?>
                <li>
                  <?php if($valm4['link_type']=='external'){?>
                  <a href="<?php echo $valm4['external_url'];?>" <?php if($valm4['link_target']=='new_tab'){echo 'target="_blank"';}?>> <?php echo $valm4['menu_title'];?></a>
                  <?php }elseif($valm4['link_type']=='internal'){?>
                  <a href="<?php echo site_url($valm4['url_name']);?>" <?php if($valm4['link_target']=='new_tab'){echo 'target="_blank"';}?>
                  <?php if($selectMenu4=='Y'){echo 'class="Select"';}elseif($url==$valm4['url_name']){echo 'class="Select"';}?>> <?php echo $valm4['menu_title'];?></a>
                  <?php }?>
                  <?php $Menu5 = $this->Cms_model->get_menu_pid_Mposition($valm4['id'],'MainMenu');
												if(count($Menu5)>0){?>
                  <ul>
                    <?php foreach ($Menu5 as $keym5 => $valm5){?>
                    <li>
                      <?php if($valm5['link_type']=='external'){?>
                      <a href="<?php echo $valm5['external_url'];?>" <?php if($valm5['link_target']=='new_tab'){echo 'target="_blank"';}?>> <?php echo $valm5['menu_title'];?></a>
                      <?php }elseif($valm5['link_type']=='internal'){?>
                      <a href="<?php echo site_url($valm5['url_name']);?>" <?php if($valm5['link_target']=='new_tab'){echo 'target="_blank"';}?>> <?php echo $valm5['menu_title'];?></a>
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
    <?php ?>
    <?php }?>
    
  </ul>
