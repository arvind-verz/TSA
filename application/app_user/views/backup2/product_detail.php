<?php $this->load->view('include/header_tag'); ?><body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<div class="wrap-bred">
<div class="container"><div class="bred-camb"><a href="<?php echo base_url('/'); ?>">HOME</a><span class="seprster ">/</span>
<a href="#">TOOLS</a><span class="seprster ">/</span>
<a href="<?php echo base_url('category/'.$parent_cat['seo_url']);?>"><?php echo $parent_cat['cat_name']?></a><span class="seprster ">/</span>
<a href="<?php echo base_url('subcategory/'.$page[0]['seo_url']);?>"><?php echo $page[0]['cat_name'];?></a><span class="seprster ">/</span>
<?php echo $page[0]['product_name'];?>
</div>
</div>
</div>

<div class="body-inner">
<div class="container">
<div class="detail_wrap clear-fix">
<div class="detail-top-wrap clear-fix">
<div class="detail_left">
<?php if($this->all_function->isMobile()){?>
<div class="view_image">
<img src="<?php echo base_url('assets/upload/tools_products/details/'.$page[0]['image_name']);?>" id="View_image">
</div>
<?php $product_images = $this->all_function->get_product_images_tools($page[0]['id']); ?>
<div class="Thumb_wrap">
<?php if(count($product_images)>=4){?>
<a href="#" class="jcarousel-control-prev2"></a>
<?php } ?>
<div class="erap-over">
 <div class="jcarousel-wrapper">
 <div class="jcarousel2">
<ul>
<?php if(count($product_images)>=1){?>
<li>
<div class="thumb_box"><a href="<?php echo base_url('assets/upload/tools_products/details/'.$page[0]['image_name']); ?>" class="active"><img src="<?php echo base_url('assets/upload/tools_products/thumb/'.$page[0]['image_name']); ?>" alt=""></a></div>
</li>
<?php } ?>
<?php foreach ($product_images as $key => $val): ?>
<li>
<div class="thumb_box"><a href="<?php echo base_url('assets/upload/tools_products/details/'.$val['image_name']); ?>"><img src="<?php echo base_url('assets/upload/tools_products/thumb/'.$val['image_name']); ?>" alt=""></a></div>
</li>
<?php endforeach; ?>
</ul>
</div>
</div>
</div>
<?php if(count($product_images)>=4){?>
<a href="#" class="jcarousel-control-next2"></a>
<?php } ?>
</div>

<?php }elseif($this->all_function->get_site_options('zoomer')){?>
<div class="view_image1">
<img src="<?php echo base_url('assets/upload/tools_products/details/'.$page[0]['image_name']);?>" id="view123">
</div>
<?php $product_images = $this->all_function->get_product_images_tools($page[0]['id']); ?>

<div class="Thumb_wrap">
<?php if(count($product_images)>=4){?>
<a href="#" class="jcarousel-control-prev2"></a>
<?php } ?>
<div class="erap-over">
 <div class="jcarousel-wrapper">
 <div class="jcarousel2" id="gal2">
<ul>
<?php if(count($product_images)>=1){?>
<li>
<div class="thumb_box">
<a href="#" class="active" data-image="<?php echo base_url('assets/upload/tools_products/details/'.$page[0]['image_name']); ?>" data-zoom-image="<?php echo base_url('assets/upload/tools_products/original/'.$page[0]['image_name']); ?>"><img src="<?php echo base_url('assets/upload/tools_products/thumb/'.$page[0]['image_name']); ?>"  alt=""></a>
</div>
</li>
<?php } ?>
<?php foreach ($product_images as $key => $val): ?>
<li>
<div class="thumb_box"><a href="#" data-image="<?php echo base_url('assets/upload/tools_products/details/'.$val['image_name']); ?>" data-zoom-image="<?php echo base_url('assets/upload/tools_products/original/'.$val['image_name']); ?>"><img src="<?php echo base_url('assets/upload/tools_products/thumb/'.$val['image_name']); ?>" alt="" ></a></div>
</li>
<?php endforeach; ?>
</ul>
</div>
</div>
</div>
<?php if(count($product_images)>=4){?>
<a href="#" class="jcarousel-control-next2"></a>
<?php } ?>
</div>

<script src="<?php echo base_url('assets/js/jquery.elevatezoom.js');?>"></script>
          <link rel="stylesheet" href="<?php echo base_url();?>assets/source/jquery.fancybox.css" />
          <script src="<?php echo base_url();?>assets/source/jquery.fancybox.pack.js" type="text/javascript"></script> 
          <script type="text/javascript">
  jQuery(document).ready(function () {
     
	jQuery("#view123").elevateZoom({
		zoomWindowFadeIn : 500,
		zoomLensFadeIn: 500,
		gallery				: "gal2",
		imageCrossfade: true,
		zoomWindowWidth:453,
		zoomWindowHeight:427,
		zoomWindowOffetx: 10,
		scrollZoom: true, 
		cursor:"pointer",
		responsive:true
		
	});
  	
 
    $("#view123").bind("click", function(e) {  
	 var ez =   $('#view123').data('elevateZoom');	
	//$.fancybox(ez.getGalleryList());
            return false;
    });
	
	$(".jcarousel-wrapper .jcarousel2 a").click(function(e) {
      e.preventDefault();
      $("a").removeClass("active");
    $(this).addClass("active");
	
  })
	
    });
  </script>


<?php }else{ ?>
<div class="view_image">
<img src="<?php echo base_url('assets/upload/tools_products/details/'.$page[0]['image_name']);?>" id="View_image">
</div>
<?php $product_images = $this->all_function->get_product_images_tools($page[0]['id']); ?>

<div class="Thumb_wrap">
<?php if(count($product_images)>=4){?>
<a href="#" class="jcarousel-control-prev2"></a>
<?php } ?>
<div class="erap-over">
 <div class="jcarousel-wrapper">
 <div class="jcarousel2">
<ul>
<?php if(count($product_images)>=1){?>
<li>
<div class="thumb_box"><a href="<?php echo base_url('assets/upload/tools_products/details/'.$page[0]['image_name']); ?>" class="active"><img src="<?php echo base_url('assets/upload/tools_products/thumb/'.$page[0]['image_name']); ?>" alt=""></a></div>
</li>
<?php } ?>
<?php foreach ($product_images as $key => $val): ?>
<li>
<div class="thumb_box"><a href="<?php echo base_url('assets/upload/tools_products/details/'.$val['image_name']); ?>"><img src="<?php echo base_url('assets/upload/tools_products/thumb/'.$val['image_name']); ?>" alt=""></a></div>
</li>
<?php endforeach; ?>
</ul>
</div>
</div>
</div>
<?php if(count($product_images)>=4){?>
<a href="#" class="jcarousel-control-next2"></a>
<?php } ?>
</div>

<?php } ?>



