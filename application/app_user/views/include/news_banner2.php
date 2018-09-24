<?php if($page[0]['image_banner']!=''){?>
<div class="bannerchild"> <img src="<?php echo base_url('assets/upload/latestnews/banner/thumb/'.$page[0]['image_banner']); ?>" alt=""/> </div>
<?php }else{?>
<div class="bannerchild"> <img src="<?php echo base_url('assets/upload/pagebanner/original/'.$pagemain[0]['image_name']); ?>" alt=""/> </div>
<?php }?>
