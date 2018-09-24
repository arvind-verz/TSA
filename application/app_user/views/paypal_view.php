<p>Please Wait. You Are redirecting to paypal.....</p>
<?php 
$paypal_email = $this->all_function->get_site_options('paypal_email');
$paypal_live = $this->all_function->get_site_options('paypal_live');
$event_registration_info = $this->Register_model->get_event_registration_detail($event_reg_id);
$event_info = $this->Register_model->get_event_details_by_id($event_registration_info['event_id']);
if(count($event_registration_info)==0){
	redirect(base_url("cancel"));
}else{
?>
<?php if($paypal_live=='0'){?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="paypal">
<?php }?>
<?php if($paypal_live=='1'){?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="paypal">
<!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypal">-->
  <?php }?>
  <input type="hidden" value="_cart" name="cmd">
  <input type="hidden" value="1" name="upload">
  <input type="hidden" value="amitjha.vision-facilitator@gmail.com" name="business">
  <!--<input type="hidden" value="<?php echo $paypal_email; ?>" name="business">-->
  <input type="hidden" value="<?php echo $event_info['title'];?>" name="item_name_1">
  <input type="hidden" value="<?php echo $event_registration_info['price'];?>" name="amount_1">
  <input type="hidden" value="SGD" name="currency_code">
  <input type="hidden" value="<?php echo $event_registration_info['first_name'];?>" name="first_name">
  <input type="hidden" value="<?php echo $event_registration_info['last_name'];?>" name="last_name">
  <input type="hidden" value="<?php echo $event_registration_info['company_email'];?>" name="email">
  <input type="hidden" value="<?php echo $event_registration_info['phone_no'];?>" name="night_phone_a">
  <input type="hidden" value="<?php echo $event_registration_info['billing_address'];?>" name="address1">
  <input type="hidden" value="2" name="rm">
  <input type="hidden" value="1" name="no_note">
  <input type="hidden" value="utf-8" name="charset">
  <input type="hidden" value="<?php echo base_url('success');?>" name="return">
  <input type="hidden" value="<?php echo base_url('payment_complete.php?reg_id='.$event_reg_id.'&event_id='.$event_registration_info['event_id']);?>" name="notify_url">
  <input type="hidden" value="<?php echo base_url('cancel');?>" name="cancel_return">
  <input type="hidden" value="authorization" name="paymentaction">
  <input type="hidden" value="<?php echo base_url('assets/images/logo.png');?>" name="cpp_header_image">
  <input type="hidden" value="<?php echo base_url('assets/images/logo.png');?>" name="image_url">
  <input type="hidden" value="<?php echo $event_reg_id;?>" name="custom">
</form>
<script language="javascript" type="text/javascript">
		document.paypal.submit();
		document.forms['frm1'].submit();
</script>
<?php }?>
