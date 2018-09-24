<?php $this->load->view('include/header_tag'); ?>
<body>
<script>
$(function() {
	$('#name').change(function() {
		var product_name = $.trim($('#name').val()).toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
		$('#seo_url').val(product_name);
	});
});
</script>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Resources</a></li>
        <li><a href="<?php echo base_url('manage-rdirectory');?>">Directory</a></li>
        <li>Edit Directory</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Edit Directory</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              <p>
                <label for="office_name" >Name  : <span>*</span></label>
                <input type="text" name="name" required id="name" value="<?php echo $details[0]['name'];?>" class="sf" />
              </p>
              
              <p>
                <label for="seo_url" >URL : <span>*</span></label>
                <input type="text" name="seo_url" required id="seo_url" value="<?php echo $details[0]['seo_url'];?>" class="sf" />
              </p>
              
              <p>
              <label for="product_specifications">Descriptions: <span>*</span></label>
             <div class="body">
              <textarea name="descriptions" id="bodyContent2" required><?php echo $details[0]['descriptions']; ?></textarea>
             </div>
            </p>
              
              <p>
                  <label for="location">Image(170x250)  : <span>*</span></label>
                  <input type="file" name="image_name"  id="image_name" >
                  <input type="hidden" name="old_image_name" value="<?php echo $details[0]['image_name']; ?>">
              </p> 
                <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/rdirectory/thumb/'.$details[0]['image_name']) && $details[0]['image_name']!='') {?>
                <p><img src="<?php echo get_site_image('upload/rdirectory/thumb').$details[0]['image_name']; ?>" width="100" /></p>
            <?php }?>
            
            <p>
                  <label for="location">Banner(1400x350)  : <span>*</span></label>
                  <input type="file" name="image_banner"  id="image_banner">
                  <input type="hidden" name="old_image_banner" value="<?php echo $details[0]['image_banner']; ?>">
              </p>
            
            <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/rdirectory/banner/thumb/'.$details[0]['image_banner']) && $details[0]['image_banner']!='') {?>
                <p><img src="<?php echo get_site_image('upload/rdirectory/banner/thumb').$details[0]['image_banner']; ?>" width="200"  /></p>
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
              
              <h3>SEO Details</h3>
            <p>
              <label for="seo_title" >Title </label>
              <input type="text" name="seo_title"  id="seo_title" value="<?php echo $details[0]['seo_title'];?>" class="sf" />
            </p>
            <p>
              <label for="seo_keyword" >Keyword </label>
              <textarea name="seo_keyword" id="seo_keyword"><?php echo $details[0]['seo_keyword'];?></textarea>
            </p>
            <p>
              <label for="seo_description" >Description</label>
              <textarea name="seo_description" id="seo_description"><?php echo $details[0]['seo_description'];?></textarea>
            </p>
              
                           
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