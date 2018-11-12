<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
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
                    
         <?php echo form_open('admin/add-cms'); ?>
            <div class="box-body">
              <div class="form-group">
                <label for="page_heading" >Page Title  : <span>*</span></label>
                <input type="text" name="page_heading" required id="page_heading" value="<?php echo set_value('page_heading'); ?>" class="form-control" />
              </div>
              <script>
								$(function() {
									$('#page_heading').change(function() {
										var page_heading = $.trim($('#page_heading').val()).toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
										$('#url_name').val(page_heading);
									});
								});
								</script>
              <div class="form-group">
                <label for="url_name" >URL  : <span>*</span> </label>
                <input type="text" name="url_name" required id="url_name" value="<?php echo set_value('url_name'); ?>" class="form-control" />
              </div>
              <div class="form-group">
                <label for="sort_order" >Sort Order: </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo set_value('sort_order'); ?>" class="form-control" />
              </div>
              <div class="form-group">
             	 <label for="parent_id">Template : </label>
                 <select name="template" id="template"  class="form-control">
                     <option value="Full Width" <?php if(set_value('template')=='Full Width'){echo 'selected';} ?>>Full Width</option>
                     <option value="About Us" <?php if(set_value('template')=='About Us'){echo 'selected';} ?>>About Us</option>
                     <option value="Subject" <?php if(set_value('template')=='Subject'){echo 'selected';} ?>>Subject</option>
                 </select>
              </div>
              
              <div class="form-group" id="subject" style="display:none;">
             	 <label for="subject">Subject : </label>
                 <select name="subject_id" id="subject_id"  class="form-control">
                 <option value="">Choose Subject</option>
                 <?php foreach($subjects as $subject){?>
                     <option value="<?php echo $subject['subject_id'];?>" <?php if(set_value('subject_id')==$subject['subject_id']){echo 'selected';} ?>><?php echo $subject['subject_name'];?></option>
                 <?php }?>
                 </select>
              </div>
              <!--<p>
                <label for="location">Left Image(462 x 380)</label>
                <input type="file" name="left_image" id="left_image">
              </p>-->
              
              
              <div class="form-group">
                <label for="location">Banner (1400 X 350) </label>
                <input type="file" name="image_name" id="image_name" value="">
              </div>
              <div class="form-group">
                <label for="banner_heading" >Other Content</label>
                <textarea class="form-control" name="banner_heading" id="banner_heading"><?php echo set_value('banner_heading'); ?></textarea>
              </div>
              <label for="from_email" >Body Content</label>
              <div class="body">
                <textarea class="form-control" name="page_content" id="bodyContent"><?php echo set_value('page_content'); ?></textarea>
              </div>
              <div class="form-group">
                <label for="status">Status  : <span>*</span></label>
                <label for="status" style="text-align:left;">Enable
                  <input type="radio" name="status" required value="Y" <?php if ((set_value('status') && set_value('status')=='Y') || (!set_value('status'))){echo 'checked="checked"';}?>>
                </label>
                <label for="status" style="text-align:left;">Disable
                  <input type="radio" name="status" required value="N" <?php if (set_value('status') && set_value('status')=='N'){echo 'checked="checked"';}?> >
                </label>
              </div>
              <div class="clear"></div>
              <h3>SEO Details</h3>
              <div class="form-group">
                <label for="seo_title" >Title </label>
                <input type="text" name="seo_title"  id="seo_title" value="<?php echo set_value('seo_title'); ?>" class="form-control" />
              </div>
              <div class="form-group">
                <label for="seo_keyword" >Keyword </label>
                <textarea class="form-control" name="seo_keyword" id="seo_keyword"><?php echo set_value('seo_keyword'); ?></textarea>
              </div>
              <div class="form-group">
                <label for="seo_description" >Description</label>
                <textarea class="form-control" name="seo_description" id="seo_description"><?php echo set_value('seo_description'); ?></textarea>
              </div>
              </div>
            <div class="box-footer">
              <div class="form-group">
                <button class="btn btn-info" type="reset" >Cancel</button>
                <button type="submit" class="btn btn-info pull-right" value="update_form" name="update_form" onClick="return cms_form_valid();">Submit</button>
              </div>
            </div>
          <?php echo form_close(); ?>
</div>
            </div>
        </div>
    </section>
</div>

<script>
$(function() {
	$('#template').change(function() {
		var result=$(this).val();
		if(result=='Subject')
			$('#subject').css('display','block');
		else
			$('#subject').css('display','none');
		
	});
});
</script>
