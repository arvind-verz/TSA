<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Settings</a></li>
        <li><a href="<?php echo base_url('manage-email-templates'); ?>">Email Templates</a></li>
        <li>Edit Email Templates</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="leftPanel">
      <h1 class="pageTitle">Edit Email Template :: <?php echo $template_name;?></h1>
      <div class="From_wrap">
        <?php $this->load->view('include/message'); ?>
        <form method="post" action="" id="edit_email_templates">
          <div class="form_default">
            <p>
              <label for="subject" >Subject : <span>*</span></label>
              <input type="text" name="subject" required id="subject" value="<?php echo $subject;?>" class="sf" />
            </p>
            <p>
              <label for="from_email" >Parameter Description </label>
              <textarea name="parameter_desc" readonly style="width:400px; min-height:200px; background:#ccc;" id="parameter_desc"><?php echo $parameter_desc;?></textarea>
            </p>
            <label for="from_email" >Email Body : <span>*</span></label>
            <div class="body">
              <textarea name="body" id="bodyContent"><?php echo $body;?></textarea>
            </div>
            <p>
              <button type="reset" >Reset</button>
              <button type="submit" value="edit_email_templates" name="edit_email_templates">Submit</button>
            </p>
          </div>
        </form>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>