<?php $this->load->view('include/header_tag'); ?>
<body>
<div id='bigmain'>
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class='maincontent'>
    <div class="container">
      <h3 class='title-5'><?php echo $page[0]['page_heading'];?></h3>
      <?php if(isset($msg_form)){echo '<div class="contactForm">'.$msg_form.'</div>';}?>
      <?php echo $page[0]['page_content'];?>
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