</div>
<div class="detail-right">
<h2 class="page-title"><?php echo $page[0]['product_name'];?></h2>


<div class="tabs clear-fix">
<div class="tab-nav clear-fix">
        <ul class="tabNavigation">
          <li><a href="#one">ABOUT THE PRODUCT</a></li>
          <li><a href="#two">STANDARD EQUIPMENT</a></li>
            <li><a href="#three">INFORMATION &amp; TECHNOLOGY</a></li>
        </ul>
</div>
        <div id="one" class="tab-container">
        <div class="Description">
        <!--<ul class="bullet-round">
        <li>Heavy duty construction - ideal for site work.</li>
        <li>Rotary &amp; percussion action.</li>
        <li>High &amp; low speed setting.</li>
        <li>One of the original workhorses.</li>
        <li>Excellent for plumbers, electricians, general contractors, hirers.</li>
        </ul>-->
        <?php echo $page[0]['about_product'];?>
        </div>
        </div>
        
                <div id="two" class="tab-container"> 
       <div class="Description">

            <!--<ul class="bullet-pdf">
            <li><a href="#">Morbi condimentum varius sem</a></li>
            <li><a href="#">Vestibulum est dolor, ornare quis neque</a></li>
            <li><a href="#">Vivamus lacinia leo sed condimentum</a></li>
            <li><a href="#">Nam convallis blandit nisl</a></li>
            <li><a href="#">Nulla commodo velit eget mauris faucibus tincidunt</a></li>
            </ul>-->
			<?php //echo $page[0]['standard_equipment'];?>
  <?php echo (isset($page[0]['standard_equipment']) && !empty($page[0]['standard_equipment']))?$page[0]['standard_equipment']:'No Standard Equipment found';?>
        </div>
        </div>
                 <div id="three" class="tab-container">
        <div class="Description">
		<!--<p>Nulla facilisi. Nunc fermentum lacinia sapien a condimentum. Nulla commodo velit eget mauris faucibus tincidunt. Sed a interdum sapien. Vestibulum vel convallis est. Morbi ac nisi id lacus imperdiet lacinia. Duis ac lacus ac est scelerisque suscipit.</p>
