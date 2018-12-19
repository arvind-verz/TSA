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
                    
         <?php echo form_open_multipart('admin/manage-footer/update'); ?>
            <div class="box-body">
              <div class="form-group">
                <label for="page_heading" >Footer Content</label>
                <textarea name="footer_content" class="form-control" id="bodyContent"><?php echo $footer->content; ?></textarea>
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
