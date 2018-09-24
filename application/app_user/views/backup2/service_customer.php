<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top_banner'); ?>

<div class="wrap-bred">
<div class="container"><div class="bred-camb"><a href="<?php echo base_url('/');?>">HOME</a><span class="seprster ">/</span>SERVICES</div>


</div>
</div>

<div class="body-inner">
<div class="container">
<h2 class="page-title">Servicing the Customer</h2>
<div class="service-top clear-fix">
<?php echo $page[0]['page_content'];?>
<!--
<div class="service-left">
<img src="images/service-01.jpg" alt="">
</div>
<div class="service-right">
<p>Our success not only comes from producing #1 Quality tools, but also from our unparalleled service. From our Customer Service Representatives to our extensive Sales Team and Product Specialists, Makita is dedicated to delivering complete customer satisfaction.</p>
<p>For power tools that need to be serviced or repaired, it is reassuring to know that Makita is there with a comprehensive service.</p>
<h3>Makita Singapore Repair Center Advantages:</h3>
<div class="service-list clear-fix">
<ul>
<li>
<img src="images/ser-01.png" alt="">
<article>
Qualified, trained technicians 
</article>

</li>
<li>
<img src="images/ser-02.png" alt="">
<article>
Free estimates and quotation for repair 

</article>

</li>
<li>
<img src="images/ser-03.png" alt="">
<article>
Genuine quality Makita replacement parts 

</article>

</li>
<li>
<img src="images/ser-04.png" alt="">
<article>
Free repair pick-up and delivery to and from Makita Singapore Dealers only 

</article>

</li>
<li>
<img src="images/ser-05.png" alt="">
<article>
Most tools repaired in 48 hours or less

</article>

</li>
<li>
<img src="images/ser-06.png" alt="">
<article>
Free technical support center

</article>

</li>








</ul>
</div>
</div>-->

</div>
</div>
<div class="service-bottom">
<div class="service-bottom-top">
<div class="container">
<span class="red-tag">Service Centres</span>


</div>
</div>

<div class="container">
<div class="service-bottom-content clear-fix"  id="nest-accordion">
<?php
if(count($sc)>0)
list($array1, $array2) = array_chunk($sc, ceil(count($sc) / 2));
?>

<div class="aco-left">
<ul>
<?php 
$cnt=0;
if(is_array($array1) && count($array1)>0){
 foreach($array1 as $val){$cnt++;
?>
<li class="accordion_in <?php echo($cnt==1)?'acc_active':'';?>">
<div  class="trigger"><a href="javascript:void(0);"><?php echo $val['name']; ?></a></div>
<div class="accordion-inner">
<div class="acco-detail">
<!--<address class="address">
<strong>Olympia Machinery Store</strong><br>
175, Nawabpur Road Dhaka-1100<br>
Phone: +880 2955 2804
</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>
</address>-->
<?php echo $val['address']; ?>
</div>
</div>


</li>

<?php } }?>
<!--<li class="accordion_in acc_active">
<div  class="trigger"><a href="javascript:void(0);">SINGAPORE</a></div>
<div class="accordion-inner">
<div class="acco-detail">
<address class="address">
<strong>Olympia Machinery Store</strong><br>

175, Nawabpur Road Dhaka-1100<br>

Phone: +880 2955 2804

</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>


</address>





</div>
</div>


</li>
<li class="accordion_in"><div  class="trigger"><a href="javascript:void(0);">BANGLADESH  	</a></div>
<div class="accordion-inner">
<div class="acco-detail">
<address class="address">
<strong>Olympia Machinery Store</strong><br>

175, Nawabpur Road Dhaka-1100<br>

Phone: +880 2955 2804

</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>


</address>





</div>
</div>

</li>
<li class="accordion_in"><div  class="trigger"><a href="javascript:void(0);">BRUNEI		</a></div>
<div class="accordion-inner">
<div class="acco-detail">
<address class="address">
<strong>Olympia Machinery Store</strong><br>

175, Nawabpur Road Dhaka-1100<br>

Phone: +880 2955 2804

</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>


</address>





</div>
</div>

</li>
<li class="accordion_in"><div  class="trigger"><a href="javascript:void(0);">EAST MALAYSIA</a></div>
<div class="accordion-inner">
<div class="acco-detail">
<address class="address">
<strong>Olympia Machinery Store</strong><br>

175, Nawabpur Road Dhaka-1100<br>

Phone: +880 2955 2804

</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>


</address>





</div>
</div>

</li>
<li class="accordion_in"><div  class="trigger"><a href="javascript:void(0);">MYANMAR</a></div>
<div class="accordion-inner">
<div class="acco-detail">
<address class="address">
<strong>Olympia Machinery Store</strong><br>

175, Nawabpur Road Dhaka-1100<br>

Phone: +880 2955 2804

</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>


</address>





</div>
</div>

</li>-->

</ul>
</div>
<div class="aco-left">
<ul>
<?php 
if(is_array($array2) && count($array2)>0){
 foreach($array2 as $val){
 if (!empty($val)) {	 
?>
<li class="accordion_in"><div  class="trigger"><a href="javascript:void(0);"><?php echo $val['name']; ?></a></div>
<div class="accordion-inner">
<div class="acco-detail">
<!--<address class="address">
<strong>Olympia Machinery Store</strong><br>
175, Nawabpur Road Dhaka-1100<br>
Phone: +880 2955 2804
</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>
</address>-->
<?php echo $val['address']; ?>
</div>
</div>

</li>
<?php }} }?>
<!--
<li class="accordion_in"><div  class="trigger"><a href="javascript:void(0);">MALDIVES</a></div>
<div class="accordion-inner">
<div class="acco-detail">
<address class="address">
<strong>Olympia Machinery Store</strong><br>

175, Nawabpur Road Dhaka-1100<br>

Phone: +880 2955 2804

</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>


</address>
</div>
</div>

</li>
<li class="accordion_in"><div  class="trigger"><a href="javascript:void(0);">NEPAL</a></div>
<div class="accordion-inner">
<div class="acco-detail">
<address class="address">
<strong>Olympia Machinery Store</strong><br>

175, Nawabpur Road Dhaka-1100<br>

Phone: +880 2955 2804

</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>


</address>
</div>
</div>

</li>
<li class="accordion_in"><div  class="trigger"><a href="javascript:void(0);">PAKISTAN</a></div>
<div class="accordion-inner">
<div class="acco-detail">
<address class="address">
<strong>Olympia Machinery Store</strong><br>

175, Nawabpur Road Dhaka-1100<br>

Phone: +880 2955 2804

</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>


</address>
</div>
</div>

</li>
<li class="accordion_in"><div  class="trigger"><a href="javascript:void(0);">SRI LANKA</a></div>
<div class="accordion-inner">
<div class="acco-detail">
<address class="address">
<strong>Olympia Machinery Store</strong><br>

175, Nawabpur Road Dhaka-1100<br>

Phone: +880 2955 2804

</address>
<address class="address">
<strong>Olympia Machinery Store</strong><br>
188/A Jubilee Road, Chittagong<br>
Phone: +880 3161 4623<br>
Email: <a href="mailto:dfurniture@d-furniture.com">salehaenterprise@gmail.com</a>


</address>
</div>
</div>

</li>-->
</ul>
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
