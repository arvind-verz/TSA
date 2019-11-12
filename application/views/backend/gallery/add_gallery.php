<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>

    <?php $this->load->view('backend/include/messages') ?>
    
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
            <?php echo form_open_multipart('admin/add-gallery'); ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Title : <span>*</span></label>
                  <input type="text" name="title" required id="title" value="<?php echo set_value('title'); ?>" class="form-control" />
                </div>
                <div class="form-group">
                  <label for="location">Content :</label>
                  <textarea rows="4" cols="60" class="form-control" name="content" id="smallBody" ><?php echo set_value('content'); ?></textarea>
                </div>
               <div class="form-group">
                  <label for="location">Pics : <span>*</span></label>
                  <input type="file" name="gallery" class="form-control" required id="image_name">
                  <p><strong>Note:</strong> Preferred Image Dimension Width:600, Height:400 or  Width:6000, Height:4000 or same ratio (W:H=3:2)</p>
                </div>
               <div class="form-group">
                  <label for="name">Featured :</label>
                  <input type="checkbox" name="featured" <?php if(set_value('featured')==1){?>checked="checked"<?php }?>  id="featured" value="1" />
                </div>
                <div class="form-group">
                  <label for="name">Sort Order :</label>
                  <input type="text" name="sort_order"  id="sort_order" value="<?php echo set_value('sort_order'); ?>" class="form-control" />
                </div>
                <div class="form-group">
                  <label for="status">Status : <span>*</span></label>
                  <label for="status" style="text-align:left;">Enable
                    <input type="radio" name="status" required value="1" <?php if ((set_value('status') && set_value('status')==1) || (!set_value('status'))){echo 'checked="checked"';}?>>
                  </label>
                  <label for="status" style="text-align:left;">Disable
                    <input type="radio" name="status" required <?php if (set_value('status') && set_value('status')==0){echo 'checked="checked"';}?> value="0" >
                  </label>
                </div>
                <div class="form-group">
								<a href="<?php echo site_url('admin/manage-gallery'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                  <button type="submit" value="update_form" name="update_form" class="btn btn-info pull-right" onClick="return banner_form_valid();">Submit</button>
                </div>
              </div>
            <?php echo form_close(); ?>
                          </div>
            </div>
        </div>
    </section>
</div>
