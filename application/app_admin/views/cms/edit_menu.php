<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <div class="gridMainbodyDiv">
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Edit Menu Item :: <?php echo $details[0]['menu_title'];?> <a class="button" href="<?php echo base_url('manage-menu-list/'.$menu_pos); ?>"><span>Menu List</span></a></h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <input type="hidden" name="menu_pos" id="menu_pos" value="<?php echo $menu_pos; ?>">
            <div class="form_default">
              <p>
                <label for="menu_title" >Menu Title : <span>*</span></label>
                <input type="text" name="menu_title" required id="menu_title" value="<?php echo $details[0]['menu_title'];?>" class="sf" />
              </p>
              <p>
                <label for="select_link">Menu Type : <span>*</span></label>
                <input type="radio" name="link_type"<?php if($details[0]['link_type']=='internal'){ ?> checked<?php } ?> value="internal" required style="width:60px; height:auto;">
                Select Page
                <input type="radio" name="link_type"<?php if($details[0]['link_type']=='external'){ ?> checked<?php } ?> value="external" style="width:60px; height:auto;">
                External Link </p>
              <p id="select_page_box">
                <?php if($details[0]['link_type']=='internal'){ ?>
                <label for="page_id" >Select Page: </label>
                <select name="page_id" class="sf">
                  <?php foreach ($pages as $key => $val): ?>
                  <option value="<?php echo $val['id'];?>" <?php if($details[0]['page_id']==$val['id']){echo 'selected';}?>><?php echo $val['page_heading'];?></option>
                  <?php endforeach; ?>
                </select>
                <?php }elseif($details[0]['link_type']=='external'){ ?>
                <label for="external_box">External URL  : <span>*</span></label>
                <input type="text" name="external_url" placeholder="http://" id="external_url" required value="<?php echo $details[0]['external_url'] ?>" class="sf" />
                <?php } ?>
              </p>
              <p id="link_target">
                <label for="link_target">Page Target : </label>
                <select name="link_target" class="sf">
                  <option value="self"<?php if($details[0]['link_target']=='self'){echo ' selected';}?>>Same Tab</option>
                  <option value="new_tab"<?php if($details[0]['link_target']=='new_tab'){echo ' selected';}?>>New Tab</option>
                </select>
              </p>
              <?php if($menu_pos=='footerBottom' || $menu_pos=='footerBottom2'){?>
              <input type="hidden" name="parent_id"  id="parent_id" value="0" class="sf" />
              <?php }else{?>
              <p>
                <label for="parent_id">Parent Menu : <span>*</span></label>
                <select name="parent_id" id="parent_id" required class="sf">
                  <option value=""> -- Select Parent Menu -- </option>
                  <option value="0"<?php if($details[0]['parent_id']=='0'){echo 'selected';}?>> -- Root -- </option>
                  <?php foreach ($parent_menu as $key => $val): ?>
                  <option value="<?php echo $val['id'];?>" <?php if($details[0]['parent_id']==$val['id']){echo 'selected';}?>><?php echo $val['menu_title'];?></option>
                  <?php $sub_menu = $this->Cms_model->get_sub_menu($val['id']);

						if(!empty($sub_menu)){

						foreach ($sub_menu as $key => $vals){?>
                  <option value="<?php echo $vals['id'];?>" <?php if($details[0]['parent_id']==$vals['id']){echo 'selected';}?>>&nbsp; &gt;&gt; <?php echo $vals['menu_title'];?></option>
                  <?php $sub_sub_menu = $this->Cms_model->get_sub_menu($vals['id']);

						if(!empty($sub_sub_menu)){

						foreach ($sub_sub_menu as $key => $valss){?>
                  <option value="<?php echo $valss['id'];?>" <?php if($details[0]['parent_id']==$valss['id']){echo 'selected';}?>>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&gt; <?php echo $valss['menu_title'];?></option>
                  <?php } } ?>
                  <?php } } ?>
                  <?php endforeach;?>
                </select>
              </p>
              <?php }?>
              <p>
                <label for="sort_order" >Sort Order : </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order'];?>" class="sf" />
              </p>
              <p>
                <button type="reset" >Cancel</button>
                <button type="submit" value="update_form" name="update_form" onClick="return menu_form_valid();">Submit</button>
              </p>
            </div>
          </form>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>  
</div> 
<?php $this->load->view('include/footer'); ?> 
</body>
</html>