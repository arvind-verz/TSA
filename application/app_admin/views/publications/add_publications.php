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
        <li><a href="<?php echo base_url('manage-publications');?>">Publications</a></li>
        <li>Add Publications</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Add Publications</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              <p>
                <label for="office_name" >Name  : <span>*</span></label>
                <input type="text" name="name" required id="name" value="<?php echo set_value('name'); ?>" class="sf" />
              </p>
              <p>
                <label for="seo_url" >URL : <span>*</span></label>
                <input type="text" name="seo_url" required id="seo_url" value="<?php echo set_value('seo_url'); ?>" class="sf" />
              </p>
              
              <p>
              <label for="product_description">Short Description : <span>*</span></label>
            <div class="body">
              <textarea name="short_descriptions" id="bodyContent2" ><?php echo set_value('short_descriptions'); ?></textarea>
            </div>
            </p>
              
               <p>
              <label for="product_description">Description : <span>*</span></label>
            <div class="body">
              <textarea name="descriptions" id="bodyContent2" ><?php echo set_value('descriptions'); ?></textarea>
            </div>
            </p>
            
            <p>
                  <label for="location">Image(170x245)  : <span>*</span></label>
                  <input type="file" name="image_name"  id="image_name" required>
              </p>
              
              <p>
                  <label for="location">Banner(1400x350)  : </label>
                  <input type="file" name="image_banner"  id="image_banner" >
              </p>
            
            
              <p>
                <label for="sort_order" >Sort Order: </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo set_value('sort_order'); ?>" class="sf" />
              </p>
              <p>
                <label for="status">Status  : <span>*</span></label>
                <label for="status" style="text-align:left;">Enable
                  <input type="radio" name="status" required value="Y" <?php if ((set_value('status') && set_value('status')=='Y') || (!set_value('status'))){echo 'checked="checked"';}?>>
                </label>
                <label for="status" style="text-align:left;">Disable
                  <input type="radio" name="status" required value="N" <?php if (set_value('status') && set_value('status')=='N'){echo 'checked="checked"';}?> >
                </label>
              </p>
              <div class="clear"></div>
              
             
            <h3>SEO Details</h3>
            <p>
              <label for="seo_title" >Title </label>
              <input type="text" name="seo_title"  id="seo_title" value="<?php echo set_value('seo_title'); ?>" class="sf" />
            </p>
            <p>
              <label for="seo_keyword" >Keyword </label>
              <textarea name="seo_keyword" id="seo_keyword"><?php echo set_value('seo_keyword'); ?></textarea>
            </p>
            <p>
              <label for="seo_description" >Description</label>
              <textarea name="seo_description" id="seo_description"><?php echo set_value('seo_description'); ?></textarea>
            </p>
              
              
              <p>
                <button type="reset" >Cancel</button>
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