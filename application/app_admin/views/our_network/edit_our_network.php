<?php $this->load->view('include/header_tag'); ?>
<body>

<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Resources</a></li>
        <li><a href="<?php echo base_url('manage-our-network'); ?>">Our Network</a></li>
        <li>Manage Our Network</li>
    </ul>
    
  <div class="gridMainbodyDiv">
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Edit Our Network</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              <p>
                <label for="office_name" >Name  : <span>*</span></label>
                <input type="text" name="name" required id="name" value="<?php echo $details[0]['name'];?>" class="sf" />
              </p>
              
              
              
              <p>
              <label for="product_specifications">Descriptions: <span>*</span></label>
             <div class="body">
              <textarea name="description" id="bodyContent2" required><?php echo $details[0]['description']; ?></textarea>
             </div>
            </p>
              
              
              
                           
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