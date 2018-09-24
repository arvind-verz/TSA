<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>CMS</a></li>
        <li><a href="<?php echo base_url('manage-cms'); ?>">Content Management</a></li>
        <li>Edit Page</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Edit Content :: <?php echo $details[0]['page_heading'];?></h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              <p>
                <label for="page_heading" >Page Title  : <span>*</span></label>
                <input type="text" name="page_heading" required id="page_heading" value="<?php echo $details[0]['page_heading'];?>" class="sf" />
              </p>
              <?php if($details[0]['url_not_editable']==1){?>
              <script>
								$(function() {
									$('#page_heading').change(function() {
										var page_heading = $.trim($('#page_heading').val()).toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
										$('#url_name').val(page_heading);
									});
								});
								</script>
              <p>
                <label for="url_name" >URL  : <span>*</span> </label>
                <input type="text" name="url_name" required id="url_name" value="<?php echo $details[0]['url_name'];?>" class="sf" />
              </p>
              <?php }else{?>
              <p>
                <label for="url_name" >URL  : <span>*</span> </label>
                <input type="text" name="url_name" readonly id="url_name" value="<?php echo $details[0]['url_name'];?>" class="sf readonly" />
              </p>
              <?php }?>
              <!--<input type="hidden" name="template" value="Full Width"/>-->
              <p>
             	 <label for="parent_id">Template : </label>
                 <select name="template" id="template"  class="sf">
                 <option value="Full Width" <?php if($details[0]['template']=='Full Width'){echo 'selected';} ?>>Full Width</option>
                 <option value="About Us" <?php if($details[0]['template']=='About Us'){echo 'selected';} ?>>About Us</option>
                 <option value="Why Join Us" <?php if($details[0]['template']=='Why Join Us'){echo 'selected';} ?>>Why Join Us</option>
                 </select>
              </p>
              <p>
                <label for="sort_order" >Sort Order: </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order'];?>" class="sf" />
              </p>
              
              
              <?php //if($details[0]['left_image']!=''){?>
              <!--<p><img src="<?php echo get_site_image('upload/pagebanner/left_image/thumb').$details[0]['left_image']; ?>" /></p>-->
              <?php // }?>
              
              <!--<p>
                <label for="location">Left Image(462 x 380) </label>
                <input type="file" name="left_image" id="left_image" value="<?php echo $details[0]['left_image'];?>">
              </p>-->
              
              
              
              
              <?php if($details[0]['image_name']!=''){?>
              <p><img src="<?php echo get_site_image('upload/pagebanner/thumb').$details[0]['image_name']; ?>" /></p>
              <?php }?>
              <?php //if($details[0]['id']!=1){?>
              <p>
                <label for="location">Banner (1400 X 350) </label>
                <input type="file" name="image_name" id="image_name" value="<?php echo $details[0]['image_name'];?>">
              </p>
              <?php //}?>  
              <!--<p>
                <label for="banner_heading" >Baner Heading</label>
                <textarea name="banner_heading" id="banner_heading"><?php //echo $details[0]['banner_heading'];?></textarea>
              </p> -->  
              <?php //if($details[0]['id']!=4 && $details[0]['id']!=8 && $details[0]['id']!=19){?>        
              <label for="from_email" >Body Content </label>
              <div class="body">
                <textarea name="page_content" id="bodyContent"><?php echo $details[0]['page_content'];?>
                                </textarea>
              </div>
              <?php //}?> 
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
                <button type="submit" value="update_form" name="update_form" onClick="return cms_form_valid();">Submit</button>
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
</div>
</body>
</html>