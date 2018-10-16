<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php //echo '<pre>'; print_r($classes); echo '</pre>';?>
    </section>
    <?php 
	$this->load->view('backend/include/messages');	?>
    <!-- Main content -->
    <section class="content">
    
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/tutors/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . TUTOR ?>
                        </a>
                        <a class="btn btn-info" href="<?php echo site_url('admin/tutors/archived') ?>">
                            <i aria-hidden="true" class="fa fa-archive">
                            </i> <?php echo ARCHIVED . ' ' . TUTOR ?>
                        </a>
                    </div>
                    
 <?php echo form_open('admin/tutors'); ?>
                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Tutor Name</label>
                          <input type="text" name="t_name" class="form-control" value="<?php echo set_value('s_name');?>">
                        </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Tutor Email</label>
                          <input type="text" name="t_email" class="form-control" value="<?php echo set_value('s_email');?>">
                        </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Tutor Phone Number</label>
                          <input type="text" name="t_phone" class="form-control" value="<?php echo set_value('s_phone');?>">
                        </div>
                </div>
           

                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Class Code</label>
                          <input type="text" name="class_code" class="form-control" value="<?php echo set_value('p_name');?>">
                        </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Tutor ID</label>
                          <input type="text" name="t_id" class="form-control" value="<?php echo set_value('p_email');?>">
                        </div>
                </div>
                <div class="col-md-4">
                
                        <div class="form-group">
                            <label for="">Salary Scheme</label>
                            <select name="t_scheme" id="t_scheme" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option  value="0">Fixed</option>
                                <option value="1">Variable</option>
                               
                            </select>
                        </div>
                </div>
               <div class="col-md-4">
                <div class="form-group"> 
                <input type="hidden" name="search" value="1" />
                <button type="submit" class="btn btn-info">Search</button>
                </div>
                </div>

 <?php echo form_close(); ?> 
                    <div class="box-body">
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                       Class <br />Code
                                    </th>
                                    <th>
                                       Subject 
                                    </th>
                                    <th>
                                       Phone 
                                    </th>
                                    <th>
                                       Show <br />archive
                                    </th>
                                    
                                    <th>
                                       Action 
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                if (count($tutors)) {
                                foreach ($tutors as $tutor) {
								?>
                                <tr>
                                <td><?php echo $tutor->tutor_id;?></td>
                                <td><?php echo $tutor->tutor_name;?></td>
                                <td><?php echo $tutor->email;?></td>
                                <td></td>
                                <td><?php echo isset($tutor->subject) ? $tutor->subject : '-' ?></td>
                                <td><?php echo isset($tutor->phone) ? $tutor->phone : '-' ?></td>
                                <td></td>
                                <td><a title="Edit" href="<?php echo site_url('admin/tutors/edit/'.$tutor->tutor_id) ?>"><i aria-hidden="true" class="fa fa-pencil-square-o btn btn-warning"></i></a><a title="Edit" href="<?php echo site_url('admin/tutors/archive/'.$tutor->tutor_id) ?>" class="pull-right" onclick="return confirm('Are you sure you want to archive this tutor?');"><i aria-hidden="true" class="fa fa-archive btn btn-danger"></i></a> </td>
                               
                                </tr>
                                <?php
                                }} else {
                                ?>
                                <tr>
                                    <td colspan="18" class="text-center">No data found.</td>
                                </tr>
                                <?php
                                }
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign Class</h4>
        </div>
       <?php echo form_open('admin/students/enroll'); ?>
        <div class="modal-body">
          <div class="form-group">
                            <label for="">Select Status</label>
                            <select name="student_status" id="student_status" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="0">Enrolled</option>
                                <option value="1">Reserved</option>
                                <option value="2">Waitlist</option>
                                <option value="3">Final Settlement Sent</option>
                               
                            </select>
                        </div>
          <div id="dis_content"></div>  
        </div>
        <div class="modal-footer"> 
          <input type="hidden" name="student_code" id="student_code" value="" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" class="btn btn-default">Submit</button>
        </div>
       <?php echo form_close(); ?>
      </div>
      
    </div>
  </div>

