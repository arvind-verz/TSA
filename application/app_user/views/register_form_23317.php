<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="childpage">
  <?php $this->load->view('include/header'); ?>
  <div class="mainchild">
    <div class="container maincontent">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li><a href="<?php echo base_url('svca-events'); ?>">SVCA EVENTS </a></li>
        <li><a href="<?php echo base_url('event-details/'.$page[0]['seo_url']); ?>"><?php echo $page[0]['title'];?> </a></li>
        <li class="active">Register</li>
      </ol>
      <h3 class="t-header-cnt"><?php echo $page[0]['title'];?></h3>
      <div class="t-header-4"> INSERT YOUR PARTICULARS </div>
      <?php $this->load->view('include/message'); ?>
      <form name="contact" id="contact" method="post" action="<?php echo base_url('resgister/'.$page[0]['seo_url']); ?>">
        <div class="form-style1">
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">First Name <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <input type="text" name="first_name" value="<?php echo ($reset) ? "" : set_value('first_name'); ?>" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Last Name <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <input type="text" name="last_name" value="<?php echo ($reset) ? "" : set_value('last_name'); ?>" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Company Name <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <input type="text" name="company_name"  value="<?php echo ($reset) ? "" : set_value('company_name'); ?>" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Designation <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <input type="text" name="designation"  value="<?php echo ($reset) ? "" : set_value('designation'); ?>" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Email <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <input type="email" name="email" value="<?php echo ($reset) ? "" : set_value('email'); ?>" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Contact Number <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <input type="number" name="phone_no"  value="<?php echo ($reset) ? "" : set_value('phone_no'); ?>" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Promo Code <br/>
                (for exclusive partners) :</label>
            </div>
            <div class="col-md-6">
              <input type="text" name="promo_code" id="promo_code" value="<?php if(isset($this->session->userdata[USER_LOGIN_PREFIX.'promo_code']) && $this->session->userdata[USER_LOGIN_PREFIX.'promo_code']!='' && $this->session->userdata[USER_LOGIN_PREFIX.'event_id']==$page[0]['id']){echo $this->session->userdata[USER_LOGIN_PREFIX.'promo_code'];} ?>" class="form-control" onBlur="add_promo_code();">
              <script>
						function add_promo_code() {
							var promo_code = jQuery('#promo_code').val();
							if(promo_code!=''){
								jQuery.ajax({
												type: "POST",
												dataType: "html",
												url: "<?php echo base_url('ajax-promo-code/'.$page[0]['id']); ?>",
												data: {promo_code  : promo_code},
												success: function(data) { 
													data = JSON.parse(data);
													jQuery('#price').empty().html(data.price).show('slow');
													jQuery('#newsletterInfo').html('').append(data.notification); 
													setTimeout(function(){jQuery('#newsletterInfo span').fadeOut();}, 1500);
													
												 },
												error: function(xhr, ajaxOptions, thrownError) {alert(thrownError);}
									});
							}else{
								jQuery('#newsletterInfo').html('<span class="error">Please enter your coupon code.</span>').append(); 
								setTimeout(function(){jQuery('#newsletterInfo span').fadeOut();}, 1500);
							}
						}
						</script>
              <style>
						#newsletterInfo{
							width:100%;
							margin-top:10px;
						}
						#newsletterInfo span{
							font-size: 14px;
							font-weight: bold;
							line-height:14px;
							float: left;
							text-align: left;
							width: 100%;
						}
						#newsletterInfo span.error {
							color: #c00;
						}
						#newsletterInfo span.send {
							color: #093;
						}
						
						</style>
              <div id="newsletterInfo"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Billing Address <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <textarea class="form-control" name="billing_address" required><?php echo ($reset) ? "" : set_value('billing_address'); ?></textarea>
              <p class="note">Please key in Full Address including Unit Number, Road/ Building Name and Postal Code where applicable</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Additional Comments :</label>
            </div>
            <div class="col-md-6">
              <textarea class="form-control text-1" name="comments"><?php echo ($reset) ? "" : set_value('comments'); ?></textarea>
            </div>
          </div>
        </div>
        <hr/>
        <div class="form-hiden">
          <div class="t-header-4"> CHOOSE YOUR PAYMENT GATEWAY </div>
          <div class="form-style1">
            <div class="row">
              <div class="col-md-2">
                <label class="lb3">Price :</label>
              </div>
              <div class="col-md-6">
                <div class="text-price">S$
                  <label id="price"><?php echo $price;?></label>
                </div>
                <input type="hidden" name="price"  value="<?php echo $price; ?>">
              </div>
            </div>
            <div class="row">
              <?php if($paypal=='Y' && $price>0){?>
              <div class="col-md-2">
                <label class="lb3">Choose Payment Type <span class="sys">*</span> :</label>
              </div>
              <div class="col-md-6">
                <select class="selectpicker" name="payment_type"  id='paypal-method' required>
                  <option value="">Select One</option>
                  <option value="Paypal" <?php if(($reset) ? "" : set_value('payment_type')=='Paypal'){echo 'selected';} ?> >Paypal</option>
                  <option value="Offline" <?php if(($reset) ? "" : set_value('payment_type')=='Offline'){echo 'selected';} ?>>Offline Payment (Cheque Payment / Bank Transfer)</option>
                </select>
              </div>
              <?php }elseif($paypal=='N' || $price==0){?>
              <input type="hidden" name="payment_type"  value="Offline" class="form-control" required>
              <?php }?>
            </div>
            <?php if($paypal=='Y'){?>
            <div class="show-from">
              <div class="row">
                <div class="col-md-2">
                  <label class="lb3">Offline Payment Comment <span class="sys">*</span> :</label>
                </div>
                <div class="col-md-6">
                  <textarea class="form-control text-1" name="offline_payment" id="offline_payment"><?php echo ($reset) ? "" : set_value('offline_payment'); ?></textarea>
                </div>
              </div>
            </div>
            <?php }else if($paypal=='N' && $price>0){?>
            <div class="row">
              <div class="col-md-2">
                <label class="lb3">Offline Payment Comment <span class="sys">*</span> :</label>
              </div>
              <div class="col-md-6">
                <textarea class="form-control text-1" name="offline_payment"><?php echo ($reset) ? "" : set_value('offline_payment'); ?></textarea>
              </div>
            </div>
            <?php }?>
            <?php if(set_value('payment_type')=='Offline'){?>
            <script>
			$(document).ready(function(){
			$(".show-from").show();
			});
			</script>
            <?php }?>
            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-6 text-right"> 
                <!--<a class="btn-sb-2" href="pdf/REGISTRATION.pdf" target="_blank">CONFIRM AND PROCEED</a>-->
                <button class="btn-sb-2" type="submit">CONFIRM AND PROCEED</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- //page -->
<?php $this->load->view('include/footer'); ?>
<?php echo js('jquery.min'); ?> <?php echo js('plugin'); ?> <?php echo js('main'); ?>
<script type="text/javascript">
$('#contact').each(function(i,k) {
	//console.log(k);
    this.reset();
});
</script>
<?php 
if(isset($_GET['sussecc'])){
	redirect(base_url("reg-thank-you"));
	exit();
}

?>
</body>
</html>