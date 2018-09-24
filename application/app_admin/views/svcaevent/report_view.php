<?php $this->load->view('include/header_tag'); ?>
<body>
<script>
$(function() {
	$('#title').change(function() {
		var product_name = $.trim($('#title').val()).toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
		$('#seo_url').val(product_name);
	});
});
</script>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Events</a></li>
        <li><a href="<?php echo base_url('manage-svcaevent'); ?>">SVCA Event </a></li>
        <li>SVCA Event Registration Report</li>
  </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="leftPanel">
      <h1 class="pageTitle">SVCA Event Registration Report </h1>
      <div class="From_wrap">
        <?php $this->load->view('include/message'); ?>
        
          <div class="form_default">
            <p>
              <label for="name">Event Name : </label>
              <?php echo $details[0]['title'];?>
            </p>
            
            <div class="body">
            <table>
            <tr>
            <td></td>
            <td>Full Corporate</td>
            <td>Associate Corporate</td>
            <td>Individual</td>
            <td>Partner</td>
            <td>Non Member</td>
            </tr>
            <tr>
            <td>Max No Of Registrants</td>
            <td><?php echo $details[0]['max_no_registrant_full']; ?></td>
            <td><?php echo $details[0]['max_no_registrant_associate']; ?></td>
            <td><?php echo $details[0]['max_no_registrant_individual']; ?></td>
            <td><?php echo $details[0]['max_no_registrant_partner']; ?></td>
            <td><?php echo $details[0]['max_no_registrant_visitor']; ?></td>
            </tr>
            
            <tr>
            <td>Total Registration</td>
            <td><?php echo $full; ?></td>
            <td><?php echo $asso ?></td>
            <td><?php echo $indi ?></td>
            <td><?php echo $partner ?></td>
            <td><?php echo $visitor ?></td>
            </tr>
            
            
            <!--<tr>
            <td>Fee (1st Registrants) S$</td>
            <td><input type="text" name="fee_ist_registrant_full"  value="<?php echo $details[0]['fee_ist_registrant_full']; ?>" class="sr" /></td>
            <td><input type="text" name="fee_ist_registrant_associate"   value="<?php echo $details[0]['fee_ist_registrant_associate']; ?>" class="sr" /></td>
            <td><input type="text" name="fee_ist_registrant_individual"   value="<?php echo $details[0]['fee_ist_registrant_individual']; ?>" class="sr" /></td>
            <td><input type="text" name="fee_ist_registrant_partner"   value="<?php echo $details[0]['fee_ist_registrant_partner']; ?>" class="sr" /></td>
            <td><input type="text" name="fee_ist_registrant_visitor"   value="<?php echo $details[0]['fee_ist_registrant_visitor']; ?>" class="sr" /></td>
            </tr>
            
            <tr>
            <td>Subsequent Registrants S$</td>
            <td><input type="text" name="fee_subsequent_registrant_full"  value="<?php echo $details[0]['fee_subsequent_registrant_full']; ?>" class="sr" /></td>
            <td><input type="text" name="fee_subsequent_registrant_associate"   value="<?php echo $details[0]['fee_subsequent_registrant_associate']; ?>" class="sr" /></td>
            <td><input type="text" name="fee_subsequent_registrant_individual"   value="<?php echo $details[0]['fee_subsequent_registrant_individual']; ?>" class="sr" /></td>
            <td><input type="text" name="fee_subsequent_registrant_partner"   value="<?php echo $details[0]['fee_subsequent_registrant_partner']; ?>" class="sr" /></td>
            <td><input type="text" name="fee_subsequent_registrant_visitor"   value="<?php echo $details[0]['fee_subsequent_registrant_visitor']; ?>" class="sr" /></td>
            </tr>
            
            <tr>
            <td>E-payment Allowed</td>
            <td><input type="checkbox" name="epayment_allowed_full"  value="Y" class="sr" <?php if ($details[0]['epayment_allowed_full']=='Y'){echo 'checked="checked"';}?>/></td>
            <td><input type="checkbox" name="epayment_allowed_associate"   value="Y" class="sr" <?php if ($details[0]['epayment_allowed_associate']=='Y'){echo 'checked="checked"';}?>/></td>
            <td><input type="checkbox" name="epayment_allowed_individual"   value="Y" class="sr" <?php if ($details[0]['epayment_allowed_individual']=='Y'){echo 'checked="checked"';}?> /></td>
            <td><input type="checkbox" name="epayment_allowed_partner"   value="Y" class="sr" <?php if ($details[0]['epayment_allowed_partner']=='Y'){echo 'checked="checked"';}?> /></td>
            <td><input type="checkbox" name="epayment_allowed_visitor"   value="Y" class="sr" <?php if ($details[0]['epayment_allowed_visitor']=='Y'){echo 'checked="checked"';}?>/></td>
            </tr>
            
            
             <tr>
            <td>Max No Of Registrants Per Company</td>
            <td><input type="text" name="max_no_registrant_company_full"  value="<?php echo $details[0]['max_no_registrant_company_full']; ?>" class="sr" /></td>
            <td><input type="text" name="max_no_registrant_company_associate"  value="<?php echo $details[0]['max_no_registrant_company_associate']; ?>" class="sr" /></td>
            <td><input type="text" name="max_no_registrant_company_individual"  value="<?php echo $details[0]['max_no_registrant_company_individual']; ?>" class="sr" /></td>
            <td></td>
            <td></td>
            </tr>-->
            
            
            
            
            </table>
            </div>
            
            <div class="clear"></div>
            
            
            
			
                
                
            
            
            
            
          </div>
        
      </div>
    </div>
    <div class="clear"></div>
  </div>
  
</div>
<?php $this->load->view('include/footer'); ?>

</body>
</html>