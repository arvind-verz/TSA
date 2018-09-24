<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/information_banner'); ?>
<div class="wrap-bred">
<div class="container"><div class="bred-camb"><a href="<?php echo base_url('/'); ?>">HOME</a><span class="seprster ">/</span>information</div>

</div>
</div>

<div class="body-inner">
<div class="container">

<div class="col-wrap clear-fix">
<div class="left-menu">
<h2>INDUSTRIES<i class="click fa fa-reorder" aria-hidden="true"></i></h2>

<div class="menu">
 
<ul class="menu-laft">
<?php if(count($info)>0){
foreach($info as $val){	
?>
<li class="<?php echo ($val['seo_url']==$page[0]['seo_url'])?'Select':''; ?>"><a href="<?php echo base_url('information/'.$val['seo_url']); ?>"><?php echo $val['name']?></a></li>
<?php }} ?>
 <!--<li class="Select"><a href="information.html">AVT</a></li>
 <li><a href="information.html">MM4</a></li>
 <li><a href="information.html">LXT</a></li>
 <li><a href="information.html">BL MOTOR</a></li>-->

</ul>


</div>


</div>
<div class="right-col">
<div class="wrap-cms">
<h2 class="page-title"><?php echo $page[0]['name'];?></h2>
<?php echo $page[0]['descriptions'];?>

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