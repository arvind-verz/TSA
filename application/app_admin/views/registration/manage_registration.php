<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Events</a></li>
        <li>Event Registration</li>
  </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage Event Registration<!--<a href="<?php echo base_url('export-registration'); ?>" class="button"><span>Export Contacts</span> </a>--></h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="<?php echo base_url('manage-registration'); ?>" >
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <th align="center">Sl No</th>
                <th>Event Name</th>
                <th>Member ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Member Type</th> 
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Payment</th>
                <th>Booking Type</th>
                <th>Date</th>
                <th align="center" width="10%">Action</th>
              </tr>
              <tr>
                <td align="center"></td>
                <td><input class="sr" type="text" name="FlterData[title]" value="<?php echo $FlterData['title'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[user_name]" value="<?php echo $FlterData['user_name'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[first_name]" value="<?php echo $FlterData['first_name'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[last_name]" value="<?php echo $FlterData['last_name'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[email]" value="<?php echo $FlterData['email'];?>" /></td>
                <td><select name="FlterData[member_type_id]" class="sr">
                      <option value="">All</option>
                      <?php foreach($member_type as $val){ ?>
                    <option value="<?php echo $val['member_type_id'];?>" <?php if($FlterData['member_type_id']== $val['member_type_id']){echo 'selected';}?>><?php echo $val['name'];?></option>                    
                    <?php } ?>
                    <option value="4" <?php if($FlterData['member_type_id']== '4'){echo 'selected';}?>>Partner</option>
                    <option value="5" <?php if($FlterData['member_type_id']== '5'){echo 'selected';}?>>Non Member</option>
                    </select></td>
                <td></td>
                <td><select name="FlterData[payment_type]" class="sr">
                    <option value="">All</option>
                	<option value="Offline" <?php if($FlterData['payment_type']== 'Offline'){echo 'selected';}?>>Offline</option>
                    <option value="Paypal" <?php if($FlterData['payment_type']== 'Paypal'){echo 'selected';}?>>Paypal</option>
                    </select></td>
                <td><select name="FlterData[is_paid]" class="sr">
                    <option value="">All</option>
                	<option value="Paid" <?php if($FlterData['is_paid']== 'Paid'){echo 'selected';}?>>Paid</option>
                    <option value="Pending" <?php if($FlterData['is_paid']== 'Pending'){echo 'selected';}?>>Pending</option>
                    </select></td>
                <td><select name="FlterData[booking_status]" class="sr">
                    <option value="">All</option>
                	<option value="Y" <?php if($FlterData['booking_status']== 'Y'){echo 'selected';}?>>Approved</option>
                    <option value="R" <?php if($FlterData['booking_status']== 'R'){echo 'selected';}?>>Rejected</option>
                    <option value="N" <?php if($FlterData['booking_status']== 'N'){echo 'selected';}?>>Pending</option>
                    </select></td>
                <td><input class="sr" type="text" name="FlterData[create_date]" value="<?php echo $FlterData['create_date'];?>" id="datepicker" /></td>
                <td align="center"><input type="submit" value="Filter" name="OkFilter" id="OkFilter" class="buttonNew"></td>
              </tr>
              <?php 
				if(count($display_result)>0){
				foreach ($display_result as $key => $val):?>
              <tr <?php if($val['status']=='N'){echo 'class="unread"';}?>>
                <td><?php echo $start_count; ?></td>
                <td><a href="<?php echo SITE_URL.'event-details/'.$val['seo_url'];?>" target="_blank"><?php echo $val['title']; ?></a></td>
                <td><?php echo $val['user_name']; ?></td>
                <td><?php echo $val['first_name']; ?></td>
                <td><?php echo $val['last_name']; ?></td>
                <td><?php echo $val['email']; ?></td>
                <td><?php if($val['member_type_id']== '1'){echo 'Full Corporate';}elseif($val['member_type_id']== '2'){echo 'Associate Corporate';}elseif($val['member_type_id']== '3'){echo 'Associate Individual';}elseif($val['member_type_id']== '4'){echo 'Partner';}elseif($val['member_type_id']== '5'){echo 'Non Member';}?></td>
                <td>S$ <?php echo $val['price']; ?></td>
                <td><?php echo $val['payment_type']; ?></td>
                <td><?php echo $val['is_paid']; ?></td>
                <td><?php if($val['booking_status']=='Y'){echo 'Approved';}elseif($val['booking_status']=='N'){echo 'Pending';}elseif($val['booking_status']=='R'){echo 'Rejected';} ?></td>
                
                <td><?php echo date("d/m/Y h:i:s A", strtotime($val['create_date'])); ?></td>
                <td align="center">
                <?php if($val['invoice']!='' && file_exists(ABSOLUTE_PATH.$val['invoice'])){?>
                <a href="<?php echo SITE_URL.$val['invoice'];?>" download="<?php echo $val['invoice'];?>"> <img src="<?php echo image('icons/inbox_red.png'); ?>" alt="Invoice" title="Invoice"></a> &nbsp; 
                <?php }?>
                <a href="edit-registration/<?php echo $val['id'] ?>"> <img src="<?php echo image('icons/small/black/edit.png'); ?>" alt="Edit" title="Edit"></a> &nbsp; 
                <a href="view-registration/<?php echo $val['id'] ?>"> <img src="<?php echo image('icons/small/black/search.png'); ?>" alt="View" title="View"></a> </td>
              </tr>
              <?php $start_count++; endforeach; ?>
              
              <?php }else{?>
              <tr>
                <td align="center" colspan="14" style="text-align:center; font-weight:bold;" >There is no record found.</td>
              </tr>
              <?php }?>
            </table>
            <input type="hidden" name="contact_display_submit" value="1" />
          </form>
        </div>
        <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>