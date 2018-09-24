<?php $this->load->view('include/header_tag'); ?>
<body>

<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
    	<li><a>CMS</a></li>
    	<li><a href="<?php echo base_url('manage-advertise'); ?>">Advertise</a></li>
   		<li>Edit Advertise</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Edit Advertise</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              <p>
                <label for="office_name" >URL  : <span>*</span></label>
                <input type="text" name="url" required id="url" value="<?php echo $details[0]['url'];?>" class="sf" />
              </p>
             <p>
                  <label for="location">Image(500x228)  : <span>*</span></label>
                  <input type="file" name="image_name"  id="image_name" >
                  <input type="hidden" name="old_image_name" value="<?php echo $details[0]['image_name']; ?>">
              </p> 
                <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/advertise/thumb/'.$details[0]['image_name']) && $details[0]['image_name']!='') {?>
                <p><img src="<?php echo get_site_image('upload/advertise/thumb').$details[0]['image_name']; ?>" width="200" /></p>
            <?php }?>
              <p>
                <label for="sort_order" >Sort Order: </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order'];?>" class="sf" />
              </p>              
              <p>
                <?php $status = $details[0]['status'];?>
                <label for="status">Status </label>
                <label for="status" style="text-align:left;">Enable
                  <input type="radio" name="status" value="Y" <?php if($status=='Y'){ echo 'checked="checked"';}?>>
                </label>
                <label for="status" style="text-align:left;">Disable
                  <input type="radio" name="status" value="N" <?php if($status=='N'){ echo 'checked="checked"';}?>>
                </label>
              </p>
              <div class="clear"></div>
              
              
            
              
                            
              <p>
                <button type="reset" >Cancel</button>
                <button type="submit" value="update_form" name="update_form" >Submit</button>
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