<?php $this->load->view('include/header_tag'); ?>
<body>
<div id='bigmain'>
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class='maincontent'>
    <div class="container">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li class="active"><?php echo $page[0]['menu_title'];?></li>
      </ol>
      <h3 class='title-5'><?php echo $page[0]['page_heading'];?></h3>
      <?php foreach ($faq as $key => $val): ?>
      <h3 class="faq"><?php echo $val['name'] ?></h3>
      <div><?php echo $val['content']; ?></div>
      <?php endforeach; ?>
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