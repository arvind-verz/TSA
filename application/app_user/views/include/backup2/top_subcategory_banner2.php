<?php if($page[0]['image_banner']!=''){?>
<div class="banner-wrap">
<div class="caption-inner">
<div class="container">
<?php echo $page[0]['banner_heading']; ?>
</div>
</div>
<img src="<?php echo base_url('assets/upload/tools_categories/banner/original/'.$page[0]['image_banner']); ?>" alt="" class="imageResponsive">
</div>
<?php }else{?>
<div class="banner-wrap">
<div class="caption-inner">
<div class="container">
<h2>Donec rutrum </h2>
<article>Curabitur arcu erat, accumsan id imperdiet et, porttitor<br>
 at sem. Cras ultricies ligula sed magna dictum porta.
</article></div>
</div>
<img src="<?php echo image('banner-tools.jpg'); ?>" alt="" class="imageResponsive">
</div>
<?php }?>