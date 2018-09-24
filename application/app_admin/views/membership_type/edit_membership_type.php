<?php $this->load->view('include/header_tag'); ?>
<body>

<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Join Us</a></li>
        <li><a href="<?php echo base_url('manage-membership-type'); ?>">Membership Types</a></li>
        <li>Manage Membership Types</li>
    </ul>
    
  <div class="gridMainbodyDiv">
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Edit Membership Types</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              
              <p>
                  <label for="first_name" >Title: <span>*</span> </label>
                  <input type="text" name="title" required id="title" value="<?php echo $details[0]['title']; ?>" class="sf" />
                </p>
              
              
              <p>
              <label for="product_specifications">Description: <span>*</span></label>
             <div class="body">
              <textarea name="description" id="bodyContent2" required><?php echo $details[0]['description']; ?></textarea>
             </div>
            </p>
              
              <p>
                  <label for="location">Registration form(pdf,doc,docx)  : <span>*</span></label>
                  <input type="file" name="registration_form"  id="registration_form" >
                  <input type="hidden" name="old_registration_form" value="<?php echo $details[0]['registration_form']; ?>">
              </p>
              <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/form/'.$details[0]['registration_form']) && $details[0]['registration_form']!='') {?>
                <p><?php echo $details[0]['registration_form']; ?></p>
            <?php }?>
              
               <p>
                  <label for="location">Full Corporate Membership <br>Application Form(pdf,doc,docx)   : <span>*</span></label>
                  <input type="file" name="full_corporate_form"  id="full_corporate_form" >
                  <input type="hidden" name="old_full_corporate_form" value="<?php echo $details[0]['full_corporate_form']; ?>">
              </p>
              <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/form/'.$details[0]['full_corporate_form']) && $details[0]['full_corporate_form']!='') {?>
                <p><?php echo $details[0]['full_corporate_form']; ?></p>
            <?php }?>
            
            <p>
                  <label for="location">Associate Corporate & <br>Individual Membership <br>Application Form(pdf,doc,docx)   :<span>*</span> </label>
                  <input type="file" name="associate_corporate_form"  id="associate_corporate_form" >
                  <input type="hidden" name="old_associate_corporate_form" value="<?php echo $details[0]['associate_corporate_form']; ?>">
              </p>
              <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/form/'.$details[0]['associate_corporate_form']) && $details[0]['associate_corporate_form']!='') {?>
                <p><?php echo $details[0]['associate_corporate_form']; ?></p>
            <?php }?>
            
            <div class="clear"><br></div> 
              
                           
              <p>
                <button type="reset" >Cancel</button>
                <button type="submit" value="update_form" name="update_form" >Submit</button>
              </p>
            </div>
          </form>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>