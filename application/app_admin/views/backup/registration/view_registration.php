<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Enquiries</a></li>
        <li><a href="<?php echo base_url('manage-registration'); ?>">Warranty Registration</a></li>
        <li>Enquiry details</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">View Warranty Registration</h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <div class="form_default">
              <?php if($details['name']!=''){?>
              <p>
                <label for="subject" ><b>Name</b></label>
                <?php echo $details['name'];?> </p>
              <?php }?>
              <?php if($details['email']!=''){?>
              <p>
                <label for="telephone" ><b>Email</b></label>
                <?php echo $details['email'];?> </p>
              <?php }?>
              <?php if($details['address']!=''){?>
              <p>
                <label for="from_email" ><b>Address </b></label>
                <?php echo $details['address'];?> </p>
              <?php }?>
              
               <?php if($details['date_of_purchase']!=''){?>
              <p>
                <label for="from_email" ><b>Date Of Purchase </b></label>
                <?php echo $details['date_of_purchase'];?> </p>
              <?php }?>
              
              <?php if($details['mobile_no']!=''){?>
              <p>
                <label for="message" ><b>Mobile</b></label>
                <?php echo $details['mobile_no'];?> </p>
              <?php }?>
              <?php if($details['serial_no']!=''){?>
              <p>
                <label for="from_email" ><b>Serial No </b></label>
                <?php echo $details['serial_no'];?> </p>
              <?php }?>
              
              <?php if($details['dealer_name']!=''){?>
              <p>
                <label for="from_email" ><b>Dealer Name  </b></label>
                <?php echo $details['dealer_name'];?> </p>
              <?php }?>
              
              <?php if($details['model']){?>
              <p>
                <label for="from_email" ><b>Model  </b></label>
                <?php echo $details['model'];?> </p>
              <?php }?>
              
              <?php if($details['hear_about']){?>
              <p>
                <label for="from_email" ><b>How do you hear  </b></label>
                <?php echo $details['ha_name'];?> </p>
              <?php }?>
              
               <?php if($details['why_choose']){?>
              <p>
                <label for="from_email" ><b>Why did you choose  </b></label>
                <?php echo $details['wc_name'];?> </p>
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