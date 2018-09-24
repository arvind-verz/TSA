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
        <li>Add SVCA Event</li>
  </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="leftPanel">
      <h1 class="pageTitle">Add SVCA Event </h1>
      <div class="From_wrap">
        <?php $this->load->view('include/message'); ?>
        <form method="post" action="" name="product" id="update_form" enctype="multipart/form-data">
          <div class="form_default">
            <p>
              <label for="name">Event Name : <span>*</span></label>
              <input type="text" name="title" required id="title" value="<?php echo set_value('title'); ?>" class="sf" />
            </p>
            <p>
                <label for="seo_url" >URL : <span>*</span></label>
                <input type="text" name="seo_url" required id="seo_url" value="<?php echo set_value('seo_url'); ?>" class="sf" />
              </p>
            <p>
              <label for="product_description">Descriptions : <span>*</span></label>
            <div class="body">
              <textarea name="description" id="bodyContent"><?php echo set_value('description'); ?></textarea>
            </div>
            </p>
            <p>
              <label for="product_specifications">Programme: </label>
            <div class="body">
              <textarea name="programme" id="bodyContent2"><?php echo set_value('programme'); ?></textarea>
            </div>
            </p>
            
            <p>
              <label for="product_specifications">Contact:</label>
            <div class="body">
              <textarea name="contact" id="bodyContent2"><?php echo set_value('contact'); ?></textarea>
            </div>
            </p>
            
            
            
            <p>
              <label for="location">Event Image (400 X 236) : <span>*</span></label>
              <input type="file" name="image_name" required id="image_name">
            </p>
            
            <p>
              <label for="location">Banner Image (1400 x 350) : </label>
              <input type="file" name="image_banner" id="image_banner">
            </p>
            
             <p>
              <label for="name">Event Start Date : <span>*</span></label>
              <input type="text" name="start_date" required id="start_date1" value="<?php echo set_value('start_date'); ?>" class="sf" readonly />
            </p>
            
            <p>
              <label for="name">Event End Date : <span>*</span></label>
              <input type="text" name="end_date" required id="end_date1" value="<?php echo set_value('end_date'); ?>" class="sf" readonly />
            </p>
            
             <p>
              <label for="name">Registration End Date : <span>*</span></label>
              <input type="text" name="registration_date" required id="registration_date" value="<?php echo set_value('registration_date'); ?>" class="sf" readonly />
            </p>
            <p>
              <label for="name">Last Payment Date : <span>*</span></label>
              <input type="text" name="last_payment_date"  id="last_payment_date" value="<?php echo set_value('last_payment_date'); ?>" class="sf" required readonly />
            </p>
            
           <p>
              <label for="name">Event Time : <span>*</span></label>
              <input type="text" name="event_time"  id="event_time" value="<?php echo set_value('event_time'); ?>" class="sf" required />
            </p>
            
            <p>
              <label for="name">Venue : <span>*</span></label>
              <input type="text" name="venue"  id="venue" value="<?php echo set_value('venue'); ?>" class="sf" required />
            </p>
            
            <p>
              <label for="location">For Member : </label>
              <input type="checkbox" name="for_member" id="for_member" value="Y">
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
            <td><input type="text" name="max_no_registrant_full"  value="<?php echo set_value('max_no_registrant_full'); ?>" class="sr" /></td>
            <td><input type="text" name="max_no_registrant_associate"   value="<?php echo set_value('max_no_registrant_associate'); ?>" class="sr" /></td>
            <td><input type="text" name="max_no_registrant_individual"   value="<?php echo set_value('max_no_registrant_individual'); ?>" class="sr" /></td>
            <td><input type="text" name="max_no_registrant_partner"   value="<?php echo set_value('max_no_registrant_partner'); ?>" class="sr" /></td>
            <td><input type="text" name="max_no_registrant_visitor"   value="<?php echo set_value('max_no_registrant_visitor'); ?>" class="sr" /></td>
            </tr>
            
            <tr>
            <td>Fee (1st Registrant) S$</td>
            <td><input type="text" name="fee_ist_registrant_full"  value="<?php echo set_value('fee_ist_registrant_full'); ?>" class="sr" /></td>
            <td><input type="text" name="fee_ist_registrant_associate"   value="<?php echo set_value('fee_ist_registrant_associate'); ?>" class="sr" /></td>
            <td><input type="text" name="fee_ist_registrant_individual"   value="<?php echo set_value('fee_ist_registrant_individual'); ?>" class="sr" /></td>
            <td><input type="text" name="fee_ist_registrant_partner"   value="<?php echo set_value('fee_ist_registrant_partner'); ?>" class="sr" /></td>
            <td><input type="text" name="fee_ist_registrant_visitor"   value="<?php echo set_value('fee_ist_registrant_visitor'); ?>" class="sr" /></td>
            </tr>
            
            <tr>
            <td>Subsequent Registrants S$</td>
            <td><input type="text" name="fee_subsequent_registrant_full"  value="<?php echo set_value('fee_subsequent_registrant_full'); ?>" class="sr" /></td>
            <td><input type="text" name="fee_subsequent_registrant_associate"   value="<?php echo set_value('fee_subsequent_registrant_associate'); ?>" class="sr" /></td>
            <td><input type="text" name="fee_subsequent_registrant_individual"   value="<?php echo set_value('fee_subsequent_registrant_individual'); ?>" class="sr" /></td>
            <td><input type="text" name="fee_subsequent_registrant_partner"   value="<?php echo set_value('fee_subsequent_registrant_partner'); ?>" class="sr" /></td>
            <td><input type="text" name="fee_subsequent_registrant_visitor"   value="<?php echo set_value('fee_subsequent_registrant_visitor'); ?>" class="sr" /></td>
            </tr>
            
            <tr>
            <td>E-payment Allowed</td>
            <td><input type="checkbox" name="epayment_allowed_full"  value="Y" class="sr" <?php if ((set_value('epayment_allowed_full') && set_value('epayment_allowed_full')=='Y')){echo 'checked="checked"';}?>/></td>
            <td><input type="checkbox" name="epayment_allowed_associate"   value="Y" class="sr" <?php if ((set_value('epayment_allowed_associate') && set_value('epayment_allowed_associate')=='Y')){echo 'checked="checked"';}?>/></td>
            <td><input type="checkbox" name="epayment_allowed_individual"   value="Y" class="sr" <?php if ((set_value('epayment_allowed_individual') && set_value('epayment_allowed_individual')=='Y')){echo 'checked="checked"';}?> /></td>
            <td><input type="checkbox" name="epayment_allowed_partner"   value="Y" class="sr" <?php if ((set_value('epayment_allowed_partner') && set_value('epayment_allowed_partner')=='Y')){echo 'checked="checked"';}?> /></td>
            <td><input type="checkbox" name="epayment_allowed_visitor"   value="Y" class="sr" <?php if ((set_value('epayment_allowed_visitor') && set_value('epayment_allowed_visitor')=='Y')){echo 'checked="checked"';}?>/></td>
            </tr>
            
            
             <tr>
            <td>Max No Of Registrants Per Company</td>
            <td><input type="text" name="max_no_registrant_company_full"  value="<?php echo set_value('max_no_registrant_company_full'); ?>" class="sr" /></td>
            <td><input type="text" name="max_no_registrant_company_associate"  value="<?php echo set_value('max_no_registrant_company_associate'); ?>" class="sr" /></td>
            <td><input type="text" name="max_no_registrant_company_individual"  value="<?php echo set_value('max_no_registrant_company_individual'); ?>" class="sr" /></td>
            <td></td>
            <td></td>
            </tr>
            
            
            
            
            </table>
            </div>
            <p>
              <label for="location1">More Information : </label>
              
            </p>
            <div class="clear"></div>
            <p>
       		<label for="location">PDF </label>
            <input type="text" name="pdf_title[]" id="pdf_title123">
       		<input type="file" name="pdf_name[]" id="pdf_name123">
       		<input type="hidden" name="cnt" id="cnt" value="1" />
                                                        
            </p>
            <div id="add_more"></div>
            <p>
            <a href="javascript:void(0);" onClick="add_more();" class="add_more" style="margin-left:199px;">Add More</a>
            </p>   
            <script>
														 function add_more()
														 {
															 var arrInputs = document.getElementById("pdf_name123").value;
															 if(!arrInputs){ alert('Add first pdf');return ;}
															 var cnt=$('#cnt').val();
															$('#add_more').append('<p id="img'+cnt+'"><label for="location">PDF</label><input type="text" name="pdf_title[]" ><input type="file" name="pdf_name[]"><a href="javascript:void(0);" class="add_more" onclick="remove_more('+cnt+');">Remove</a></p>'); 
															cnt++;
															$('#cnt').val(cnt);
														 }
														 
														 function remove_more(id)
														 {
															  var cnt=$('#cnt').val();
															 $('#img'+id).remove();
															 cnt--;
															$('#cnt').val(cnt);
															 
														 }
														 </script>                                       
            <!-- ----------------------------- -->
            
            
            <div class="clear"></div>
            
            
            
            
            
            
            <!--<p>
              <label for="name">Sort Order </label>
              <input type="text" name="sort_order" id="sort_order" value="<?php echo set_value('sort_order'); ?>" class="sf" />
            </p>-->
            <p>
              <label for="status">Status : <span>*</span></label>
              <label for="status" style="text-align:left;">Enable
                <input type="radio" name="status" required value="Y" <?php if ((set_value('status') && set_value('status')=='Y') || (!set_value('status'))){echo 'checked="checked"';}?>>
              </label>
              <label for="status" style="text-align:left;">Disable
                <input type="radio" name="status" required <?php if (set_value('status') && set_value('status')=='N'){echo 'checked="checked"';}?> value="N" >
              </label>
            </p>
            <div class="clear"></div>
            
            <div class="clear"></div>
            <h3>SEO Details</h3>
            <p>
              <label for="seo_title" >Title </label>
              <input type="text" name="seo_title"  id="seo_title" value="<?php echo set_value('seo_title'); ?>" class="sf" />
            </p>
            <p>
              <label for="seo_keyword" >Keyword </label>
              <textarea name="seo_keyword" id="seo_keyword"><?php echo set_value('seo_keyword'); ?></textarea>
            </p>
            <p>
              <label for="seo_description" >Description</label>
              <textarea name="seo_description" id="seo_description"><?php echo set_value('seo_description'); ?></textarea>
            </p>
            <p>
              <button type="reset" >Reset</button>
              <button type="submit" value="update_form" name="update_form" onClick="return product_form_valid();">Submit</button>
            </p>
          </div>
        </form>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  
