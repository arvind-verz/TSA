<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Resources</a></li>
        <li><a href="<?php echo base_url('manage-toolkit');?>">Toolkit</a></li>
        <li>Add Toolkit</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Add Toolkit</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              <p>
                <label for="office_name" >Name  : <span>*</span></label>
                <input type="text" name="name" required id="name" value="<?php echo set_value('name'); ?>" class="sf" />
              </p>
            <p>
                  <label for="location">Image(72x106)  : </label>
                  <input type="file" name="image_name"  id="image_name">
              </p>
              
              <p>
                  <label for="location">PDF  : <span>*</span></label>
                  <input type="file" name="pdf_name"  id="pdf_name" required>
              </p>
            
            <p>
                  <label for="post_date">Post Date : <span>*</span></label>
                  <input type="text" name="post_date" required id="post_date" value="<?php echo set_value('post_date'); ?>" class="sf" />
                </p>
              <p>
                <label for="sort_order" >Sort Order: </label>
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
              <div class="clear"></div>
              
             
            
              
              
              <p>
                <button type="reset" >Cancel</button>
                <button type="submit" value="update_form" name="update_form" >Submit</button>
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