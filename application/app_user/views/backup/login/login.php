<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"><a href="<?php echo base_url('/'); ?>" class="home"></a><a class="diable">Login</a></div>
        <div class="clear"></div>
        <div class="contact_form">
          <h1 class="page_title">Login</h1>
          <div class="comment_form">
            <form id="loginform" action="" method="post" autocomplete="off">
              <div class="form"> <span class="field_name">Email ID <span class="req">*</span></span>
                <input type="text" name="username" required value="<?php echo $username = isset($username) ? $username : ''; ?>" id="username">
              </div>
              <div class="form"> <span class="field_name">Password :</span>
                <input type="password" name="password" required value="<?php echo $password = isset($password) ? $password : ''; ?>" id="password">
              </div>
              <div class="form">
                <input type="checkbox" name="<?php echo USER_COOKIE;?>" value="1" class="uni-check" id="checkbox" <?php if(isset($_COOKIE[USER_COOKIE])) {echo 'checked="checked"';}else {echo '';}?> >
                <label for="remember">Remember me</label>
                <button type="submit" name="member_login" value="" >submit</button>
              </div>
            </form>
            <div class="rows"> <a href="<?php echo base_url('forgot-password');?>">Forgot Password?</a> </div>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/footer'); ?>
</div>
</body>
</html>