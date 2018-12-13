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
                    
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
           <?php echo form_open('admin/edit-menu-item/'.$menu_pos.'/'.$menu_id); ?>
            <input type="hidden" name="menu_pos" id="menu_pos" value="<?php echo $menu_pos; ?>">
           <div class="box-body">
              <div class="form-group">
                <label for="menu_title" >Menu Title : <span>*</span></label>
                <input type="text" name="menu_title" required id="menu_title" value="<?php echo $details[0]['menu_title'];?>" class="form-control" />
              </div>
              <div class="form-group">
                <label for="select_link">Menu Type : <span>*</span></label>
                <input type="radio" name="link_type"<?php if($details[0]['link_type']=='internal'){ ?> checked<?php } ?> value="internal" required style="width:60px; height:auto;">
                Select Page
                <input type="radio" name="link_type"<?php if($details[0]['link_type']=='external'){ ?> checked<?php } ?> value="external" style="width:60px; height:auto;">
                External Link </div>
              <div class="form-group" id="select_page_box">
                <?php if($details[0]['link_type']=='internal'){ ?>
                <label for="page_id" >Select Page: </label>
                <select name="page_id" class="form-control">
                  <?php foreach ($pages as $key => $val): ?>
                  <option value="<?php echo $val['id'];?>" <?php if($details[0]['page_id']==$val['id']){echo 'selected';}?>><?php echo $val['page_heading'];?></option>
                  <?php endforeach; ?>
                </select>
                <?php }elseif($details[0]['link_type']=='external'){ ?>
                 <div class="form-group">
                <label for="external_box">External URL  : <span>*</span></label>
                <input type="text" name="external_url" placeholder="http://" id="external_url" required value="<?php echo $details[0]['external_url'] ?>" class="form-control" />
                </div>
                <?php } ?>
              </div>
             <div class="form-group" id="link_target">
                <label for="link_target">Page Target : </label>
                <select name="link_target" class="form-control">
                  <option value="self"<?php if($details[0]['link_target']=='self'){echo ' selected';}?>>Same Tab</option>
                  <option value="new_tab"<?php if($details[0]['link_target']=='new_tab'){echo ' selected';}?>>New Tab</option>
                </select>
              </div>
              <?php if($menu_pos=='footerBottom' || $menu_pos=='footerBottom2'){?>
              <input type="hidden" name="parent_id"  id="parent_id" value="0" class="sf" />
              <?php }else{?>
              <div class="form-group">
                <label for="parent_id">Parent Menu : <span>*</span></label>
                <select name="parent_id" id="parent_id" required class="form-control">
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
              </div>
              <?php }?>
              <div class="form-group">
                <label for="sort_order" >Sort Order : </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order'];?>" class="form-control" />
              </div>
              </div>
            <div class="box-footer">
              <div class="form-group">
                <button type="reset" >Cancel</button>
                <button type="submit" value="update_form" name="update_form" onClick="return menu_form_valid();">Submit</button>
              </div>
            </div>
          <?php echo form_close(); ?>
        </div>
            </div>
        </div>
    </section>
</div>