<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"><a href="<?php echo base_url('/'); ?>" class="home"></a><a class="diable">Change Password</a></div>
        <div class="clear"></div>
        <div class="listing_wrap">
          <?php $this->load->view('member/member_left'); ?>
          <div class="col_right">
            <div class="contact_form">
              <h1 class="page_title">Change Password</h1>
              <div class="comment_form">
                <form class="form-horizontal" role="form" action="" method="post"  enctype="multipart/form-data">
                  <div class="form"> <span class="field_name">Current Password :</span>
                    <input type="password" name="current_password" required id="current_password" autocomplete="off">
                  </div>
                  <div class="form"> <span class="field_name">New Password :</span>
                    <input type="password" name="new_password" required id="new_password" autocomplete="off">
                  </div>
                  <div class="form"> <span class="field_name">Confirm Password :</span>
                    <input type="password" name="confirm_password" required id="confirm_password" autocomplete="off">
                  </div>
                  <div class="form">
                    <button type="submit" name="member_login">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/footer'); ?>
</div>
</body>
</html>