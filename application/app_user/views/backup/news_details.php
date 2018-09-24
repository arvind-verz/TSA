<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/news_banner'); ?>
<div class="wrap-bred-camb">
<div class="container">
<div class="bred-camb"><a href="<?php echo base_url('/'); ?>">Home</a><span class="seprster fa fa-angle-double-right"></span>News</div>
</div>
</div> 
<div class="body-inner">
<div class="container">
<h2 class="page-title"><?php echo $page[0]['title'];?>
<span class="date"><strong>Date: </strong><?php echo date("F d, Y", strtotime($page[0]['post_date']));?></span>
</h2>
<div class="wrap-news-detail">
<?php echo $page[0]['description'];?>
<div class="clear-fix"></div>
<a href="<?php echo base_url('news'); ?>" class="btn solid right">Check Other News</a>
<div class="clear-fix"></div>
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