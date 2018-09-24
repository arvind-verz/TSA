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
          <?php if(count($category)>0){?>
          <div class="col_left">
            <h2>categories</h2>
            <div class="left_menu">
              <ul>
                <?php foreach ($category as $key => $val): ?>
                <li><a href="<?php echo base_url('category/'.$val['seo_url']);?>"><?php echo $val['cat_name'];?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="col_right">
            <div class="listing">
              <?php foreach ($category as $key => $val): ?>
              <div class="product_box">
                <figure>
                  <div class="hover_click"> <a href="<?php echo base_url('category/'.$val['seo_url']);?>">view details</a> </div>
                  <img src="<?php echo base_url('assets/upload/categories/original/'.$val['image_name']); ?>" alt=""></figure>
                <h2><?php echo $val['cat_name'];?></h2>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
          <?php }else{?>
          <h1 class="page_title">Categories</h1>
          <div class="about_content">
            <h2>Category not found.</h2>
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