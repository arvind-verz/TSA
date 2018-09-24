<?php $this->load->view('include/header_tag'); ?>

<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
    <li><a>Join Us</a></li>
    <li><a href="<?php echo base_url('manage-our-member'); ?>">Our Member</a></li>
    <li>Manage Our Member</li>
  </ul>
  <div class="gridMainbodyDiv">
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Edit Our Member</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              <p>
                <label for="product_specifications">Full Corporate(A-L): <span>*</span></label>
              <div class="body">
                <textarea name="full_corporate1" id="bodyContent2" required><?php echo $details[0]['full_corporate1']; ?></textarea>
              </div>
              </p>
              <p>
                <label for="product_specifications">Full Corporate(M-Z): <span>*</span></label>
              <div class="body">
                <textarea name="full_corporate2" id="bodyContent2" required><?php echo $details[0]['full_corporate2']; ?></textarea>
              </div>
              </p>
              <p>
                <label for="product_specifications">Associate Corporate(A-L): <span>*</span></label>
              <div class="body">
                <textarea name="associate_corporate1" id="bodyContent2" required><?php echo $details[0]['associate_corporate1']; ?></textarea>
              </div>
              </p>
              <p>
                <label for="product_specifications">Associate Corporate(M-Z): <span>*</span></label>
              <div class="body">
                <textarea name="associate_corporate2" id="bodyContent2" required><?php echo $details[0]['associate_corporate2']; ?></textarea>
              </div>
              </p>
              <p>
                <label for="product_specifications">Associate Individual: <span>*</span></label>
              <div class="body">
                <textarea name="associate_individual" id="bodyContent2" required><?php echo $details[0]['associate_individual']; ?></textarea>
              </div>
              </p>
              <p>
                <label for="product_specifications">Others: <span>*</span></label>
              <div class="body">
                <textarea name="others" id="bodyContent2" required><?php echo $details[0]['others']; ?></textarea>
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