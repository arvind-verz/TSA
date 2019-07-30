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
                    
         <?php echo form_open_multipart('admin/system-settings/update'); ?>
            <div class="box-body">
              <div class="form-group">
                <label for="page_heading" >From Email</label>
                <input name="from_email" class="form-control" value="<?=$settings->from_email?>">
              </div>
               <div class="form-group">
                <label for="page_heading" >Inquiry Email</label>
                <input name="inquiry_email" onkeypress="this.value=removeSpaces(this.value);" class="form-control" value="<?=$settings->inquiry_email?>">
                <p><strong>Note:</strong> Add multiple email id separated by comma(,).</p>
              </div>
               <div class="form-group">
                <label for="page_heading" >Facebook Link</label>
                <input name="facebook_link" class="form-control" value="<?=$settings->facebook_link?>">
              </div>
               <div class="form-group">
                <label for="page_heading" >Instagram Link</label>
                <input name="instagram_link" class="form-control" value="<?=$settings->instagram_link?>">
              </div>
              
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          <?php echo form_close(); ?>
            </div>
            </div>
        </div>
    </section>
</div>
<script>
function removeSpaces(string) {
 return string.split(' ').join('');
}
</script>