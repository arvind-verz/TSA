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
		error: function(xhr, ajaxOptions, thrownError){
			alert(thrownError);
		}	
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
<header class="header-wrap">
<div class="heder-top">
<div class="container">
<div class="heder-top-inner clear-fix">
<div class="call-us">
<span><i class="fa fa-phone" aria-hidden="true"></i>Call Us</span><?php echo $this->all_function->get_site_options('cantact_no');?>
</div>
<div class="Locate-us">
<span><i class="fa fa-map-marker" aria-hidden="true"></i>Locate Us</span><?php echo $this->all_function->get_site_options('site_address1');?>
</div>
<div class="Operating-us">
<span><i class="fa fa-clock-o" aria-hidden="true"></i>Operating Hours</span> <?php echo $this->all_function->get_site_options('operating_hours');?>
</div>
<span class="click-search"><i class="fa fa-search"></i></span>



</div>
<div class="search-wrap">
<form name="search" id="search" method="post" action="<?php echo base_url('search'); ?>">
<div class="search-field">
                  <input type="text" placeholder="Search for keywords & products" onblur="if(this.placeholder=='')this.placeholder='Search for keywords & products';" onfocus="if(this.placeholder=='Search for keywords & products')this.placeholder='';" name="key" required="required">
                  <button type="submit"><span>GO</span></button>
                </div>
</form>                
   </div>             
                
                
</div>
</div>
<div class="nav-wrap">
<div class="container">
<div class="navInner">
<figure><a href="<?php echo base_url('/'); ?>"><img src="<?php echo base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo'));?>" alt=""></a></figure>
<div class="nav-main clear-fix">
<?php $this->load->view('include/menu'); ?>
</div>
<span class="top-cart">
<?php $cartItem = $this->session->userdata('cart'); if(!empty($cartItem)){$countCartItem = count($cartItem);}else{$countCartItem = 0;}?>
<a href="<?php echo base_url('cart-enquiry');?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="cart-count" id="itemCount"><?php echo $countCartItem;?></span></a>
</span>

</div>
</div>
</div>
</header>
