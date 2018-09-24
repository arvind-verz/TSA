<?php $this->load->view('include/header_tag'); ?>
<body>
<script>
$(function() {
	$('#product_name').change(function() {
		var product_name = $.trim($('#product_name').val()).toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
		$('#seo_url').val(product_name);
	});
});
</script>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Accessories</a></li>
        <li><a href="<?php echo base_url('manage-products'); ?>">Products </a></li>
        <li>Edit Products</li>
  </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="leftPanel">
      <h1 class="pageTitle">Edit Accessories Product </h1>
      <div class="From_wrap">
        <?php $this->load->view('include/message'); ?>
        <form method="post" action="" name="product" id="update_form" enctype="multipart/form-data">
          <div class="form_default">
            <p>
              <label for="name">Product Name : <span>*</span></label>
              <input type="text" name="product_name" required id="product_name" value="<?php echo $details[0]['product_name'];?>" class="sf" />
            </p>
            <p>
                <label for="seo_url" >URL : <span>*</span></label>
                <input type="text" name="seo_url" required readonly id="seo_url" value="<?php echo $details[0]['seo_url'];?>" class="sf" />
              </p>
            <p>
              <label for="product_description">Product Descriptions : <span>*</span></label>
            <div class="body">
              <textarea name="product_description" id="bodyContent"><?php echo $details[0]['product_description'];?></textarea>
            </div>
            </p>
            <p>
              <label for="product_specifications">Product Key Features : <span>*</span></label>
            <div class="body">
              <textarea name="product_specifications" id="bodyContent"><?php echo $details[0]['product_specifications'];?></textarea>
            </div>
            </p>
            
            <p>
              <label for="location">Listing Image (266 X 209) : <span>*</span></label>
              <input type="file" name="image_listing"  id="image_listing">
              <input type="hidden" name="image_listing_old"  id="image_listing_old" value="<?php echo $details[0]['image_listing']; ?>">
            </p> 
            <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/products/listing/'.$details[0]['image_listing']) && $details[0]['image_listing']!='') {?>
                <p><img src="<?php echo get_site_image('upload/products/listing').$details[0]['image_listing']; ?>"  width="100"  /></p>
            <?php }?>
            
            <p>
              <label for="location">Main Image (453 X 427) </label>
              <input type="file" name="image_name" id="image_name">
              <input type="hidden" name="old_image_name" value="<?=$details[0]['image_name']?>">
            </p>
            <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/products/thumb/'.$details[0]['image_name']) && $details[0]['image_name']!='') {?>
                <p><img src="<?php echo get_site_image('upload/products/thumb').$details[0]['image_name']; ?>"  /></p>
            <?php }?> 
            <p>
              <label for="title" >Additional Images </label>
              <img src="<?php echo image('add-icon.png'); ?>" id="addupload" onClick="addImage_file();" alt=""> </p>
            <p id="display">
              <input type="file" name="file[]" class="sf">
            </p>
            <div class="clear"></div>
            <?php if(count($additional_images)>0){?>
            <p>
              <?php foreach ($additional_images as $key => $val): ?>
            <div id="file_view" class="<?php echo $val['id']; ?>"> <img  src="<?php echo get_site_image('upload/products/thumb').$val['image_name']; ?>" alt="<?php echo $val['image_name'] ?>" title="<?php echo $val['image_name'] ?>"> <a id="remove_file" onClick="remove_file2(<?php echo $val['id'] ?>)"><img alt="" src="<?php echo image('approval-no-icon.png'); ?>"></a></div>
            <?php endforeach; ?>
            </p>
            <?php }?>
            <div class="clear"></div>
             
            
            <div class="clear"></div>
            <p>
              <label for="cat_id" >Select Category : <span>*</span> </label>
              <select name="cat_id" required class="sf">
                <option value=""> -- Select One -- </option>
				<?php foreach ($category as $key => $val): ?>
                <!--<option value="<?php echo $val['cat_id'];?>" <?php if($details[0]['cat_id']==$val['cat_id']){echo 'selected';}?>><?php echo $val['cat_name'];?></option>-->
                <optgroup label="<?php echo $val['cat_name'];?>">
                <?php $sub_categories = $this->Categories_model->get_sub_categories($val['cat_id']);
																	if(count($sub_categories)>0){
																	foreach ($sub_categories as $key => $val){?>
                <option value="<?php echo $val['cat_id'];?>" <?php if($details[0]['cat_id']==$val['cat_id']){echo 'selected';}?>>&nbsp; &gt;&gt; <?php echo $val['cat_name'];?></option>
                <?php $sub_sub_categories = $this->Categories_model->get_sub_categories($val['cat_id']);
                                                                            if(count($sub_sub_categories)>0){
                                                                            foreach ($sub_sub_categories as $key => $val){?>
                <option value="<?php echo $val['cat_id'];?>" <?php if($details[0]['cat_id']==$val['cat_id']){echo 'selected';}?>>&nbsp;&nbsp;&nbsp; &gt;&gt;&gt; <?php echo $val['cat_name'];?></option>
                <?php } } ?>
                <?php } } ?>
                </optgroup>
                <?php endforeach; ?>
              </select>
            </p>
            
            <p>
              <label for="name">Sort Order </label>
              <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order'];?>" class="sf" />
            </p>
            <p>
              <?php $status = $details[0]['status'];?>
              <label for="status">Status : <span>*</span></label>
              <label for="status" style="text-align:left;">Enable
                <input type="radio" name="status" value="Y" <?php if($status=='Y'){ echo 'checked="checked"';}?>>
              </label>
              <label for="status" style="text-align:left;">Disable
                <input type="radio" name="status" value="N" <?php if($status=='N'){ echo 'checked="checked"';}?>>
              </label>
            </p>
            <div class="clear"></div>
            
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
              <button type="reset" >Reset</button>
              <button type="submit" value="update_form" name="update_form" >Submit</button>
            </p>
          </div>
        </form>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>