<p><strong>Sed porttitor augue sed leo hendrerit porttitor. Nam sit amet blandit erat. Duis volutpat posuere risus. Nunc congue eros tortor, at aliquet odio tincidunt a.</strong></p>-->
		<?php //echo $page[0]['it'];?>
 <?php echo (isset($page[0]['it']) && !empty($page[0]['it']))?$page[0]['it']:'No Information Technology found';?>
        </div>
        </div>
        
        
      </div>
     <h3 class="section-heading"> HEALTH AND SAFETY</h3>
      <div class="saefty clear-fix">
      <img src="<?php echo image('pic-01.jpg');?>" alt="">
      <img src="<?php echo image('pic-02.jpg');?>" alt="">
      </div>
<div class="btn-wrap  clear-fix">
<form action="<?php echo base_url('contact-us/tools/'.$page[0]['p_seo_url']);?>" method="get">
<button type="submit" class="addto_enquire">ADD TO ENQUIRY</button> 
</form>
 </div>
</div>
</div>
<div class="detail-tab2">
<div class="tabs2 clear-fix">
<div class="tab-nav clear-fix">
        <ul class="tabNavigation">
          <li><a href="#one2"><i class="fa fa-cog" aria-hidden="true"></i>TECHNICAL SPECIFICATIONS</a></li>
          <li><a href="#two2"><i class="fa fa-cogs" aria-hidden="true"></i>SPARE PARTS</a></li>
            <li><a href="#three2"><i class="fa fa-signal aria-hidden="true""></i>VIDEOS</a></li>
            <li><a href="#four2"><i class="fa fa-plus-square-o" aria-hidden="true"></i>MORE INFORMATION</a></li>
        </ul>
</div>
        <div id="one2" class="tab-container">
        <div class="Description2">
<!--<ul class="table-view">

<li class="clear-fix"><span class="list-left">Max. in steel</span><span class="list-right">13 mm</span></li>
<li  class="clear-fix"><span class="list-left">Max. in masonry</span><span class="list-right">19 mm</span></li>
<li class="clear-fix"><span class="list-left">Max. in wood</span><span class="list-right">Max. in wood</span></li>
<li class="clear-fix"><span class="list-left">No Load Speed</span><span class="list-right">H: 1300 / L: 1000 rpm</span></li>
<li class="clear-fix"><span class="list-left">Blows per minute</span><span class="list-right">H:14300 L: 11000 bpm</span></li>
<li class="clear-fix"><span class="list-left">Input wattage</span><span class="list-right">650 w</span></li>
<li class="clear-fix"><span class="list-left">Vibration: Drilling</span><span class="list-right">2.5 m/sec<sup>²</sup></span></li>
<li class="clear-fix"><span class="list-left">Vibration: Hammer Drilling</span><span class="list-right">15.5 m/sec<sup>²</sup></span></li>
<li class="clear-fix"><span class="list-left">Vibration K factor</span><span class="list-right">1.5 m/sec<sup>²</sup></span></li>
<li class="clear-fix"><span class="list-left">Noise sound pressure</span><span class="list-right">94 dB(A)</span></li>
<li class="clear-fix"><span class="list-left">Noise sound power</span><span class="list-right">105 dB(A)</span></li>
<li class="clear-fix"><span class="list-left">Noise K factor</span><span class="list-right">3 dB(A)</span></li>
<li class="clear-fix"><span class="list-left">Net weight</span><span class="list-right">3.0 kg</span></li>
</ul>-->
<?php echo (isset($page[0]['specification']) && !empty($page[0]['specification']))?$page[0]['specification']:'No Specification found';?>

        </div>
        </div>
        
                <div id="two2" class="tab-container"> 
       <div class="Description2">
