<?php $this->load->view('include/header_tag'); ?>
<body>
<script>
function add_enquiry_cart() {
	
	jQuery.ajax({
				type: "POST",
				dataType: "html",
				url: "<?php echo base_url('ajax-add-enquiry-cart'); ?>",
				data: {products_id : <?php echo $page[0]['id'];?> <?php foreach ($products_options as $key => $val):
						echo ', options_'.$val['products_options_id'].' : jQuery("#options_'.$val['products_options_id'].'").val()';
						endforeach; ?>},
				success: function(data) { 
				jQuery('.allitemt').html('').append(data); 
				get_cart_item();
				jQuery( '.enquiry_cart' ).append( '<span class="send">This item is successfully added.</span>' );
				setTimeout(function(){jQuery('.enquiry_cart span').fadeOut();}, 1500);
				 },
				error: function(xhr, ajaxOptions, thrownError) {
					jQuery( '.enquiry_cart' ).append( '<span class="error">This item is not added.</span>' );
					setTimeout(function(){jQuery('.enquiry_cart span').fadeOut();}, 1500);
					//alert(thrownError);
					}
	});			
}
</script> 
<script type="text/javascript">
$(document).ready(function(){
    $(".Thumb_wrap .carousel a").click(function(e) {
  e.preventDefault();
  $("#View_image").attr("src", $(this).attr("href"));
  $("a").removeClass("active");
  $(this).addClass("active");
})
});
</script>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_product_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"><a href="<?php echo base_url('/'); ?>" class="home"></a><a href="<?php echo base_url('search-by-category'); ?>">Shop</a><a class="diable"><?php echo $page[0]['product_name'];?></a></div>
        <div class="detail_wrap">
          <div class="detail_left">
            <div class="view_image"> <img src="<?php echo base_url('assets/upload/products/big/'.$page[0]['image_name']);?>" id="View_image"> </div>
            <?php $product_images = $this->all_function->get_product_images($page[0]['id']);
if(count($product_images)>0){?>
            <div class="Thumb_wrap">
              <div class="d-carousel-thumb">
                <ul class="carousel">
                  <li>
                    <div class="thumb_box"><a href="<?php echo base_url('assets/upload/products/big/'.$page[0]['image_name']); ?>" class="active"><img src="<?php echo base_url('assets/upload/products/thumb/'.$page[0]['image_name']); ?>" alt=""></a></div>
                  </li>
                  <?php foreach ($product_images as $key => $val): ?>
                  <li>
                    <div class="thumb_box"><a href="<?php echo base_url('assets/upload/products/big/'.$val['image_name']); ?>" ><img src="<?php echo base_url('assets/upload/products/thumb/'.$val['image_name']); ?>" alt=""></a></div>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <?php }?>
          </div>
          <div class="detail_right">
            <div class="tabs">
              <ul class="tabNavigation">
                <li><a href="#one">product description</a></li>
                <li><a href="#two">specifications</a></li>
              </ul>
              <div id="one" class="one">
                <div class="Description">
                  <h2><?php echo $page[0]['product_name'];?>:</h2>
                  <!--<span class="price">$<?php echo $page[0]['price'];?></span>-->
                  <article><?php echo $page[0]['product_description'];?></article>
                  <?php foreach ($products_options as $key => $val):
    
    $options_values =  $this->all_function->get_products_options_values($val['products_options_id'],$page[0]['id']);
	
	if(count($options_values)>0){?>
                  <div class="qty">
                    <label><?php echo $val['products_options_name'] ?>:</label>
                    <div class="qty_wrp">
                      <select name="options_<?php echo $val['products_options_id']; ?>" id="options_<?php echo $val['products_options_id']; ?>">
                        <?php foreach ($options_values as $key => $val):?>
                        <option value="<?php echo $val['products_options_values_name'] ?>"><?php echo $val['products_options_values_name'] ?></option>
                        <?php endforeach;  ?>
                      </select>
                    </div>
                  </div>
                  <?php } endforeach; ?>
                </div>
              </div>
              <div id="two" class="one">
                <div class="specifications"> <?php echo $page[0]['product_specifications'];?> </div>
              </div>
            </div>
            <button type="submit" class="addto_enquire" onClick="add_enquiry_cart();">Add to enquire</button>
            <div class="clear"></div>
            <div class="enquiry_cart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $you_may_like = $this->all_function->get_recommend($page[0]['cat_id'],$page[0]['id']);
