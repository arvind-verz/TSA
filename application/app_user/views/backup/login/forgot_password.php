<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"><a href="<?php echo base_url('/'); ?>" class="home"></a><a class="diable">Forgot Password</a></div>
        <div class="clear"></div>
        <div class="contact_form">
          <h1 class="page_title">Forgot Password</h1>
          <div class="comment_form">
            <form id="loginform" action="" method="post" autocomplete="off">
              <div class="form"> <span class="field_name">Email ID <span class="req">*</span></span>
                <input type="email" name="email" required id="email">
              </div>
              <div class="form"><a href="<?php echo base_url('login');?>">Login?</a>
                <button name="submit" type="submit">Get Password</button>
              </div>
            </form>
          </div>
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