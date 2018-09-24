<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top_banner'); ?>
<div class="wrap-bred-camb">
<div class="container">
<div class="bred-camb"><a href="<?php echo base_url('/'); ?>">Home</a><span class="seprster fa fa-angle-double-right"></span>Our Clients</div>
</div>
</div> 
<div class="body-inner">
<div class="container">
<h2 class="page-title">Our Clients</h2>
<div class="wrap-product-listing">
<div class="pagin-top clear-fix">
<div class="pagen-wrap pagein">

<?php echo $pagi;?>

</div>
</div>
<div class="listing-wrap clear-fix">
<?php if(isset($cs) && count($cs)>0){ 
foreach($cs as $key=>$val){
?>
<div class="product-box">
<div class="img-wrap">
<figure>
<img src="<?php echo base_url('assets/upload/our_client/thumb/'.$val['image_name']); ?>" alt="">
</figure>
</div>
<div class="wrapInfo">
<article>
<h2><?php echo $val['name'];?></h2>
</article>
</div>
</div>
<?php } } ?>





</div>
<div class="pagin-bottom clear-fix">
<div class="pagen-wrap pagein">

<?php echo $pagi;?>

</div>
</div>
</div>
</div>
</div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
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
<?php echo js('jquery.flexslider'); ?>
<?php echo js('plugins'); ?>
</html>