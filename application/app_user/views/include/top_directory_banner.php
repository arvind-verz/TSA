<?php if($page[0]['image_banner']!=''){?>
<div class="bannerchild"> <img src="<?php echo base_url('assets/upload/rdirectory/banner/thumb/'.$page[0]['image_banner']); ?>" alt=""/> </div>
<?php }else{?>
<div class="bannerchild"> <img src="<?php echo image('banner-detail.jpg'); ?>" alt=""/> </div>
<?php }?>
