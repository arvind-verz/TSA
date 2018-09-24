<script>
function remove_item(timeID) {
	jQuery.ajax({
				type: "POST",
				dataType: "html",
				url: "<?php echo base_url('ajax-remove-cart-item'); ?>",
				data: {timeID  : timeID},
				success: function(data) { 
				get_cart_item();
				jQuery( '#cart_'+timeID ).fadeOut( "slow" );
				 },
				error: function(xhr, ajaxOptions, thrownError) {alert(thrownError);}
	});				   
}
function get_cart_item() {
	
	jQuery.ajax({
				type: "POST",
				dataType: "html",
				url: "<?php echo base_url('ajax-count-enquiry-item'); ?>",
				success: function(data) {  
				jQuery('span#itemCount').html('').append(data);
				if(data==0){ location.reload(); }
				},
				error: function(xhr, ajaxOptions, thrownError) {}
	});			
}

</script>

<header class="header_wrap">
  <div class="center">
    <section class="header">
      <figure><a href="<?php echo base_url('/'); ?>"><img src="<?php echo base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo'));?>" alt=""/></a></figure>
      <div class="search_top">
        <form name="search" id="search" method="post" action="<?php echo base_url('search'); ?>">
          <label for="key">&nbsp;</label>
          <input type="text" id="key" value="<?php if(isset($key)){echo $key;}?>" name="key">
          <button type="submit" onClick="return search_valid();">Go</button>
        </form>
      </div>
    </section>
  </div>
  <section class="top_nav">
    <div class="center">
      <?php $this->load->view('include/menu'); ?>
      <div class="top_cart">
        <?php $cartItem = $this->session->userdata('cart'); 
if(!empty($cartItem)){$countCartItem = count($cartItem);}else{$countCartItem = 0;}?>
        <a href="<?php echo base_url('cart-enquiry');?>">my enquiry (<span id="itemCount"><?php echo $countCartItem;?></span>)</a> </div>
      <div class="top_login">
        <?php if(isset($this->session->userdata[USER_LOGIN_PREFIX.'member_id']) && $this->session->userdata[USER_LOGIN_PREFIX.'member_id']!='')
	{$user_id = $this->session->userdata[USER_LOGIN_PREFIX.'member_id'];?>
        <a href="<?php echo base_url('my-profile');?>"> My Profile</a> <a href="<?php echo base_url('logout');?>"> Log Out </a>
        <?php  }else{?>
        <a href="<?php echo base_url('registration');?>"> Registration </a> <a href="<?php echo base_url('login');?>"> Log In </a>
        <?php  }?>
      </div>
    </div>
  </section>
</header>