<?php if(isset($_GET['sid']) && $_GET['sid']!=""){?>
<script type="text/javascript">
	$(window).load(function() {
	$("#viewDetail").modal();
	});
</script>
  <div class="modal fade" id="viewDetail" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Details</h4>
        </div>
       
        <div class="modal-body">
          <div class="form-group">
                            <label for="">Student Id:</label>
                            <span><?php echo $stu->student_id;?></span>
                        </div>
          <div class="form-group">
                            <label for="">Student Name:</label>
                            <span><?php echo $stu->name;?></span>
                        </div> 
          <div class="form-group">
                            <label for="">Student Email:</label>
                            <span><?php echo $stu->email;?></span>
          </div>
          <div class="form-group">
                            <label for="">NRIC:</label>
                            <span><?php echo $stu->nric;?></span>
          </div>  
          <div class="form-group">
                            <label for="">Username:</label>
                            <span><?php echo $stu->username;?></span>
          </div> 
          <div class="form-group">
                            <label for="">Phone:</label>
                            <span><?php echo $stu->phone;?></span>
          </div>
          <div class="form-group">
                            <label for="">Age:</label>
                            <span><?php echo $stu->age;?></span>
          </div>
          <div class="form-group">
                            <label for="">Gender:</label>
                            <span><?php if($stu->gender==0) echo 'Male'; else echo 'Female';?></span>
          </div>
          <div class="form-group">
                            <label for="">Parent Name :</label>
                            <span><?php echo $stu->parent_name ;?></span>
          </div>
          <div class="form-group">
                            <label for="">Parent Email:</label>
                            <span><?php echo $stu->parent_email;?></span>
          </div>
          <div class="form-group">
                            <label for="">Siblings:</label>
                            <span><?php echo $stu->siblings;?></span>
          </div>
          <div class="form-group">
                            <label for="">Parent Phone:</label>
                            <span><?php echo $stu->parents_phone;?></span>
          </div>
          <div class="form-group">
                            <label for="">Reservation Date:</label>
                            <span><?php echo $stu->reservation_date;?></span>
          </div>
          <div class="form-group">
                            <label for="">Status:</label>
                            <span><?php if($stu->status ==0) echo 'Enrolled ';else if($stu->status ==1) echo 'Reserved ';else if($stu->status ==2) echo 'Waitlist ';else if($stu->status ==3) echo 'Final Settlement Sent ';?></span>
          </div>
          <div class="form-group">
                            <label for="">Archive:</label>
                            <span><?php if($stu->is_archive==0) echo 'Yes'; else echo 'No';?></span>
          </div>
          <?php          
                                if($stu->class_id!=0)
								{
								$cls=$this->students->get_class_name($stu->class_id);
								  
	     ?>  
        <div class="form-group">
                            <label for="">Class Name:</label>
                            <span><?php echo $cls->class_name;?></span>
          </div>
        <?php }?> 
        <?php  if($stu->status==0)
			   {
			   $enr=$this->students->get_enrollment($stu->student_id);
			  /* echo '<pre>';
			   print_r($enr);
			   echo '</pre>';*/
		?>
          <div class="form-group">
                            <label for="">Enrollment Date:</label>
                            <span><?php echo $enr->enrollment_date;?></span>
          </div>
          <div class="form-group">
                            <label for="">Deposit Collected:</label>
                            <span><?php if($enr->collected==1) echo 'Yes'; else echo 'No';?></span>
          </div>
          <div class="form-group">
                            <label for="">Remarks Deposit:</label>
                            <span><?php echo $enr->remarks_deposit;?></span>
          </div>
          <div class="form-group">
                            <label for="">Reservation Date:</label>
                            <span><?php echo $enr->reservation_date;?></span>
          </div>
          <div class="form-group">
                            <label for="">Extra Charges:</label>
                            <span><?php echo $enr->ex_charges;?></span>
          </div>
          <div class="form-group">
                            <label for="">Remarks:</label>
                            <span><?php echo $enr->remarks;?></span>
          </div>
        <?php }?>           
        </div>
        <div class="modal-footer"> 
          <input type="hidden" name="student_code" id="student_code" value="" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       
      </div>
      
    </div>
  </div>
<?php } ?>  
<!-- Modal -->
<script type="text/javascript">
var option;
option+='<div class="form-group">';
option+='<label for="">Select Class Code</label>';
option+='<select name="class_code" class="form-control select2">';
option+='<option value="">-- Select One --</option>';
option+='<?php if (count($classes)) {
foreach ($classes as $class) {
echo '<option value="'.$class->class_id.'">'.$class->class_id.'</option>';
}} ?>';                              
option+='</select></div>';

$(document).ready(function() {
	$("#student_status").on('change', function(){
		var reservation ="";var enrollment ="";
		
		reservation =option+'<div class="form-group"><label for="">Select Reservation Date</label><input type="text" name="reservation_date" class="form-control datepicker" value=""></div>';
		enrollment = '<div class="form-group"><label for="">Select Enrollment Date</label><input type="text" name="enrollment_date" class="form-control datepicker" value=""></div><div class="form-group"><label for="">Deposit</label>200</div><div class="form-group"><div class="row"><div class="col-sm-1"><label for="">Deposit Collected</label></div><div class="col-sm-2"><label class="radio-inline"><input name="depo_collected"  value="1" type="radio" />Yes</label></div><div class="col-sm-2"><label class="radio-inline"><input name="depo_collected" value="0" type="radio" />No</label</div></div></div><div class="form-group"><label for="">Remarks Deposit</label><input type="text" name="remarks_deposit" class="form-control" value=""></div><div class="form-group"><label for="">Select Reservation Date</label><input type="text" name="reservation_date" class="form-control datepicker" value=""></div><div class="form-group"><label for="">Enter Extra Charges(if any)</label><input type="text" name="ex_charges" class="form-control" value=""></div><div class="form-group"><label for="">Remarks</label><input type="text" name="remarks" class="form-control" value=""></div>';
				
		if($(this).val()==0)
		{
			$("#dis_content").html(enrollment);
			
		}
		else if($(this).val()==1)
		{
			$("#dis_content").html(reservation);
			
		}
		else
		{
			$("#dis_content").html('');
		}
		
		$(".datepicker").datepicker({format: 'yyyy-mm-dd'});
		
	}); 
}); 


$(document).ready(function () {
   $(".add_class").click(function () {
        if($('input[type=checkbox]').is(':checked') == true){
			
				    var val = [];
					$(':checkbox:checked').each(function(i){
					val[i] = $(this).val();
					});
					$("#student_code").val(val);
					$("#myModal").modal();
		}
		else
		{
			alert('Please make atleast one selection.');
		}
    });
});

$(document).ready(function() {
	$(".action").on('change', function(){
		var attrname=$(this).find('option:selected').attr("name");
		if(attrname=='Archive')
		{
		var archive=confirm("Are you sure you want to archive this student?");
			if (archive==true){
			window.location=$(this).val();
			} 	
		}
		else if(attrname=='View all details')
		{
		
			window.location=$(this).val();
			
		}
		else
		{
			window.location=$(this).val();
		}
    });
});
</script>
