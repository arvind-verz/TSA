<?php if($page[0]['image_banner']!=''){?>
<section class="banner_wrap">
  <div class="center">
    <div class="inner_caption">
      <h2>Blog</h2>
    </div>
    <img src="<?php echo base_url('assets/upload/blog/categories/banner/original/'.$page[0]['image_banner']); ?>" alt=""/> </div>
</section>
<?php }else{?>
<section class="banner_wrap">
  <div class="center">
    <div class="inner_caption">
      <h2>Blog</h2>
    </div>
    <img src="<?php echo image('banner_03.jpg'); ?>" alt=""/> </div>
</section>
<?php }?>
