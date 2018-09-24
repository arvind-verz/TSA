<?php $this->load->view('include/header_tag'); ?>
<body>
<script>
$(function() {
	$('#cat_name').change(function() {
		var cat_name = $.trim($('#cat_name').val()).toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
		$('#seo_url').val(cat_name);
	});
});
</script>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Accessories</a></li>
        <li><a href="<?php echo base_url('manage-categories'); ?>">Categories </a></li>
        <li>Add Categories </li>
  </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Add Accessories Category</h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <form method="post" action="" name="categories" id="update_form" enctype="multipart/form-data">
              <div class="form_default">
                <p>
                  <label for="cat_name">Category Name  : <span>*</span></label>
                  <input type="text" name="cat_name" required id="cat_name" value="<?php echo set_value('cat_name'); ?>" class="sf" />
                </p>
                <p>
                <label for="seo_url" >URL  : <span>*</span></label>
                <input type="text" name="seo_url" required id="seo_url" value="<?php echo set_value('seo_url'); ?>" class="sf" />
              </p>
              
              <p>
                  <label for="parent_id" >Parent Category  : <span>*</span></label>
                  <select name="parent_id" class="sf" id="parent_id">
                    <option value="0" <?php if(set_value('parent_id')==0){echo 'selected';}?> >Root</option>
                    <?php foreach ($category as $key => $val): ?>
                    <option value="<?php echo $val['cat_id'];?>" <?php if(set_value('parent_id')==$val['cat_id']){echo 'selected';}?>><?php echo $val['cat_name'];?></option>
                    <?php endforeach; ?>
                  </select>
                </p>
              
              
              <p>
                  <span id="catimg" style="display:<?=($flag==0)?'none':'block'?>;">
                  <label for="location">Banner (1400 X 251) : <span>*</span></label>
                  <input type="file" name="image_banner" id="image_banner" value="">
                  </span>
              </p>
               <p>
               <span id="catimg2" style="display:<?=($flag==0)?'none':'block'?>;">
                  <label for="banner_heading" >Banner Text</label>
                  <textarea name="banner_heading" id="banner_heading"><?php echo set_value('banner_heading'); ?></textarea>
                  </span>
                </p>
                <p>
                  <label for="name">Sort Order </label>
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
                <br/>
                
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
                  <button type="submit" value="update_form" name="update_form" onClick="return categories_form_valid();">Submit</button>
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

<script>
$(document).ready(function(){
    $('#parent_id').on('change', function() {//alert(this.value);
     if ( this.value == '0')
      {
		  $('#catimg').hide();
		  $('#catimg2').hide();
	  }
     else{
		 $('#catimg').show();
		  $('#catimg2').show();
	 }
    });
});
</script>