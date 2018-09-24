<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
  <div class="wrap-bred">
    <div class="container">
      <div class="bred-camb"><a href="<?php echo base_url('/'); ?>">HOME</a><span class="seprster ">/</span>
      <a href="#">ACCESORIES</a><span class="seprster ">/</span>
      <a href="<?php echo base_url('accessoriescat/'.$parent_cat['seo_url']);?>"><?php echo $parent_cat['cat_name']?></a><span class="seprster ">/</span>
      <a href="<?php echo base_url('accessories-sub-cat/'.$page[0]['seo_url']);?>"><?php echo $page[0]['cat_name'];?></a><span class="seprster ">/</span>
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
          <img src="<?php echo base_url('assets/upload/products/details/'.$page[0]['image_name']);?>" id="View_image"> 
          </div>
          <?php $product_images = $this->all_function->get_product_images($page[0]['id']); ?>
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
            <div class="thumb_box"><a href="<?php echo base_url('assets/upload/products/details/'.$page[0]['image_name']); ?>" class="active"><img src="<?php echo base_url('assets/upload/products/thumb/'.$page[0]['image_name']); ?>" alt=""></a></div>
            </li>
            <?php } ?>
            <?php foreach ($product_images as $key => $val): ?>
            <li>
            <div class="thumb_box"><a href="<?php echo base_url('assets/upload/products/details/'.$val['image_name']); ?>"><img src="<?php echo base_url('assets/upload/products/thumb/'.$val['image_name']); ?>" alt=""></a></div>
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
          
          <?php }elseif($this->all_function->get_site_options('acczoomer')){?>
                
          <div class="view_image1"> 
          <img src="<?php echo base_url('assets/upload/products/details/'.$page[0]['image_name']);?>" id="view123"> 
          </div>
          <?php $product_images = $this->all_function->get_product_images($page[0]['id']); ?>
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
            <a href="#" class="active" data-image="<?php echo base_url('assets/upload/products/details/'.$page[0]['image_name']); ?>" data-zoom-image="<?php echo base_url('assets/upload/products/original/'.$page[0]['image_name']); ?>"><img src="<?php echo base_url('assets/upload/products/thumb/'.$page[0]['image_name']); ?>"  alt=""></a>
            </div>
            </li>
            <?php } ?>
            <?php foreach ($product_images as $key => $val): ?>
            <li>
            <div class="thumb_box"><a href="#" data-image="<?php echo base_url('assets/upload/products/details/'.$val['image_name']); ?>" data-zoom-image="<?php echo base_url('assets/upload/products/original/'.$val['image_name']); ?>"><img src="<?php echo base_url('assets/upload/products/thumb/'.$val['image_name']); ?>" alt="" ></a></div>
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
          <img src="<?php echo base_url('assets/upload/products/details/'.$page[0]['image_name']);?>" id="View_image"> 
          </div>
          <?php $product_images = $this->all_function->get_product_images($page[0]['id']); ?>
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
            <div class="thumb_box"><a href="<?php echo base_url('assets/upload/products/details/'.$page[0]['image_name']); ?>" class="active"><img src="<?php echo base_url('assets/upload/products/thumb/'.$page[0]['image_name']); ?>" alt=""></a></div>
            </li>
            <?php } ?>
            <?php foreach ($product_images as $key => $val): ?>
            <li>
            <div class="thumb_box"><a href="<?php echo base_url('assets/upload/products/details/'.$val['image_name']); ?>"><img src="<?php echo base_url('assets/upload/products/thumb/'.$val['image_name']); ?>" alt=""></a></div>
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
            <div class="table-detail">
              <div class="table-wrap">
                <?php echo $page[0]['product_specifications'];?>
              </div>
            </div>
            <div class="btn-wrap  clear-fix">
              <form action="<?php echo base_url('contact-us/accessories/'.$page[0]['p_seo_url']);?>" method="get">
                <button type="submit" class="addto_enquire">ADD TO ENQUIRY</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php $you_may_like = $this->all_function->get_recommend($page[0]['cat_id'],$page[0]['id']);
		 if(count($you_may_like)>0){
    ?>
    
    
    <div class="detail-row-02 clear-fix">
      <div class="container">
        <h2 class="block-title">YOU MAY ALSO LIKE...</h2>
        <div class="list-flow">
          <div class="listing-wrap clear-fix">
          <?php foreach ($you_may_like as $key => $val){?>
          		  
            <div class="product-box">
              <div class="img-wrap"> <a href="<?php echo base_url('accproduct/'.$val['seo_url']); ?>"> <img src="<?php echo base_url('assets/upload/products/listing/'.$val['image_listing']); ?>" alt="">
                <figcaption></figcaption>
                </a> </div>
              <div class="bx-link-wrap">
                <h2><a href="<?php echo base_url('accproduct/'.$val['seo_url']); ?>">VIEW DETAILS</a></h2>
                <a href="<?php echo base_url('contact-us/accessories/'.$val['seo_url']);?>" class="link-cart"><img src="<?php echo image('cart-ic-01.png');?>" alt=""></a> </div>
              <div class="bx-container"> <a href="<?php echo base_url('accproduct/'.$val['seo_url']); ?>">
                <h3><?php echo $val['product_name'];?></h3>
                <div class="info-table-text"><?php echo $val['product_description'];?></div>
                </a> </div>
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
            
            <?php } ?>
            
              
                
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