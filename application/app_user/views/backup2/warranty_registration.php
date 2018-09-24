<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>

<div class="wrap-bred">
<div class="container"><div class="bred-camb"><a href="<?php echo base_url('/');?>">HOME</a><span class="seprster ">/</span>
WARRANTY REGISTRATION FORM</div>


</div>
</div>

<div class="body-inner">
<div class="container">
<div class=" clear-fix">
<div class="warr-top">
<!--<h3>This warranty does not apply where :</h3>
<ul>
<li>Repairs have been made or attempted by others</li>
<li>Repairs are required because of normal wear and tear</li>
<li>The tool has been abused, misused or improperly maintained</li>
<li>Alterations have been made to the tool</li>
</ul>-->
<?php echo $page[0]['page_content'];?>
</div>
<?php $this->load->view('include/message'); ?>
<form name="registration" id="registration" method="post" action="<?php echo base_url('warranty-registration-form'); ?>">
<div class="warr-from clear-fix">
<div class="warr-left">

<div class="from-row clear-fix">
<span class="level">NAME <span class="req">*</span></span>
<input type="text" class="input-text" name="name" value="<?php echo set_value('name'); ?>" required>
</div>
<div class="from-row clear-fix">
<span class="level">address<!--<span class="req">*</span>--></span>
<input type="text" class="input-text" name="address" value="<?php echo set_value('address'); ?>">
</div>
<div class="from-row clear-fix">
<span class="level">MOBILE NO.<span class="req">*</span></span>
<input type="tel" class="input-text" name="mobile_no" value="<?php echo set_value('mobile_no'); ?>" required>
</div>
<div class="from-row clear-fix">
<span class="level">DEALER NAME</span>
<input type="text" class="input-text" name="dealer_name" value="<?php echo set_value('dealer_name'); ?>">
</div>
<div class="from-row have-q clear-fix">
<span class="level">MODEL<span class="req">*</span></span>
<input type="text" class="input-text" name="model" value="<?php echo set_value('model'); ?>" required><i id="model"></i>
<div class="model"><img src="<?php echo image('model.jpg');?>"><span class="close-02"></span></div>
</div>




</div>
<div class="warr-left">
<div class="from-row clear-fix">
<span class="level">email<span class="req">*</span></span>
<input type="email" class="input-text" name="email" value="<?php echo set_value('email'); ?>" required>
</div>
<div class="from-row clear-fix">
<span class="level">DATE OF PURCHASE<span class="req">*</span></span>
<input type="text" class="input-text" name="date_of_purchase" value="<?php echo set_value('date_of_purchase'); ?>" required id="date_of_purchase" readonly>
</div>
   

<div class="from-row have-q  clear-fix">
<span class="level">SERIAL NO.<span class="req">*</span></span>
<input type="text" class="input-text" name="serial_no" value="<?php echo set_value('serial_no'); ?>" required><i id="serial"></i>
<div class="serial"><img src="<?php echo image('serial.jpg');?>" alt=""><span class="close-01"></span></div>
</div>




</div>
<div class="clear"></div>
<div class="manda"><span class="req">*</span> Mandatory Field</div>
</div>
<div class="warr-bottom clear-fix">
<div class="warr-col clear-fix">
<h3><i>1</i>How do you hear about MAKITA products?</h3>
<div class="check-wrap clear-fix">
<ul>
<?php 
	foreach($ha as $val){
?>
<li>
<input type="checkbox" name="chk[]"  value="<?php echo $val['id'];?>" id="<?php echo $val['id'];?>">
<label for="<?php echo $val['id'];?>"><?php echo $val['name'];?></label>
</li>
<?php } ?>
</ul>
</div>


</div>
<div class="warr-col clear-fix">
<h3><i>2</i>Why did you choose a MAKITA Product?</h3>
<div class="check-wrap clear-fix">
<ul>
<?php 
	foreach($wc as $val){
?>
	<li><input type="checkbox" name="chk2[]" value="<?php echo $val['id'];?>" id="q<?php echo $val['id'];?>"><label for="q<?php echo $val['id'];?>"><?php echo $val['name'];?></label></li>

<?php } ?>

</ul>


</div>

</div>

</div>
<div class="warr-button clear-fix">
<div class="btnWrap">
<div class="captcha"><?php echo $widget;?><?php echo $script;?></div>
<button type="submit" class="btn-submit">SUBMIT</button>

</div>


</div>
</form>
</div>
</div>

</div>
</div>
<?php $this->load->view('include/footer'); ?>

</body>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#date_of_purchase" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  dateFormat: "yy-mm-dd"
    });
  } );
  </script>
<?php echo js('mobile-menu'); ?>
<?php echo css('mobile-menu'); ?>
<?php echo css('left-menu'); ?>

<script>
$("#model").click(function(e) {
	$(".model").show();
	$(".close-02").click(function() {
		$(".model").hide();
		
})
});
$("#serial").click(function(e) {
	$(".serial").show();
	$(".close-01").click(function() {
		$(".serial").hide();
		
})
});
</script>

<?php echo js('plugins'); ?>
</html>