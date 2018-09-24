<?php if($page[0]['image_banner']!=''){?>
<div class="banner-wrap">
<img src="<?php echo base_url('assets/upload/brands/banner/original/'.$page[0]['image_banner']); ?>" alt="" class="imageResponsive">
</div>
<?php }else{?>
<div class="banner-wrap">
<img src="<?php echo image('banner-product.jpg'); ?>" alt="" class="imageResponsive">
</div>
<?php }?>
