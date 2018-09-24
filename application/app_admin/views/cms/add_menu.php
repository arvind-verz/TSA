<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <div class="gridMainbodyDiv">
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Add Menu Item :: <?php echo $display_menu;?> <a class="button" href="<?php echo base_url('manage-menu-list/'.$menu_pos); ?>"><span>Menu List</span></a></h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="menu" id="update_form" enctype="multipart/form-data">
            <input type="hidden" name="menu_pos" id="menu_pos" value="<?php echo $menu_pos; ?>">
            <div class="form_default">
              <p>
                <label for="menu_title" >Menu Title  : <span>*</span> </label>
                <input type="text" name="menu_title" id="menu_title" value="<?php echo set_value('menu_title'); ?>" required class="sf" />
              </p>
              <p>
                <label for="select_link">Menu Type  : <span>*</span></label>
                <input type="radio" name="link_type" value="internal" required style="width:60px; height:auto;">
                Select Page
                <input type="radio" name="link_type" value="external" style="width:60px; height:auto;">
                External Link </p>
              <p id="select_page_box" style="display:none;"></p>
              <p id="link_target" style="display:none;"></p>
              <?php if($menu_pos!='footerBottom' && $menu_pos!='footerBottom2'){?>
              <p>
                <label for="parent_id">Parent Menu : </label>
                <select name="parent_id" id="parent_id" required class="sf">
                  <option value=""> -- Select Parent Menu -- </option>
                  <option value="0"> -- Root -- </option>
                  <?php foreach ($parent_menu as $key => $val): ?>
                  <option value="<?php echo $val['id'];?>" <?php if(set_value('parent_id')==$val['id']){echo 'selected';} ?>><?php echo $val['menu_title'];?></option>
                  <?php $sub_menu = $this->Cms_model->get_sub_menu($val['id']);

						if(!empty($sub_menu)){

						foreach ($sub_menu as $key => $vals){?>
                  <option value="<?php echo $vals['id'];?>" <?php if(set_value('parent_id')==$vals['parent_id']){echo 'selected';} ?>>&nbsp; &gt;&gt; <?php echo $vals['menu_title'];?></option>
                  <?php $sub_sub_menu = $this->Cms_model->get_sub_menu($vals['id']);

						if(!empty($sub_sub_menu)){

						foreach ($sub_sub_menu as $key => $valss){?>
                  <option value="<?php echo $valss['id'];?>" <?php if(set_value('parent_id')==$valss['parent_id']){echo 'selected';} ?>>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&gt; <?php echo $valss['menu_title'];?></option>
                  <?php }  } ?>
                  <?php }  } ?>
                  <?php endforeach; ?>
                </select>
              </p>
              <?php }else{?>
              <input type="hidden" name="parent_id"  id="parent_id" value="<?php echo set_value('parent_id'); ?>" />
              <?php }?>
              <p id="menu_position_box" style="display:none;"></p>
              <p>
                <label for="sort_order">Sort Order : </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo set_value('sort_order'); ?>" class="sf" />
              </p>
              <p>
                <button type="reset">Cancel</button>
                <button type="submit" value="update_form" name="update_form">Submit</button>
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