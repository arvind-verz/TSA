<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="childpage">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="mainchild">
    <div class="container maincontent">
      <div class="row">
        <div class="col-md-3">
          <div class="t-header-3"> JOIN US </div>
          <?php $this->load->view('include/why_join_us_left'); ?>
        </div>
        <div class="col-md-9 rightpage">
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
            <li><a href="<?php echo base_url('membership-types'); ?>">JOIN US</a></li>
            <li class="active"><?php echo $page[0]['page_heading'];?></li>
          </ol>
          <h3 class="t-header-cnt"> <?php echo $page[0]['page_heading'];?> </h3>
          <div class="document"> <?php echo $page[0]['page_content'];?> </div>
          <?php if(isset($join_us)){echo $join_us;}?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- //page -->

<?php $this->load->view('include/footer'); ?>
<?php echo js('jquery.min'); ?> <?php echo js('plugin'); ?> <?php echo js('main'); ?>
</body>
</html>