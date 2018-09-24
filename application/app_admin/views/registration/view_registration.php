<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Events</a></li>
        <li><a href="<?php echo base_url('manage-registration'); ?>">Event Registration</a></li>
        <li>Event Registration details</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">View Event Registration 
		  <?php if($details['invoice']!='' && file_exists(ABSOLUTE_PATH.$details['invoice'])){?><a href="<?php echo SITE_URL.$details['invoice'];?>" target="_blank" class="button"><span>Invoice</span></a> <?php }?></h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <div class="form_default">
            <?php if($details['title']!=''){?>
              <p>
                <label for="subject" ><b>Event Name</b></label>
                <a href="<?php echo SITE_URL.'event-details/'.$details['seo_url'];?>" target="_blank"><?php echo $details['title'];?></a> </p>
              <?php }?>
            
            
              <?php if($details['first_name']!=''){?>
              <p>
                <label for="subject" ><b>First Name</b></label>
                <?php echo $details['first_name'];?> </p>
              <?php }?>
              
              <?php if($details['last_name']!=''){?>
              <p>
                <label for="subject" ><b>Last Name</b></label>
                <?php echo $details['last_name'];?> </p>
              <?php }?>
              
              <?php if($details['email']!=''){?>
              <p>
                <label for="telephone" ><b>Email</b></label>
                <?php echo $details['email'];?> </p>
              <?php }?>
              <?php if($details['user_name']!=''){?>
              <p>
                <label for="from_email" ><b>Member Id </b></label>
                <?php echo $details['user_name'];?> </p>
              <?php }?>
              
               <?php if($details['company_type']!=''){?>
              <p>
                <label for="from_email" ><b>Company Type </b></label>
                <?php echo $details['company_type'];?> </p>
              <?php }?>
              
              <?php if($details['company_email']!=''){?>
              <p>
                <label for="message" ><b>Company Email</b></label>
                <?php echo $details['company_email'];?> </p>
              <?php }?>
              
              <?php if($details['company_name']!=''){?>
              <p>
                <label for="from_email" ><b>Company Name  </b></label>
                <?php echo $details['company_name'];?> </p>
              <?php }?>
              
              <?php if($details['designation']!=''){?>
              <p>
                <label for="from_email" ><b>Designation </b></label>
                <?php echo $details['designation'];?> </p>
              <?php }?>
              
              <?php if($details['phone_no']){?>
              <p>
                <label for="from_email" ><b>Contact Number  </b></label>
                <?php echo $details['phone_no'];?> </p>
              <?php }?>
              
              <?php if($details['promo_code']){?>
              <p>
                <label for="from_email" ><b>Promo Code </b></label>
                <?php echo $details['promo_code'];?> </p>
              <?php }?>
              
               <?php if($details['billing_address']){?>
              <p>
                <label for="from_email" ><b>Billing Address  </b></label>
                <?php echo $details['billing_address'];?> </p>
              <?php }?>
              <?php if($details['comments']){?>
              <p>
                <label for="from_email" ><b>Additional Comments  </b></label>
                <?php echo $details['comments'];?> </p>
              <?php }?>
              
              <?php if($details['price']){?>
              <p>
                <label for="from_email" ><b>Price</b></label>
                <?php echo 'S$'.$details['price'];?> </p>
              <?php }?>
              
              <?php if($details['payment_type']){?>
              <p>
                <label for="from_email" ><b>Payment Type</b></label>
                <?php echo $details['payment_type'];?> </p>
              <?php }?>
              <?php if($details['payment_type']=='Offline'){?>
              <p>
                <label for="from_email" ><b>Offline Payment Comment</b></label>
                <?php echo $details['offline_payment'];?> </p>
              <?php }?>
              <?php if($details['is_paid']){?>
              <p>
                <label for="from_email" ><b>Payment Status</b></label>
                <?php echo $details['is_paid'];?> </p>
              <?php }?>
              <?php if($details['booking_status']){?>
              <p>
                <label for="from_email" ><b>Booking Status</b></label>
                <?php if($details['booking_status']=='Y'){echo 'Approved';}elseif($details['booking_status']=='N'){echo 'Pending';}elseif($details['booking_status']=='R'){echo 'Rejected';}?> </p>
              <?php }?>
              <?php if($details['create_date']){?>
              <p>
                <label for="from_email" ><b>Date  </b></label>
                <?php echo date('jS M Y h:i:s A', strtotime($details['create_date']));?> </p>
              <?php }?>
              <?php if($details['payment_type']=='Paypal'){?>
              <?php  $paypalInfo = $this->Registration_model->get_paypal_transaction_details($details['id'],$details['event_id']); ?>
              <table style="width:50%;" cellspacing="0" cellpadding="0">
              <tr>
                <td>Transaction Type</td>
                <td><?php echo $paypalInfo['transaction_type'];?></td>
              </tr>
              <tr>
                <td>Transaction ID</td>
                <td><?php echo $paypalInfo['transaction_id'];?></td>
              </tr>
              <tr>
                <td>Payment Status</td>
                <td><?php echo $paypalInfo['payment_status'];?></td>
              </tr>
              <tr>
                <td>Payment Amount</td>
                <td><?php echo $paypalInfo['payment_amount'];?></td>
              </tr>
              <tr>
                <td>Payment Currency</td>
                <td><?php echo $paypalInfo['payment_currency'];?></td>
              </tr>
              <tr>
                <td>Receiver Email</td>
                <td><?php echo $paypalInfo['receiver_email'];?></td>
              </tr>
              <tr>
                <td>Payer Email</td>
                <td><?php echo $paypalInfo['payer_email'];?></td>
              </tr>
              <tr>
                <td>Payment Date</td>
                <td><?php echo $paypalInfo['payment_date'];?></td>
              </tr>
              <tr>
                <td>Paypal Mode</td>
                <td><?php if($paypalInfo['test_ipn']=='1'){echo 'Test';}else{echo 'Live';}?></td>
              </tr>
            </table>
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