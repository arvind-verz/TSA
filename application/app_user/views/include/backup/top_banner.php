<?php if($page[0]['image_name']!=''){?>
<div class="banner-wrap">
<img src="<?php echo base_url('assets/upload/pagebanner/original/'.$page[0]['image_name']); ?>" alt="" class="imageResponsive">
</div>
<?php }else{?>
<div class="banner-wrap">
<img src="<?php echo image('banner-cart.jpg'); ?>" alt="" class="imageResponsive">
</div>
<?php }?>