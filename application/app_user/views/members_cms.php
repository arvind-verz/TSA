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
            <li class="active">Our Members</li>
          </ol>
          <h3 class="t-header-cnt">Our Members </h3>
          <div class="tab-content" id="tab-1"> <a href="#" class="btn-nav">Navigation</a>
            <div class="mb-tab">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab1" aria-controls="FULL CORPORATE" role="tab" data-toggle="tab">FULL CORPORATE</a></li>
                <li role="presentation"><a href="#tab2" aria-controls="CORPORATE" role="tab" data-toggle="tab">ASSOCIATE CORPORATE</a></li>
                <li role="presentation"><a href="#tab3" aria-controls="INDIVIDUAL" role="tab" data-toggle="tab">ASSOCIATE INDIVIDUAL</a></li>
                <li role="presentation"><a href="#tab4" aria-controls="OTHERS" role="tab" data-toggle="tab">OTHERS</a></li>
              </ul>
            </div>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="tab1">
                <div class="document subtab-1 hidecontent" style="display:block" id='subtab-1'>
                  <div class="row"> <?php echo $mc['full_corporate1'];?> </div>
                </div>
                <div class="document subtab-2 hidecontent" id='subtab-2'>
                  <div class="row"> <?php echo $mc['full_corporate2'];?> </div>
                </div>
                <div class="page-bottom"> <a href="#tab-1" class="showradio active" data-rel="subtab-1">A - L</a> <a href="#tab-1" class="showradio" data-rel="subtab-2">M - Z </a> </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="tab2">
                <div class="document subtab-3 hidecontent" style="display:block" id='subtab-3'>
                  <div class="row"> <?php echo $mc['associate_corporate1'];?> </div>
                </div>
                <div class="document subtab-4 hidecontent" id='subtab-4'>
                  <div class="row"> <?php echo $mc['associate_corporate2'];?> </div>
                </div>
                <div class="page-bottom"> <a href="#tab-1" class="showradio active" data-rel="subtab-3">A - L</a> <a href="#tab-1" class="showradio" data-rel="subtab-4">M - Z </a> </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="tab3">
                <div class="document">
                  <div class="row"> <?php echo $mc['associate_individual'];?> </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="tab4">
                <div class="document">
                  <div class="row"> <?php echo $mc['others'];?> </div>
                </div>
              </div>
            </div>
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