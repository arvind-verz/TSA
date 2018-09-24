<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
       <li><a href="<?php echo base_url('manage-parts'); ?>">Parts Management</a></li>
        <li>Edit Parts</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Edit Parts</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              <p>
                <label for="office_name" >Title  : <span>*</span></label>
                <input type="text" name="name" required id="name" value="<?php echo $details[0]['name'];?>" class="sf" />
              </p>
              <p>
                  <label for="location">Pdf  : </label>
                  <input type="file" name="pdf_name"  id="pdf_name">
                  <input type="hidden" name="old_pdf_name" value="<?php echo $details[0]['pdf_name']; ?>">
                </p>
                <p><?php echo $details[0]['pdf_name']; ?></p>
              <p>
                <label for="sort_order" >Sort Order: </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order'];?>" class="sf" />
              </p>              
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