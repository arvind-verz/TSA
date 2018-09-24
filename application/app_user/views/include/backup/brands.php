<?php if(count($brands)>0){?>
<section class="brand">
  <div class="center">
    <h2>our brands</h2>
    <div class="carusal_wrap">
      <div class="d-carousel">
        <ul class="carousel">
          <?php foreach ($brands as $key => $val): ?>
          <li>
            <div class="logo_wrap"><a href="<?php echo base_url('brands/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/brands/original/'.$val['image_name']); ?>" alt=""></a></div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php }?>