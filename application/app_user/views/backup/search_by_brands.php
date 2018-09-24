<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"><a href="<?php echo base_url('/'); ?>" class="home"></a><a class="diable">
          <?php 
if(isset($page[0]['menu_title'])){
echo $page[0]['menu_title'];}else{
echo $page[0]['page_heading'];
}
?>
          </a></div>
        <div class="listing_wrap">
          <?php if(count($brands)>0){?>
          <div class="col_left">
            <h2>Brand</h2>
            <div class="menu_brand">
              <ul>
                <?php foreach ($brands as $key => $val): ?>
                <li><a href="<?php echo base_url('brands/'.$val['seo_url']); ?>"><?php echo $val['brands_name'];?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="col_right">
            <div class="listing" id="brands">
              <?php foreach ($brands as $key => $val): ?>
              <div class="product_box">
                <figure>
                  <div class="hover_click"> <a href="<?php echo base_url('brands/'.$val['seo_url']); ?>" class=" btn_brabd">view products</a> </div>
                  <img src="<?php echo base_url('assets/upload/brands/original/'.$val['image_name']); ?>" alt=""></figure>
                <h2><?php echo $val['brands_name'];?></h2>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php }else{?>
          <h1 class="page_title">Brand</h1>
          <div class="about_content">
            <h2>Brand not found.</h2>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/footer'); ?>
</div>
</body>
</html>