<!--<ul class="table-view">
<li class="clear-fix"><span class="list-left">Max. in steel</span><span class="list-right">13 mm</span></li>
<li  class="clear-fix"><span class="list-left">Max. in masonry</span><span class="list-right">19 mm</span></li>
<li class="clear-fix"><span class="list-left">Max. in wood</span><span class="list-right">Max. in wood</span></li>
<li class="clear-fix"><span class="list-left">No Load Speed</span><span class="list-right">H: 1300 / L: 1000 rpm</span></li>
<li class="clear-fix"><span class="list-left">Blows per minute</span><span class="list-right">H:14300 L: 11000 bpm</span></li>
<li class="clear-fix"><span class="list-left">Input wattage</span><span class="list-right">650 w</span></li>
<li class="clear-fix"><span class="list-left">Vibration: Drilling</span><span class="list-right">2.5 m/sec<sup>²</sup></span></li>
<li class="clear-fix"><span class="list-left">Vibration: Hammer Drilling</span><span class="list-right">15.5 m/sec<sup>²</sup></span></li>
<li class="clear-fix"><span class="list-left">Vibration K factor</span><span class="list-right">1.5 m/sec<sup>²</sup></span></li>
<li class="clear-fix"><span class="list-left">Noise sound pressure</span><span class="list-right">94 dB(A)</span></li>
<li class="clear-fix"><span class="list-left">Noise sound power</span><span class="list-right">105 dB(A)</span></li>
<li class="clear-fix"><span class="list-left">Noise K factor</span><span class="list-right">3 dB(A)</span></li>
<li class="clear-fix"><span class="list-left">Net weight</span><span class="list-right">3.0 kg</span></li>
</ul>-->
<?php echo (isset($page[0]['spare_parts']) && !empty($page[0]['spare_parts']))?$page[0]['spare_parts']:'No Spare Parts found';?>
        </div>
        </div>
        <div id="three2" class="tab-container">
       <!-- ========-->
        <div class="Description2">
        <div class="list-flow">
        <div class="listing-wrap clear-fix">
        <?php if(count($product_video)>0){
		foreach($product_video as $val)	
		{	
		?>
        <div class="product-box">
        <iframe width="560" height="315" src="<?php echo $val['video_url'];?>" frameborder="0" allowfullscreen></iframe>
        </div>
       <?php }}else{ 
	     echo '<div class="product-box">No video found</div>';
	   }
	   ?>
        
        </div>
        
        </div>
        </div>
        <!--========-->
        
        </div>
        <div id="four2" class="tab-container">
        <div class="Description2">
            <ul class="bullet-pdf">
            <?php if(count($product_pdf)>0){
				  foreach($product_pdf as $val)	
				  {	
		    ?>
            	<li><a href="<?php echo base_url('assets/upload/tools_products/pdf/'.$val['pdf_name']); ?>" target="_blank" download><?php echo $val['title'];?></a></li>
            <?php }}else{
				
				echo '<li>No Pdf found</li>';
			}?>
            </ul>
        </div>
        </div>
        
      </div>



</div>

</div>
</div>
<?php $you_may_like = $this->all_function->get_recommend_tools($page[0]['cat_id'],$page[0]['id']);
if(count($you_may_like)>0){
?>
<div class="detail-row-02 clear-fix">
<div class="container">
<h2 class="block-title">YOU MAY ALSO LIKE...</h2>
<div class="list-flow">
<div class="listing-wrap clear-fix">

<?php foreach ($you_may_like as $key => $val){?>
<div class="product-box">
<div class="img-wrap">
<a href="<?php echo base_url('product/'.$val['seo_url']); ?>">
<img src="<?php echo base_url('assets/upload/tools_products/listing/'.$val['image_listing']); ?>" alt="">
<figcaption></figcaption>
</a>
</div>
<div class="bx-link-wrap">
<h2><a href="<?php echo base_url('product/'.$val['seo_url']); ?>">VIEW DETAILS</a></h2>
<a href="<?php echo base_url('contact-us/tools/'.$val['seo_url']);?>" class="link-cart"><img src="<?php echo image('cart-ic-01.png');?>" alt=""></a>
</div>
<div class="bx-container">
<a href="<?php echo base_url('product/'.$val['seo_url']);?>">
<h3><?php echo $val['product_name'];?></h3>
<!--<div class="info-table">
<ul>
<li>
<span class="lavle-01">Max. in steel </span>
<span class="lavle-02">13 mm</span>
</li>
<li>
<span class="lavle-01">Max. in masonry </span>
<span class="lavle-02"> 19 mm</span>
</li>
  <li>
<span class="lavle-01">Max. in wood	 </span>
<span class="lavle-02">30 mm</span>
</li>                         
    <li>
<span class="lavle-01">No Load Speed </span>
<span class="lavle-02"> H: 1300 / L: 1000 rpm</span>
</li>                     
                           
                     


</ul>
</div>-->
<?php echo $val['product_short_description'];?>
</a>
</div>
</div>
<?php }?>
</div>
</div>
</div>
</div>
 <?php }?>
 
<?php $item_viewed = $this->session->userdata('item_viewed'); 
if(!empty($item_viewed)){	?>
 
<div class="detail-row-03 clear-fix">
<div class="container">
<h2 class="block-title">RECENTLY VIEWED PRODUCTS</h2>
<div class="recent-view">
<div class="list-view clear-fix">
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
<?php }?>

</ul>
</div>
</div>


</div>
</div>
<?php } ?>
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