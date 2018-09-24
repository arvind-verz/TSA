<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top_banner'); ?>
<div class="wrap-bred">
<div class="container"><div class="bred-camb"><a href="<?php echo base_url('/'); ?>">HOME</a><span class="seprster ">/</span>CONTACT US</div>

</div>
</div>

<div class="body-inner">
<div class="container">

<div class="col-wrap clear-fix">
<div class="contact-left">
<h2 class="page-title">CONTACT US</h2>
<address><strong><i class="fa fa-building-o" aria-hidden="true"></i><?php echo $this->all_function->get_site_options('site_name')?></strong><br>
<?php echo $this->all_function->get_site_options('site_address1')?><br>
Phone: <?php echo $this->all_function->get_site_options('cantact_no')?><br>
Fax: <?php echo $this->all_function->get_site_options('cantact_fax')?>
</address>
<div class="map-contact">
<div class="map">
  <div id="map_canvas"> </div>
  
  </div>


</div>

<article><span>Makita Singapore Pte Ltd</span> respects our clients’ privacy and strictly adheres to the Personal Data Protection Act 2012 (PDPA) of Singapore.</article>
</div>
<div class="contact-right">
<div class="wrap-cms"><?php echo $page[0]['page_content'];?></div>
<div class="from-contact">
<h3>ENQUIRY FORM</h3>
<p><span class="req">*</span> Complusory fields</p>
<?php $this->load->view('include/message'); ?>
<div class="warr-left">
<form name="contact" id="contact" method="post" action="<?php echo base_url('contact-us/'.$product_type.'/'.$product_seo_url); ?>">
<input type="hidden" name="type" value="<?php echo $type; ?>">
<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
<input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
<input type="hidden" name="product_type" value="<?php echo $product_type; ?>">
<div class="from-row clear-fix">
<span class="level">Type</span>
<input type="text" class="input-text"  value="<?php echo ucfirst($product_type);?>" disabled >
</div>

<div class="from-row clear-fix">
<span class="level">Product Name</span>
<input type="text" class="input-text" disabled value="<?php echo ucfirst($product_name);?>" >
</div>



<div class="from-row clear-fix">
<span class="level">Please Select</span>
<div class="list-item">
<select name="salutation">
<option value="Mr">Mr</option>
<option value="Miss">Miss</option>
<option value="Mrs">Mrs</option>
</select>
</div>
</div>

<div class="from-row clear-fix">
<span class="level">NAME <span class="req">*</span></span>
<input type="text" class="input-text" name="name" required value="<?php echo set_value('name'); ?>">
</div>
<div class="from-row clear-fix">
<span class="level">EMAIL <span class="req">*</span></span>
<input type="email" name="email" required class="input-text" value="<?php echo set_value('email'); ?>">
</div>
<div class="from-row clear-fix">
<span class="level">PHONE NO.</span>
<input type="tel" class="input-text" name="telephone"  value="<?php echo set_value('telephone'); ?>">
</div>
<div class="from-row clear-fix">
<span class="level">MOBILE NO. <span class="req">*</span></span>
<input type="tel" class="input-text" name="mobile_no"  value="<?php echo set_value('mobile_no'); ?>" required>
</div>
<div class="from-row clear-fix">
<span class="level">COUNTRY<!--<span class="req">*</span>--></span>
<div class="country-right clear-fix">
<div class="list-item">
<select name="country_id">
<option value="">Select</option>
<?php foreach($country as $val){ ?>
	<option value="<?php echo $val['id'];?>" <?php if(set_value('country_id')==$val['id']){echo 'selected';} ?>><?php echo $val['name'];?></option>
<?php } ?>    
</select>
</div>
<a href="<?php echo $this->all_function->get_site_options('other_country')?>">OTHER COUNTRIES?</a>
</div>
</div>
<div class="from-row clear-fix">
<span class="level">SUBJECT <span class="req">*</span></span>
<input type="text" class="input-text" name="subject"  value="<?php echo set_value('subject'); ?>" required>
</div>
<div class="from-row clear-fix">
<span class="level">COMMENTS  <span class="req">*</span></span>
<textarea class="textarea" name="message" required><?php echo set_value('message'); ?></textarea>
</div>
<div class="from-row clear-fix">
<div class="btnWrap clear-fix">
<div class="captcha"><?php echo $widget;?><?php echo $script;?></div>
<button type="submit" class="btn-submit">SUBMIT</button>

</div>
</div>
</form>

</div>



</div>
</div>

</div>
</div>
</div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
<?php echo js('mobile-menu'); ?>
<?php echo css('mobile-menu'); ?>
<?php echo css('left-menu'); ?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBBepZmkogMsEeXh-XIr8a2JvmEAw4NiZg"></script>
<script>
function initialize() {
	var myLatlng = new google.maps.LatLng(1.3299328,103.9651481);
	var myOptions = { 
	  zoom: 16,
	  center: myLatlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	var contentString = '<div id="content">'+
		'<h2>Makita Singapore Pte. Ltd.</h2>'+
		'<div>'+
		'<p>7, Changi South Street 3, Singapore 486348</p>'+
		'</div>'+
		'</div>';

	var infowindow = new google.maps.InfoWindow({
		content: contentString,
		maxWidth: 400
	});
	
	var companyImage = new google.maps.MarkerImage('<?=image('point_map.png')?>',
		new google.maps.Size(95,55),
		new google.maps.Point(0,0)
	);

	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		icon: companyImage,
		title: 'Council for Third Age'
	});
	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	});

  }
	
 initialize();
</script>

<?php echo js('plugins'); ?>
</html>