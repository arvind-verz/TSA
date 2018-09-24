<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="childpage">
  <?php $this->load->view('include/header'); ?>
  <div class="mainchild">
    <div class="container maincontent">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li><a href="<?php echo base_url('svca-events'); ?>">SVCA EVENTS </a></li>
        <li><a href="<?php echo base_url('event-details/'.$page[0]['seo_url']); ?>"><?php echo $page[0]['title'];?></a></li>
        <li class="active">Register</li>
      </ol>
      <h3 class="t-header-cnt"><?php echo $page[0]['title'];?></h3>
      <?php $this->load->view('include/message'); ?>
      <form name="contact" id="contact" method="post" action="<?php echo base_url('resgister/'.$page[0]['seo_url']); ?>">
        <div class="form-member">
          <div class="t-header-4"> YOUR MEMBERSHIP DETAILS </div>
          <div class="row">
            <div class="col-md-3">
              <label class="lb3">Member ID :</label>
            </div>
            <div class="col-md-6">
              <input type="type" name=""  value="<?php echo $this->session->userdata[USER_LOGIN_PREFIX.'user_name'];?>" disabled  class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <label class="lb3">Company Name :</label>
            </div>
            <div class="col-md-6">
              <input type="type" name=""  value="<?php echo $this->session->userdata[USER_LOGIN_PREFIX.'company_name'];?>"  disabled class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <label class="lb3">Business Sector  :</label>
            </div>
            <div class="col-md-6">
              <input type="type" name=""  value="<?php echo $this->session->userdata[USER_LOGIN_PREFIX.'company_type'];?>" disabled class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <label class="lb3">Company Email (Primary) :</label>
            </div>
            <div class="col-md-6">
              <input type="email" name=""  value="<?php echo $this->session->userdata[USER_LOGIN_PREFIX.'company_email'];?>" disabled class="form-control">
            </div>
          </div>
        </div>
        <?php if(isset($custom_msg)): ?>
		<div class="notification msgsuccess" style="background-image:none; background:#E7E7E7; width:100%; border-color:#c36d79"> <!--<a class="close"></a>-->
  		<p><?php echo $custom_msg; ?></p>
		</div>
		<?php endif; ?>
        <hr/>
        <div class="t-header-4"> INSERT YOUR PARTICULARS </div>
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
              <label class="lb3">Designation <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <input type="text" name="designation" value="<?php echo ($reset) ? "" : set_value('designation'); ?>" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Attendee's Email Address <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <input type="email" name="email" required value="<?php echo ($reset) ? "" : set_value('email'); ?>" class="form-control" >
              <!--<p class="note">Necessary to fill up, if you are not the company owner who signed for the membership.</p>-->
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Contact Number <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <input type="tel" name="phone_no" title="Only numerical values are accepted" pattern="[0-9]{8,12}" value="<?php echo ($reset) ? "" : set_value('phone_no'); ?>" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label class="lb3">Billing Address <span class="sys">*</span> :</label>
            </div>
            <div class="col-md-6">
              <textarea class="form-control" name="billing_address" placeholder="Please key in Full Address including Unit Number, Road/ Building Name and Postal Code where applicable" required><?php echo ($reset) ? "" : set_value('billing_address'); ?></textarea>
              <!--<p class="note">Please key in Full Address including Unit Number, Road/ Building Name and Postal Code where applicable</p>-->
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
          <div class="t-header-4">PAYMENT</div>
          <div class="form-style1">
            <div class="row">
              <div class="col-md-2">
                <label class="lb3">Price :</label>
              </div>
              <div class="col-md-6">
                <div class="text-price">S$ <?php echo $price; ?></div>
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
              <?php }else{?>
              <input type="hidden" name="payment_type"  value="Offline" class="form-control" required>
              <?php }?>
            </div>
            <?php if($paypal=='Y'){?>
            <div class="show-from">
              <div class="row">
                <div class="col-md-2">
                  <label class="lb3">Offline Payment Comment :</label>
                </div>
                <div class="col-md-6">
                  <textarea class="form-control text-1" placeholder="Please indicate your Payment Mode (Bank Transfer, TT, Giro, Cheque, Cash at SVCA Office)." name="offline_payment" id="offline_payment"><?php echo ($reset) ? "" : set_value('offline_payment'); ?></textarea>
                </div>
              </div>
            </div>
            <?php }else if($paypal=='N' && $price>0){?>
            <div class="row">
              <div class="col-md-2">
                <label class="lb3">Offline Payment Comment :</label>
              </div>
              <div class="col-md-6">
                <textarea class="form-control text-1" placeholder="Please indicate your Payment Mode (Bank Transfer, TT, Giro, Cheque, Cash at SVCA Office)." name="offline_payment"><?php echo ($reset) ? "" : set_value('offline_payment'); ?></textarea>
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
</body>
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
</html>