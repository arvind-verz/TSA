<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Enquiries</a></li>
        <li><a href="<?php echo base_url('manage-tools-contact'); ?>">Tools Enquiries</a></li>
        <li>Enquiry details</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">View Contacts</h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <div class="form_default">
            
              <?php if($details['product_name']!=''){?>
              <p>
                <label for="subject" ><b>Product Name</b></label>
                <?php echo $details['product_name'];?> </p>
              <?php }?>
            
              <?php if($details['salutation']!=''){?>
              <p>
                <label for="subject" ><b>Salutation</b></label>
                <?php echo $details['salutation'];?> </p>
              <?php }?>
              <?php if($details['name']!=''){?>
              <p>
                <label for="telephone" ><b>Name</b></label>
                <?php echo $details['name'];?> </p>
              <?php }?>
              <?php if($details['email']!=''){?>
              <p>
                <label for="from_email" ><b>Email </b></label>
                <?php echo $details['email'];?> </p>
              <?php }?>
              
               <?php if($details['telephone']!=''){?>
              <p>
                <label for="from_email" ><b>Telephone </b></label>
                <?php echo $details['telephone'];?> </p>
              <?php }?>
              
              <?php if($details['mobile_no']!=''){?>
              <p>
                <label for="message" ><b>Mobile</b></label>
                <?php echo $details['mobile_no'];?> </p>
              <?php }?>
              <?php if($details['subject']!=''){?>
              <p>
                <label for="from_email" ><b>Subject </b></label>
                <?php echo $details['subject'];?> </p>
              <?php }?>
              
              <?php if($details['message']!=''){?>
              <p>
                <label for="from_email" ><b>Comments  </b></label>
                <?php echo $details['message'];?> </p>
              <?php }?>
              
              <?php if($details['country_name']){?>
              <p>
                <label for="from_email" ><b>Country  </b></label>
                <?php echo $details['country_name'];?> </p>
              <?php }?>
              
              <?php if($details['create_date']){?>
              <p>
                <label for="from_email" ><b>Date  </b></label>
                <?php echo date('jS M Y h:i:s A', strtotime($details['create_date']));?> </p>
              <?php }?>
              
              
            </div>
          </div>
        </div>
        <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>