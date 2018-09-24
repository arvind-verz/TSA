<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Tools</a></li>
        <li><a href="<?php echo base_url('manage-tools-products'); ?>">Product</a></li>
        <li><a href="<?php echo base_url('manage-video/'.$product_id); ?>">Manage Video</a></li>
        <li>Add Video</li>
  </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Add Video <a class="button" href="<?php echo base_url('manage-video/'.$product_id); ?>"><span>Back</span></a></h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <form method="post" action="" id="add_values" enctype="multipart/form-data">
              <div class="form_default">
                <p>
                  <label for="products_options_values_name" >Title  : <span>*</span></label>
                  <input type="text" name="title" required id="title" value="" class="sf" />
                </p>
                
                <p>
                  <label for="products_options_values_name" >URL  : <span>*</span></label>
                  <input type="text" name="url" required id="url" value="" class="sf" />
                </p>
                
                <p>
                  <button type="reset" >Cancel</button>
                  <button type="submit" value="add_video" name="add_video">Submit</button>
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