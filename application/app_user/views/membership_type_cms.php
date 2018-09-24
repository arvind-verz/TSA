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
            <li class="active"><?php echo $mt['title'];?></li>
          </ol>
          <h3 class="t-header-cnt"> <?php echo $mt['title'];?> </h3>
          <div class="document"> <?php echo $mt['description'];?>            
            <p><a href="<?php echo base_url('assets/upload/form/'.$mt['full_corporate_form']);?>" class="link-down" download >Full Corporate Membership Application Form </a></p>
            <p><a href="<?php echo base_url('assets/upload/form/'.$mt['associate_corporate_form']);?>" class="link-down" download >Associate Corporate & Individual Membership Application Form</a></p>
          </div>
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