if(count($you_may_like)>0){
	if(count($you_may_like)<=8){?>
  <section class="recently_view">
    <div class="center">
      <h2><a class="popup-with-recently-viewed" href="#you-may-like-details" >you may also like</a></h2>
      <div class="carusal_wrap2">
        <div class="NotCarousel">
          <ul>
            <?php foreach ($you_may_like as $key => $val){?>
            <li>
              <div class="viewed"><a href="<?php echo base_url('product/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/products/viewed/'.$val['image_name']); ?>" alt=""></a></div>
            </li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <?php }else{?>
  <section class="recently_view">
    <div class="center">
      <h2><a class="popup-with-recently-viewed" href="#you-may-like-details" >you may also like</a></h2>
      <div class="carusal_wrap2">
        <div class="d-carousel">
          <ul class="carousel">
            <?php foreach ($you_may_like as $key => $val){?>
            <li>
              <div class="viewed"><a href="<?php echo base_url('product/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/products/viewed/'.$val['image_name']); ?>" alt=""></a></div>
            </li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <?php }}?>
  <?php $item_viewed = $this->session->userdata('item_viewed'); 
if(!empty($item_viewed)){
	if(count($item_viewed)<=8){?>
  <section class="recently_view">
    <div class="center">
      <h2><a class="popup-with-recently-viewed" href="#recently-viewed-details" >Recently viewed</a></h2>
      <div class="carusal_wrap2">
        <div class="NotCarousel">
          <ul>
            <?php foreach ($item_viewed as $key => $val){
$image_name = $this->all_function->get_item_viewed($val['products_id']);
?>
            <li>
              <div class="viewed"><a href="<?php echo base_url($val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/products/viewed/'.$image_name); ?>" alt=""></a></div>
            </li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <?php }else{?>
  <section class="recently_view">
    <div class="center">
      <h2><a class="popup-with-recently-viewed" href="#recently-viewed-details" >Recently viewed</a></h2>
      <div class="carusal_wrap2">
        <div class="d-carousel">
          <ul class="carousel">
            <?php foreach ($item_viewed as $key => $val){
$image_name = $this->all_function->get_item_viewed($val['products_id']);
?>
            <li>
              <div class="viewed"><a href="<?php echo base_url($val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/products/viewed/'.$image_name); ?>" alt=""></a></div>
            </li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <?php }}?>
  <?php echo css('carusal_logo') ?>
  <?php $this->load->view('include/footer'); ?>
</div>
<div id="you-may-like-details" class="mfp-hide white-popup-block">
  <div class="from_wrap">
    <h2>You may also like</h2>
    <?php if(!empty($you_may_like)){?>
    <ul class="item_viewed">
      <?php foreach ($you_may_like as $key => $val){?>
      <li>
        <div class="viewed"><a href="<?php echo base_url('product/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/products/viewed/'.$val['image_name']); ?>" alt=""></a></div>
      </li>
      <?php }?>
    </ul>
    <div class="clear"></div>
    <?php }?>
  </div>
</div>
<div id="recently-viewed-details" class="mfp-hide white-popup-block">
  <div class="from_wrap">
    <h2>Recently viewed</h2>
    <?php $item_viewed = $this->session->userdata('item_viewed'); 
if(!empty($item_viewed)){?>
    <ul class="item_viewed">
      <?php foreach ($item_viewed as $key => $val){
    $image_name = $this->all_function->get_item_viewed($val['products_id']);
    ?>
      <li>
        <div class="viewed"><a href="<?php echo base_url('product/'.$val['products_id']); ?>"><img src="<?php echo base_url('assets/upload/products/viewed/'.$image_name); ?>" alt=""></a></div>
      </li>
      <?php }?>
    </ul>
    <div class="clear"></div>
    <?php }?>
  </div>
</div>
<?php echo css('carusal_logoS') ?>
</body>
</html>