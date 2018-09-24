<?php 
	$user_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
	$user_name = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_name'];
	$user_id = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_id'];
?>

<header id="header">
  <div class="logoDiv fl"> <a href="<?php echo base_url('dashboard'); ?>"><img src="<?php echo get_site_image('upload/logo/thumb').$this->all_function->get_site_options('logo','image_name');?>"/></a> </div>
<?php   $ss = $this->load->library('session'); 
		$user_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		$user_name = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_name'];
		$user_id = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_id'];
		$login_date =  $this->all_function->get_last_login_details($user_id);
		$login_ip =  $this->all_function->get_last_login_ip($user_id);
?>
 
<div class="rightPanel">
	<div class="userTypeTop"><h1 class="userType"><?php echo $user_type;?></h1></div>
    <?php $user_email = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_email'];?>
    <div class="loginBoxTop">
    <span>Welcome </span><?php echo $user_name;?>    <a href="<?php echo base_url('edit-profile').'/'.$user_id; ?>">Edit Profile</a>
    <br/><span>Last logged: </span><span><?php echo date('jS M Y h:i:s A', strtotime($login_date));?> </span>
    <br/><span>IP Address: </span><span><?php echo $login_ip;?> </span>
    </div>
</div>
</header>
<?php 
if($this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type']=='Super Administrator'){
	$this->load->view('include/menu_super_admin'); 
}elseif($this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type']=='Administrator'){
	$this->load->view('include/menu_admin'); 
}elseif($this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type']=='Blog'){
	$this->load->view('include/menu_blog'); 
}else{
	$this->load->view('include/menu_blog'); 
}

?>