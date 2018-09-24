<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Settings</a></li>
        <li><a href="<?php echo base_url('settings/general'); ?>">General Settings</a></li>
        <li>Settings Update</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Settings Update</h1>
          <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" id="update_seo_form" enctype="multipart/form-data">
            <div class="form_default">
              <fieldset>
                <p>
                  <label for="name"><?php echo lang('label.option_name') ?></label>
                  <?php echo $option_display; ?> </p>
                <?php if($field_type=='Image'){?>
                <p><img src="<?php echo get_site_image('upload/logo/thumb').$option_value; ?>" /></p>
                <?php }?>
                
                <p>
                  <label for="name"><?php echo lang('label.option_value') ?></label>
                  <?php if($field_type=='Image'){?>
                  <input type="file" name="option_value" required id="option_value" value="<?php echo $option_value;?>">
                  <?php }elseif($field_type=='PDF' || $field_type=='DOC' || $field_type=='XML'){?>
                  <input type="file" name="option_value" required id="option_value" value="<?php echo $option_value;?>">
                  <?php }elseif($field_type=='TextBox'){?>
                  <input type="text" class="sf" required id="option_value" name="option_value" value="<?php echo $option_value; ?>">
                  <?php }elseif($field_type=='TextArea'){?>
                <div class="body">
                  <textarea name="option_value" required rows="20" cols="75"><?php echo $option_value;?></textarea>
                </div>
                <?php }elseif($field_type=='TextEditor'){?>
                <div class="body">
                  <textarea name="option_value" id="bodyContent"><?php echo $option_value;?></textarea>
                </div>
                <?php }elseif($field_type=='radio'){?>
                <div class="body">
                  <input type="radio" value="1" <?php if($option_value==1){echo 'checked';}?> id="nd" name="option_value">On
                  <input type="radio" value="0" <?php if($option_value==0){echo 'checked';}?> id="nd" name="option_value">Off
                </div>
                <?php }?>
                </p>
                <p>
                  <label for="name">Last Updated</label>
                  <?php echo date('jS M Y h:i:s A', strtotime($modified_date)); ?> </p>
                <p>
                  <button value="update_seo" name="update_general_settings"><?php echo lang('menu.update') ?></button>
                </p>
              </fieldset>
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