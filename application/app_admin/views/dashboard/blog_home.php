<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <div class="gridMainbodyDiv">
    <?php $this->load->view('include/leftmenu'); ?>
    <?php $user_id = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_id'];?>
    <div class="MainDiv">
      <div class="leftPanel">
        <div class="clear"></div>
        <div class="articleBox">
          <h3 class="Box_title">Blog</h3>
          <div class="leftImg"><img src="<?php echo image('ico_05.png'); ?>"/></div>
          <div class="rightMenu">
            <ul>
              <li><a href="<?php echo base_url('manage-blog'); ?>" >Blog</a></li>
              <li><a href="<?php echo base_url('manage-blog-cat'); ?>" >Categories</a></li>
              <li><a href="<?php echo base_url('manage-comments'); ?>" >Comments</a></li>
            </ul>
          </div>
        </div>  
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>