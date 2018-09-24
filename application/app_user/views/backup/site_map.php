<?php $this->load->view('include/header_tag'); ?>
<body>
<div id='bigmain'>
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class='maincontent'>
    <div class="container">
      <h3 class='title-5'><?php echo $page[0]['page_heading'];?></h3>
      <div class="pagelisting">
        <h3 class='title-5'>Pages</h3>
        <ul class="menusub">
          <?php foreach ($main_pages as $key => $val){?>
          <li><a href="<?php echo base_url($val['url_name']); ?>"><?php echo $val['menu_title']; ?></a></li>
          <?php }?>
        </ul>
        <div class="clear"></div>
        <h3 class='title-5'>Main Pages</h3>
        <ul class="menusub">
          <?php foreach ($store_pages as $key => $val){?>
          <li><a href="<?php echo base_url($val['seo_url']); ?>"><?php echo $val['menu_name']; ?></a></li>
          <?php }?>
        </ul>
        <div class="clear"></div>
        <h3 class='title-5'>Categories Pages</h3>
        <ul class="menusub">
          <?php foreach ($subcat_pages as $key => $val){?>
          <li><a href="<?php echo base_url('categories/'.$val['store_id'].'/'.$val['id']); ?>"><?php echo $val['menu_name']; ?></a></li>
          <?php }?>
        </ul>
        <div class="clear"></div>
        <h3 class='title-5'>Products Pages</h3>
        <ul class="menusub">
          <?php foreach ($product_pages as $key => $val){?>
          <li><a href="<?php echo base_url('product-detail/'.$val['id']); ?>"><?php echo $val['product_name']; ?></a></li>
          <?php }?>
        </ul>
      </div>
      <div class='box3'>
        <h3 class="title-3"><span>Glossary</span></h3>
        <ul class="box3-item">
          <?php foreach ($glossary as $key => $val){?>
          <li><a href="#"><img src="<?php echo base_url('assets/upload/glossary/original/'.$val['image_name']); ?>" alt=""/></a>
            <div class="showpopup">
              <h3><?php echo $val['title'];?></h3>
              <p><?php echo $val['content'];?></p>
            </div>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
<?php echo js('jquery-1.8.3.min') ?> <?php echo js('bootstrap.min') ?> <?php echo js('plugins') ?>
</body>
</html>