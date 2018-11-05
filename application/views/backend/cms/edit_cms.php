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
          <?php echo form_open_multipart('admin/edit-cms/'.$cms_id); ?>
            <div class="box-body">
              <div class="form-group">
                <label for="page_heading" >Page Title  : <span>*</span></label>
                <input type="text" name="page_heading" required id="page_heading" value="<?php echo $details[0]['page_heading'];?>"  class="form-control" />
              </div>
              <?php if($details[0]['url_not_editable']==1){?>
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
                <input type="text" name="url_name" required id="url_name" value="<?php echo $details[0]['url_name'];?>"  class="form-control" />
              </div>
              <?php }else{?>
              <div class="form-group">
                <label for="url_name" >URL  : <span>*</span> </label>
                <input type="text" name="url_name" readonly id="url_name" value="<?php echo $details[0]['url_name'];?>" class="sf readonly" />
              </div>
              <?php }?>

              <div class="form-group">
             	 <label for="parent_id">Template : </label>
                 <select name="template" id="template"   class="form-control">
                 <option value="Full Width" <?php if($details[0]['template']=='Full Width'){echo 'selected';} ?>>Full Width</option>
                 <option value="About Us" <?php if($details[0]['template']=='About Us'){echo 'selected';} ?>>About Us</option>
                 <option value="Subject" <?php if($details[0]['template']=='Subject'){echo 'selected';} ?>>Subject</option>
                 </select>
              </div>
              <div class="form-group">
                <label for="sort_order" >Sort Order: </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order'];?>"  class="form-control" />
              </div>
               <div class="form-group" id="subject" style=" <?php if($details[0]['template']!='Subject') echo 'display:none;"';?>>
             	 <label for="subject">Subject : </label>
                 <select name="subject_id" id="subject_id"  class="form-control">
                 <?php foreach($subjects as $subject){?>
                     <option value="<?php echo $subject['subject_id'];?>" <?php if($details[0]['subject_id']==$subject['subject_id']){echo 'selected';} ?>><?php echo $subject['subject_name'];?></option>
                 <?php }?>
                 </select>
              </div>
              
            <?php if($details[0]['image_name']!=''){?>
              <p><img src="<?php echo base_url().'assets/upload/pagebanner/thumb/'.$details[0]['image_name']; ?>" /></p>
              <?php }?>
              <?php //if($details[0]['id']!=1){?>
              <div class="form-group">
                <label for="location">Banner (1400 X 350) </label>
                <input type="file" name="image_name" id="image_name" value="<?php echo $details[0]['image_name'];?>">
              </div>
              <?php //}?>  
              <div class="form-group">
                <label for="banner_heading" >Other Content</label>
                <textarea name="banner_heading" id="banner_heading" class="form-control"><?php echo $details[0]['banner_heading'];?></textarea>
              </div>   
              <?php //if($details[0]['id']!=4 && $details[0]['id']!=8 && $details[0]['id']!=19){?>        
              <label for="from_email" >Body Content </label>
              <div class="body">
                <textarea name="page_content" class="form-control" id="bodyContent"><?php echo $details[0]['page_content'];?>
                                </textarea>
              </div>
              <?php //}?> 
              <div class="form-group">
                <?php $status = $details[0]['status'];?>
                <label for="status">Status </label>
                <label for="status" style="text-align:left;">Enable
                  <input type="radio" name="status" value="Y" <?php if($status=='Y'){ echo 'checked="checked"';}?>>
                </label>
                <label for="status" style="text-align:left;">Disable
                  <input type="radio" name="status" value="N" <?php if($status=='N'){ echo 'checked="checked"';}?>>
                </label>
              </div>
              <div class="clear"></div>
              <h3>SEO Details</h3>
              <div class="form-group">
                <label for="seo_title" >Title </label>
                <input type="text" name="seo_title"  id="seo_title" value="<?php echo $details[0]['seo_title'];?>"  class="form-control" />
              </div>
              <div class="form-group">
                <label for="seo_keyword" >Keyword </label>
                <textarea name="seo_keyword" class="form-control" id="seo_keyword"><?php echo $details[0]['seo_keyword'];?></textarea>
              </div>
              <div class="form-group">
                <label for="seo_description" >Description</label>
                <textarea name="seo_description" class="form-control" id="seo_description"><?php echo $details[0]['seo_description'];?></textarea>
              </div>
              </div>
            <div class="box-footer">
                <button class="btn btn-info" type="reset" >Cancel</button>
                <button type="submit" class="btn btn-info pull-right" value="update_form" name="update_form" onClick="return cms_form_valid();">Submit</button>
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
		{
		$('#subject').css('display','block');
		}
	});
});
</script>