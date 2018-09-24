<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top_banner'); ?>
<div class="wrap-bred-camb">
<div class="container">
<div class="bred-camb"><a href="<?php echo base_url('/'); ?>">Home</a><span class="seprster fa fa-angle-double-right"></span>
<a href="<?php echo base_url('news'); ?>">News</a><span class="seprster fa fa-angle-double-right"></span>
<?php echo date("F", mktime(null, null, null, $month));?> <?php echo $year;?></div>
</div>
</div> 
<div class="body-inner">
<div class="container">
<h2 class="page-title">News</h2>
<div class="col-wrap clear-fix">
<?php $this->load->view('include/news_left'); ?>
<div class="right-col">
<div class="pagin-top clear-fix">
<div class="pagen-wrap pagein">

<?php echo $pagi;?>

</div>
</div>
<div class="wrap-news">
<?php if(count($news_list)>0){ ?>
<?php foreach ($news_list as $key => $val){ ?>

<div class="news-row clear-fix">
<figure><a href="<?php echo base_url('news-details/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/news/listing/'.$val['image_name']); ?>" alt=""></a></figure>
<div class="news-info">
<h2><a href="<?php echo base_url('news-details/'.$val['seo_url']); ?>"><?php  echo $val['title']; ?></a></h2>
<span class="date"><strong>Date: </strong><?php echo date("F d, Y", strtotime($val['post_date']));?></span>
<article>
<?php $content = preg_replace("/<img[^>]+\>/i", " ", $val['description']);
			$content = strip_tags($content);
			if(strlen($content)>430){
	echo substr($content,0,430).'...';
}else{
	echo $content;
}
?>

</article>
<!--<a href="news-detail.html" class="readmore">READ MORE</a>-->
</div>


</div>

<?php } }?>

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