</div>
<?php $this->load->view('include/footer'); ?>
<script>
jQuery(document).ready(function() {
	jQuery("#registration_date").datepicker({
        //numberOfMonths: 2,
		//minDate:0,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
        changeYear: true,
        /*onSelect: function(selected) {
          jQuery("#end_date1").datepicker("option","minDate", selected);
        }*/
    });
	jQuery("#start_date1").datepicker({
        //numberOfMonths: 2,
		//minDate:0,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
        changeYear: true,
        /*onSelect: function(selected) {
          jQuery("#end_date1").datepicker("option","minDate", selected)
        }*/
    });
    jQuery("#end_date1").datepicker({ 
       // numberOfMonths: 2,
	   dateFormat: 'yy-mm-dd',
	   changeMonth: true,
        changeYear: true,
        /*onSelect: function(selected) {
          jQuery("#start_date1").datepicker("option","maxDate", selected);
		  jQuery("#registration_date").datepicker("option","maxDate", selected);
		  jQuery("#last_payment_date").datepicker("option","maxDate", selected);
        }*/
    });
	
	jQuery("#last_payment_date").datepicker({ 
		//minDate:0,
	   	dateFormat: 'yy-mm-dd',
	   	changeMonth: true,
        changeYear: true        
    });
	
	
});

</script>


</body>
</html>