<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top_subcategory_banner2_acc'); ?>
<div class="wrap-bred">
<div class="container"><div class="bred-camb"><a href="<?php echo base_url('/'); ?>">HOME</a><span class="seprster ">/</span>ACCESSORIES</div>
<!--<span class="Showing-results">Showing 1–12 of 64 results</span>-->

</div>
</div>

<div class="body-inner">
<div class="container">
<h2 class="page-title">ACCESSORIES</h2>
<div class="col-wrap clear-fix">
<div class="left-menu">
<h2>Filter Tools<i class="click fa fa-reorder" aria-hidden="true"></i></h2>

<div class="menu">

<ul id="accordion">

<?php foreach ($category as $key => $val): ?>
<li class="Sub  <?php if(($page[0]['cat_id']==$val['cat_id'])||($page[0]['parent_id']==$val['cat_id'])){echo 'active';}
	?>"><span><a href="javascript:void(0);"><?php echo $val['cat_name'];?></a></span>
<?php $sub_categories = $this->all_function->get_sub_categories($val['cat_id']);
if(count($sub_categories)>0){ 
?>
<ul  <?php if(($page[0]['parent_id']==$val['cat_id'])||($page[0]['cat_id']==$val['cat_id'])){echo 'class="selected" style="display:block;"';}else{echo 'style="display:none;"';}?>>
	<?php foreach ($sub_categories as $key => $val){?>
    <li <?php if(($page[0]['cat_id']==$val['cat_id'])||($page[0]['parent_id']==$val['cat_id'] || $subcat_id==$val['cat_id'])){echo 'class="active"';}?>>
    <a href="<?php echo base_url('accessories-sub-cat/'.$val['seo_url']);?>"><?php echo $val['cat_name'];?></a>
    </li>
    <?php }  ?>
</ul>
<?php }  ?>
</li>
<?php endforeach; ?>

</ul>


</div>

<?php 
$item_viewed = $this->session->userdata('item_viewed'); 
if(!empty($item_viewed)){	
?>
<div class="recent-view">
<h3>RECENTLY VIEWED</h3>
<div class="list-view">
<ul>
<?php foreach ($item_viewed as $key => $val){
 if($val['type']=='tools')	
 $row = $this->all_function->get_item_viewed_tools($val['products_id']);
 else
 $row = $this->all_function->get_item_viewed($val['products_id']);
?>

<?php if($val['type']=='tools'){	 ?>
<li>
<a href="<?php echo base_url($val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/tools_products/viwed/'.$row['image_name']); ?>" alt="">
<article><?php echo $row['product_name']; ?></article></a>
</li>
<?php }else{ ?>
<li> <a href="<?php echo base_url($val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/products/viwed/'.$row['image_name']); ?>" alt="">
<article><?php echo $row['product_name']; ?></article>
</a> 
</li>
<?php } ?>
<?php } ?>

</ul>
</div>
</div>
<?php } ?>
</div>
<div class="right-col">
<div class="pagin-top clear-fix">
<div class="pagen-wrap pagein">
<!--<ul>
<li class="pre"><a href="#"></a></li>
<li><a href="#" class="active">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>

<li class="nex"><a href="#"></a></li>
</ul>-->
<?php echo $pagi;?>
</div>
</div>

<div class="list-flow">
<div class="listing-wrap clear-fix">
<?php if(count($products_list)>0){?>
<?php foreach ($products_list as $key => $val){?>

<div class="product-box">
<div class="img-wrap">
<a href="<?php echo base_url('accproduct/'.$val['seo_url']);?>">
<img src="<?php echo base_url('assets/upload/products/listing/'.$val['image_listing']); ?>" alt="">
<figcaption></figcaption>
</a>
</div>
<div class="bx-link-wrap">
<h2><a href="<?php echo base_url('accproduct/'.$val['seo_url']);?>">VIEW DETAILS</a></h2>
<a href="<?php echo base_url('contact-us/accessories/'.$val['seo_url']);?>" class="link-cart"><img src="<?php echo image('cart-ic-01.png');?>" alt=""></a>
</div>
<div class="bx-container">
<a href="<?php echo base_url('accproduct/'.$val['seo_url']);?>">
<h3><?php echo $val['product_name'];?></h3>
<div class="info-table-text">
<?php echo $val['product_description'];?>
</div>
</a>
</div>
</div>


<?php } ?>
<?php }else{ ?>
<div class="product-box">No Product Found</div>
<?php } ?>

</div>

</div>
<div class="pagin-bottom clear-fix">
<div class="pagen-wrap pagein">
<!--<ul>
<li class="pre"><a href="#"></a></li>
<li><a href="#" class="active">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li class="nex"><a href="#"></a></li>
</ul>
-->
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