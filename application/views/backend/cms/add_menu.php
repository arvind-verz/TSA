
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
        <?php //echo '<pre>'; print_r($classes); echo '</pre>';?>
    </section>
    <?php 
	$this->load->view('backend/include/messages');	?>
    <!-- Main content -->
    <section class="content">
    
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    
          <?php echo form_open('admin/add-menu-item/'.$menu_pos); ?>
            <input type="hidden" name="menu_pos" id="menu_pos" value="<?php echo $menu_pos; ?>">
            <div class="box-body">
              <div class="form-group">
                <label for="menu_title" >Menu Title  : <span>*</span> </label>
                <input type="text" name="menu_title" id="menu_title" value="<?php echo set_value('menu_title'); ?>" required class="form-control" />
              </div>
             <div class="form-group">
                <label for="select_link">Menu Type  : <span>*</span></label>
                <input type="radio" name="link_type" value="internal" required style="width:60px; height:auto;">
                Select Page
                <input type="radio" name="link_type" value="external" style="width:60px; height:auto;">
                External Link </div>
              <p id="select_page_box" style="display:none;"></p>
              <p id="link_target" style="display:none;"></p>
              <?php if($menu_pos!='footerBottom' && $menu_pos!='footerBottom2'){?>
             <div class="form-group">
                <label for="parent_id">Parent Menu : </label>
                <select name="parent_id" id="parent_id" required class="form-control">
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
              </div>
              <?php }else{?>
              <input type="hidden" name="parent_id"  id="parent_id" value="<?php echo set_value('parent_id'); ?>" />
              <?php }?>
              <p id="menu_position_box" style="display:none;"></p>
              <div class="form-group">
                <label for="sort_order">Sort Order : </label>
                <input type="text" name="sort_order" style="width:60px; height:auto;"  id="sort_order" value="<?php echo set_value('sort_order'); ?>" class="form-control" />
              </div>
              </div>
            <div class="box-footer">
             
						<a href="<?php echo site_url('admin/manage-menu-list/'.$menu_pos); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                <button type="submit" class="btn btn-info pull-right" value="update_form" name="update_form">Submit</button>
             
            </div>
          <?php echo form_close(); ?>
</div>
            </div>
        </div>
    </section>
</div>
