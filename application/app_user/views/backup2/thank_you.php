<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?> 
<?php $this->load->view('include/top_banner'); ?>
<div class="wrap-bred">
<div class="container"><div class="bred-camb"><a href="<?php echo base_url('/'); ?>">HOME</a><span class="seprster ">/</span>
THANK YOU
</div>

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
<div class="thankyou-wrap">

<?php echo $page[0]['page_content'];?>

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
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBBepZmkogMsEeXh-XIr8a2JvmEAw4NiZg"></script>
<?php //echo js('map'); ?>
<?php echo js('plugins'); ?>
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
</html>