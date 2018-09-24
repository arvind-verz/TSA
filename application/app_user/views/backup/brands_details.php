<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top_brands_banner'); ?>
<div class="wrap-bred-camb">
<div class="container">
<div class="bred-camb"><a href="<?php echo base_url('/'); ?>">Home</a><span class="seprster fa fa-angle-double-right"></span><?php echo $page[0]['brands_name'];?></div>
</div>
</div> 

<div class="body-inner">
<div class="container">
<h2 class="page-title"><?php echo $page[0]['brands_name'];?></h2>
<div class="col-wrap clear-fix">
<div class="left-menu">
<h2>Brands<i class="click fa fa-reorder" aria-hidden="true"></i></h2>

<div class="menu">

<ul id="accordion">
<?php foreach ($brands as $key => $val): ?>
<li <?php if($page[0]['seo_url']==$val['seo_url']){echo 'class="active"';}?>><span><a href="<?php echo base_url('brands/'.$val['seo_url']); ?>"><?php echo $val['brands_name'];?></a></span></li>
<?php endforeach; ?>
</ul>


</div>
</div>
<div class="right-col">
<div class="pagin-top clear-fix">
<div class="pagen-wrap pagein">

<?php echo $pagi;?>

</div>
</div>
<div class="listing-wrap clear-fix">
<?php if(count($products_list)>0){?>
<?php foreach ($products_list as $key => $val){?>
<div class="product-box">
<div class="img-wrap">
<figure>
<img src="<?php echo base_url('assets/upload/products/listing/'.$val['listing_image']); ?>" alt="">
<a href="<?php echo base_url('product/'.$val['seo_url']);?>">
<figcaption>
<div class="caption-in">
<span class="view">VIEW <strong>Details</strong></span>
</div>
</figcaption>
</a>
</figure>
</div>
<div class="wrapInfo">
<article>
<h2><?php echo $val['product_name'];?></h2>
</article>
</div>
</div>
<?php } ?>
<?php }else{?>
<div class="product-box">No Product Found</div>
<?php }?>



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