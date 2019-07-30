<?php echo $page[0]['page_content']; ?>

<div class="main-container"><!-- Section -->
<div class="fullcontainer">
<div class="container">
<div class="inner-container-md">
<?php echo $page[0]['page_content']; ?>
<div class="testimonial-grid">
<?php  
$i=0;
foreach($testimonials as $test): $i++;
if($i%2==0){
?>
<div class="testimonial-box">
<div class="row animatedParent" data-sequence="300">
<div class="col-sm-3 animated fadeInLeft go" data-id="1">
<div class="text-center row-inner-sm">
<div class="student-img"><?php if($test['image_name']!=""){?>
<img class="responsive" src="<?php echo base_url("assets/files/testimonial/".$test['image_name']);?>" alt="" />
<?php }?></div>
</div>
</div>
<div class="col-sm-9 animated fadeInRight go" data-id="2">
<div class="student-testi">
<?=$test['content']?>
<p class="txt-dark size18"><strong><?=$test['title']?></strong></p>
</div>
</div>
</div>
</div>	
<?php }else{?>
<div class="testimonial-box">
<div class="row animatedParent" data-sequence="300">
<div class="col-sm-3 animated fadeInRight pull-right sm" data-id="1">
<div class="text-center row-inner-sm">
<div class="student-img">
<?php if($test['image_name']!=""){?>
<img class="responsive" src="<?php echo base_url("assets/files/testimonial/".$test['image_name']);?>" alt="" />
<?php }?>
</div>
</div>
</div>
<div class="col-sm-9 animated fadeInLeft pull-left sm" data-id="2">
<div class="student-testi">
<?=$test['content']?>
<p class="txt-dark size18"><strong><?=$test['title']?></strong></p>
</div>
</div>
</div>
</div>
<?php } endforeach;?>	
</div>
</div>
</div>
</div>
<!-- Section END --></div>