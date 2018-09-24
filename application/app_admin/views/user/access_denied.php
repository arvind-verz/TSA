<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="Body"> 
  <?php $this->load->view('include/header'); ?>
  <div class="clear_12"></div>
  <div id="Canvas"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="body_right">
      <h1 class="Title_01">Access Denied </h1>
      <div class="From_wrap"> <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <center>
          <span class="worning">You are not currently allowed this request.<br>
          Please contact to the Administrator.</span>
        </center>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
      </div>
      
      <!--maincontent--> 
      
      <!-- footer -->
      <?php $this->load->view('include/footer'); ?>
      <!-- footer --> 
      
    </div>
    <div class="clear"></div>
  </div>
</div>
</body>
</html>