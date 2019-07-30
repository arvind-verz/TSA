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
            <?php echo form_open_multipart('admin/edit-gallery/'.$details[0]['id']); ?>
             <div class="box-body">
                <div class="form-group">
                  <label for="name">Title : <span>*</span></label>
                  <input type="text" name="title" id="title" required value="<?php echo $details[0]['title'];?>" class="form-control" />
                </div>
                <div class="form-group">
                  <label for="location">Content :</label>
                  <textarea rows="4" class="form-control" cols="90" name="content" id="smallBody" ><?php echo $details[0]['content'];?></textarea>
                </div>
                <?php if($details[0]['image_name']!=""):?>
                <p><img src="<?php echo base_url('assets/files/gallery/thumb-').$details[0]['image_name']; ?>" width="100px" /></p>
                <?php endif;?>
                <input type="hidden" name="gallery_exist" value="<?php echo $details[0]['image_name']; ?>">
                <div class="form-group">
                  <label for="location">Pics : <span>*</span></label>
                  <input type="file" name="gallery" id="image_name" value="<?php echo $details[0]['image_name'];?>">
                  <p><strong>Note:</strong> Preferred Image Dimension Width:600, Height:400 or  Width:6000, Height:4000 or same ratio (W:H=3:2)</p>
                </div>
                <div class="form-group">
                  <label for="name">Sort Order :</label>
                  <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order'];?>" class="form-control" />
                </div>
                <div class="form-group">
                  <label for="status">Status : <span>*</span> </label>
                  <label for="status" style="text-align:left;">Enable
                    <input type="radio" name="status" required value="1" <?php if($details[0]['status']=='1'){ echo 'checked="checked"';}?>>
                  </label>
                  <label for="status" style="text-align:left;">Disable
                    <input type="radio" name="status" required value="0" <?php if($details[0]['status']=='0'){ echo 'checked="checked"';}?>>
                  </label>
                </div>
                <div class="form-group">
                  <button type="submit" value="update_form" name="update_form" class="btn btn-info pull-right" onClick="return banner_form_valid();">Submit</button>
                </div>
              </div>
            </form>
     </div>
            </div>
        </div>
    </section>
</div>