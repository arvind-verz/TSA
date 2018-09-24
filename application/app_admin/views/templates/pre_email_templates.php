<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Settings</a></li>
        <li><a href="<?php echo base_url('manage-email-templates'); ?>">Email Templates</a></li>
        <li>View Email Templates</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Email Template :: <?php echo $template_name;?></h1>
          <?php $this->load->view('include/message'); ?>
          <strong><?php echo $subject;?></strong> <br/>
          <br/>
          <?php echo $body;?> </div>
        <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>