<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"><a href="<?php echo base_url('/'); ?>" class="home"></a><a class="diable">Dashbord</a></div>
        <div class="clear"></div>
        <div class="listing_wrap">
          <?php $this->load->view('member/member_left'); ?>
          <div class="col_right">
          	<h1 class="page_title">Dashbord</h1>
            <p>Name: <strong><?php echo $member_info['first_name'].' '.$member_info['last_name'];?></strong></p>
            <p>Email: <strong><?php echo $member_info['email'];?></strong></p>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/footer'); ?>
</div>
</body>
</html>