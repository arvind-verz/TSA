<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <!--<li><a>Enquiries</a></li>-->
        <li><a href="<?php echo base_url('manage-contact'); ?>">Contacts Us</a></li>
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
              
               <?php if($details['phone_no']!=''){?>
              <p>
                <label for="from_email" ><b>Telephone </b></label>
                <?php echo $details['phone_no'];?> </p>
              <?php }?>
              
              <?php if($details['company']!=''){?>
              <p>
                <label for="message" ><b>Company</b></label>
                <?php echo $details['company'];?> </p>
              <?php }?>
              <?php if($details['enquiry_type']!=''){?>
              <p>
                <label for="from_email" ><b>Type of Enquiry</b></label>
                <?php echo $details['enquiry_type'];?> </p>
              <?php }?>
              
              <?php if($details['message']!=''){?>
              <p>
                <label for="from_email" ><b>Enquiry Details</b></label>
                <?php echo $details['message'];?> </p>
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