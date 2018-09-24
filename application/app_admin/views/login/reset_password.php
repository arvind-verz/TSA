<!doctype html>
<html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<!--<![endif]-->
<head>
<meta charset="utf-8">
<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!--<![endif]-->
<?php $this->load->view('include/meta'); ?>
<?php echo css('style_admin') ?><?php echo css('admin_style') ?>
<!--[if IE 9]>
<?php echo css('ie9') ?>
<![endif]-->
<!--[if IE 8]>
<?php echo css('ie8') ?>
<![endif]-->
<!--[if IE 7]>
<?php echo css('ie7') ?>
<![endif]-->
<?php echo js('jquery-1.11.1.min') ?>
<?php echo js_plugin('jquery-1.9.1.min.js') ?>
<?php echo css('reset') ?>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<script>
jQuery(document).ready(function(){
	jQuery("a.close").click(function() {
		jQuery('div.notification').hide();
	});	
<?php if(isset($password) && $password != ''){?>
		jQuery('.password').css({
				backgroundPosition: "0 -32px"
		});
<?php } ?>
});
</script>
<div class="Login_wrap"> <img src="<?php echo get_site_image('upload/logo/thumb').$this->all_function->get_site_options('logo','image_name');?>" alt="" class="Login_logo">
  <h1>Reset Password</h1>
  <div class="Login_from">
    <?php $this->load->view('include/message'); ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <td width="75%"><form id="loginform" action="" method="post" autocomplete="off">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" align="left" valign="middle" height="4"><img src="<?php echo image('spacer.gif');?>" alt=""></td>
              </tr>
              <tr>
                <td align="left" valign="middle">Password <span class="req">*</span></td>
                <td align="left" valign="middle"><input type="password" name="password" class="password" id="textfield2" required pattern="^\S{6,}$" onChange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.confirm_password.pattern = this.value;"/></td>
              </tr>
              <tr>
                <td colspan="2" align="left" valign="middle" height="4"><img src="<?php echo image('spacer.gif');?>" alt=""></td>
              </tr>
              <tr>
                <td align="left" valign="middle">Confirm Password <span class="req">*</span></td>
                <td align="left" valign="middle"><input type="password" name="confirm_password" class="password" id="textfield2" required pattern="^\S{6,}$" onChange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" /></td>
              </tr>
              <tr>
                <td colspan="2" align="left" valign="middle" height="4"><img src="<?php echo image('spacer.gif');?>" alt=""></td>
              </tr>
              <tr>
                <td align="left" valign="middle">&nbsp;</td>
                <td align="left" valign="middle"><button name="admin_login" class="admin_login" value="admin_login">Change Password</button></td>
              </tr>
            </table>
          </form></td>
        <td align="center" valign="top"><img src="<?php echo image('secure.png');?>"><br/>
          <a href="<?php echo base_url('/'); ?>" class="login">Login Here</a></td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>