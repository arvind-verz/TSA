<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top_banner'); ?>

<div class="wrap-bred">
<div class="container"><div class="bred-camb"><a href="<?php echo base_url('/'); ?>">HOME</a><span class="seprster ">/</span><?php echo $page[0]['page_heading'];?></div>


</div>
</div>

<div class="body-inner">
<div class="container">
<h2 class="page-title">Search Results: <?php echo $key;?></h2>
<div class="Search-result">
<div class="service-list clear-fix">
<ul>

<?php 
if(count($product_pages)>0){
foreach ($product_pages as $key => $val){ ?>
<li>
 <img src="<?php echo base_url('assets/upload/tools_products/listing/'.$val['image_listing']); ?>" alt="">
<article>
<h2><a href="<?php echo base_url('product/'.$val['seo_url']); ?>"><?php echo $val['product_name'];?></a></h2>

<div class="news-info">
<p><?php 	echo substr(strip_tags($val['product_short_description']),0,200).'...'; ?></p>
<div class="clear"></div>
<a href="<?php echo base_url('product/'.$val['seo_url']); ?>" class="read-search">READ MORE</a>
<div class="clear"></div>
</div>
</article>


</li>
<?php }}else{ ?>
<li>No Record Fount</li>
<?php } ?>
</ul>
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