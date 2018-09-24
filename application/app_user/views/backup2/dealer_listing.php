<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<!--<div class="banner-wrap">
<div class="caption-inner">
<div class="container">
<h2>CORDLESS TOOLS </h2>

<article>Curabitur arcu erat, accumsan id imperdiet et, porttitor<br>
 at sem. Cras ultricies ligula sed magna dictum porta.
</article></div>
</div>
<img src="images/banner-information.jpg" alt="" class="imageResponsive">


</div>-->
<div class="wrap-bred">
<div class="container"><div class="bred-camb"><a href="<?php echo base_url('/'); ?>">HOME</a><span class="seprster ">/</span>FIND A DEALER</div>

</div>
</div>

<div class="body-inner">
<div class="container">

<div class="col-wrap clear-fix">
<div class="dealer-left">
<form action="<?php echo base_url('find-a-dealer')?>" method="post">
<h2>FIND A DEALER</h2>
<p><?php echo $this->all_function->get_site_options('find_a_dealer');?></p>
<h3>SELECT A COUNTRY</h3>
<div class="list-item">
<select name="country_id">
<?php foreach($country as $val){ ?>
<option value="<?=$val['id']?>" <?php echo (isset($country_id) && $val['id']==$country_id)?"selected":''?>><?=$val['name']?></option>
<?php } ?>
</select>
</div>
<button type="submit" class="find">FIND LOCATION</button>
</form>
</div>
<div class="dealer-right">
<h2 class="page-title"><?php echo $address[0]['cname']?></h2>
<div class="map-right" id="map" style="width:100%; height:450px;">
<!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7435448529186!2d103.96514811475397!3d1.3299327990300156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da3cd3efffffff%3A0x54a1f9f03a173bd6!2sMakita!5e0!3m2!1sen!2sin!4v1482752481253" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBBepZmkogMsEeXh-XIr8a2JvmEAw4NiZg"></script>
<script type="text/javascript">
   
var locations = [];
<?php foreach ($address as $item) : ?>
locations.push(["<?php echo addslashes($item['address'])?>",'<?php echo $item['latitude']?>','<?php echo $item['longitude']?>']);
<?php endforeach; ?>
    /*var locations = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];*/

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: <?php echo $address[0]['zoom']?>,
      center: new google.maps.LatLng(<?php echo $address[0]['clat']?>,<?php echo $address[0]['clng']?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
<div class="wrap-dlr-list  clear-fix">
<h3>DEALERS</h3>
<div class="clear"></div>
<?php if(count($address)>0){
	$cnt=0;
	foreach($address as $val)
	{  $cnt++;
?>
<div class="col-dlr">
<h4><?php echo $val['name'];?></h4>
<address>
<!--<strong>Makita Singapore Pte. Ltd.</strong><br>
7, Changi South Street 3, Singapore 486348<br>
Phone: +65 6545 4418<br>
Fax: +65 6546 8711-->
<?php echo $val['address'];?>
</address>
<?php 
if($cnt==2){
	echo '<div class="clear"></div>';
	$cnt=0;
}
 ?>
</div>

<?php }} ?>
<!--
<div class="col-dlr">
<h4>EAST</h4>
<address>
<strong>Makita Singapore Pte. Ltd.</strong><br>

7, Changi South Street 3, Singapore 486348<br>

Phone: +65 6545 4418<br>

Fax: +65 6546 8711
</address>

</div>
<div class="col-dlr">
<h4>WEST</h4>
<address>
<strong>Makita Singapore Pte. Ltd.</strong><br>

7, Changi South Street 3, Singapore 486348<br>

Phone: +65 6545 4418<br>

Fax: +65 6546 8711
</address>

</div>
<div class="clear"></div>
<div class="col-dlr">
<h4>NORTH</h4>
<address>
<strong>Makita Singapore Pte. Ltd.</strong><br>

7, Changi South Street 3, Singapore 486348<br>

Phone: +65 6545 4418<br>

Fax: +65 6546 8711
</address>

</div>
<div class="col-dlr">
<h4>SOUTH</h4>
<address>
<strong>Makita Singapore Pte. Ltd.</strong><br>

7, Changi South Street 3, Singapore 486348<br>

Phone: +65 6545 4418<br>

Fax: +65 6546 8711
</address>

</div>-->



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
<script>
$("#accordion > li > span").click(function(){

	if(false == $(this).next().is(':visible')) {
		$('#accordion ul').slideUp(300);
	}
	$(this).next().slideToggle(300);
});

$(".click").click(function(){
	$(".menu").slideToggle(300);
});


//$('#accordion ul:eq(0)').show();

</script>

<?php echo js('plugins'); ?>
</html>