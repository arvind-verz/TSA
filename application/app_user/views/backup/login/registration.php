<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"><a href="<?php echo base_url('/'); ?>" class="home"></a><a class="diable">Registration</a></div>
        <div class="clear"></div>
        <div class="contact_form">
          <h1 class="page_title">Registration</h1>
          <div class="comment_form">
            <form name="contact" id="contact" method="post" action="<?php echo base_url('contact-us'); ?>">
              <div class="form"> <span class="field_name">First Name <span class="req">*</span></span>
                <input type="text" name="first_name" required pattern="^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$" value="<?php echo set_value('first_name'); ?>" id="first_name">
              </div>
              <div class="error"><?php echo form_error('first_name'); ?></div>
              <div class="form"> <span class="field_name">Last Name <span class="req">*</span></span>
                <input type="text" name="last_name" required pattern="^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$" value="<?php echo set_value('last_name'); ?>" id="last_name">
              </div>
              <div class="error"><?php echo form_error('last_name'); ?></div>
              <input type="hidden" name="user_type" value="Employers">
              <!--<div class="form"> <span class="field_name">Telephone <span class="req">*</span></span>
                <input type="tel" pattern="[0-9]{8,12}" name="telephone" required value="<?php echo set_value('telephone'); ?>" id="telephone">
              </div>
              <div class="error"><?php echo form_error('telephone'); ?></div>-->
              <div class="form"> <span class="field_name">Email :<span class="req">*</span></span>
                <input type="email" name="email" required pattern="^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$"  value="<?php echo set_value('email'); ?>" id="email">
              </div>
              <div class="error"><?php echo form_error('email'); ?></div>
              <div class="form"> <span class="field_name">Password <span class="req">*</span></span>
                <input type="password" name="password" required id="password">
              </div>
              <div class="error"><?php echo form_error('password'); ?></div>
              <div class="form"> <span class="field_name">Confirm Password <span class="req">*</span></span>
                <input type="password" name="confirm_password" required id="confirm_password">
              </div>
              <div class="error"><?php echo form_error('confirm_password'); ?></div>
              <div class="form"> <span class="field_name">Captcha </span>
                <div class="captcha"><?php echo $widget;?><?php echo $script;?></div>
              </div>
              <button type="submit" name="submit" >submit</button>
            </form>
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