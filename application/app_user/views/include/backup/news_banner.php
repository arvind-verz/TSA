<?php if($page[0]['image_banner']!=''){?>
<div class="banner-wrap">
<img src="<?php echo base_url('assets/upload/news/banner/original/'.$page[0]['image_banner']); ?>" alt="" class="imageResponsive">
</div>
<?php }else{?>
<div class="banner-wrap">
<img src="<?php echo base_url('assets/upload/pagebanner/original/'.$page1[0]['image_name']); ?>" alt="" class="imageResponsive">
</div>
<?php }?>