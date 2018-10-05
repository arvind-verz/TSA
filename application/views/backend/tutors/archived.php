<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

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
                        <a class="btn btn-info" href="<?php echo site_url('admin/students/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . STUDENT ?>
                        </a>
                        <!--<a class="btn btn-info" href="<?php echo site_url('admin/students/archived') ?>">
                            <i aria-hidden="true" class="fa fa-archive">
                            </i> <?php echo ARCHIVED . ' ' . STUDENT ?>
                        </a>
                        <a class="pull-right add_class">
                            <i aria-hidden="true" class="fa fa-archive">
                            </i> Add <?php echo CLASSES ?>
                        </a>  -->          
                    </div>
                    
 <?php echo form_open('admin/students/archived'); ?>
                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Student Name</label>
                          <input type="text" name="s_name" class="form-control" value="<?php echo set_value('s_name');?>">
                        </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Student Email</label>
                          <input type="text" name="s_email" class="form-control" value="<?php echo set_value('s_email');?>">
                        </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Student Phone Number</label>
                          <input type="text" name="s_phone" class="form-control" value="<?php echo set_value('s_phone');?>">
                        </div>
                </div>
           

                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Parent Name</label>
                          <input type="text" name="p_name" class="form-control" value="<?php echo set_value('p_name');?>">
                        </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Parent Email</label>
                          <input type="text" name="p_email" class="form-control" value="<?php echo set_value('p_email');?>">
                        </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                          <label for="">Parent Phone Number</label>
                          <input type="text" name="p_phone" class="form-control" value="<?php echo set_value('p_phone');?>">
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
                                    <th><input type="checkbox" name="case[]" id="select_all" value="all"/></th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Username
                                    </th>
                                    <th>
                                        NRIC
                                    </th>
                                    <!--<th>
                                        Enrolled <br />classes
                                    </th>-->
                                    <th>
                                        Gender
                                    </th>
                                    <th>
                                        Age
                                    </th>
                                    <!--<th>
                                       Phone <br />Number
                                    </th>-->
                                    <!--<th>
                                       Parents <br />Name
                                    </th>-->
                                    <!--<th>
                                       Parents <br />Email
                                    </th>-->
                                    <!--<th>
                                       Parents <br />Phone
                                    </th>-->
                                    <th>
                                       Siblings
                                    </th>
                                    <th>
                                       Status
                                    </th>
                                    <!--<th>
                                       Remarks
                                    </th>-->
                                    <th>
                                       Action 
                                    </th>
                                    <!--<th>
                                       Materials <br />Associated 
                                    </th>
                                    <th>
                                       Extra <br />charges <br />applied
                                    </th>
                                    
                                    <th>
                                        Deposit <br />Collected 
                                    </th>
                                   -->
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                if (count($students)) {
                                foreach ($students as $student) {
                                ?>
                                <tr>
                                <td><input type="checkbox" class="checkbox" name="case[]" value="<?php echo $student->student_id;?>"/></td>
                                <td><?php echo $student->name;?></td>
                                <td><?php echo $student->email;?></td>
                                <td><?php echo $student->username;?></td>
                                <td><?php echo isset($student->nric) ? $student->nric : '-' ?></td>
                                <!--<td></td>-->
                                <td><?php echo isset($student->gender) ? $student->gender : '-' ?></td>
                                <td><?php echo isset($student->age) ? $student->age : '-' ?></td>
                                <!--<td><?php echo isset($student->phone) ? $student->phone : '-' ?></td>-->
                                <!--<td><?php echo isset($student->parent_name ) ? $student->parent_name  : '-' ?></td>-->
                                <!--<td><?php echo isset($student->parent_email ) ? $student->parent_email  : '-' ?></td>-->
                                <!--<td><?php echo isset($student->parents_phone ) ? $student->parents_phone  : '-' ?></td>-->
                                <td><?php echo isset($student->siblings ) ? $student->siblings  : '-' ?></td>
                                <td><?php echo isset($student->status ) ? $student->status  : '-' ?></td>
                                <td> <div class="form-group">
                           
                            <select name="action" id="action" class="form-control select2 action">
                                <option value="">-- Select One --</option>
                                <option value="<?php echo base_url();?>index.php/admin/students/edit/<?php echo $student->student_id;?>">Edit</option>
                                <option name="Archive" value="<?php echo base_url();?>index.php/admin/students/archive/<?php echo $student->student_id;?>">Archive</option>
                                <option value="Final Settlement">Final Settlement</option>
                                <option value="View all details">View all details</option>
                                <option value="<?php echo base_url();?>index.php/admin/classes/edit/<?php echo $student->class_id;?>">Edit Class </option>
                            </select>
                        </div></td>
                                <!--<td></td>
                                <td></td>-->
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
		
		reservation =option+'<div class="form-group"><label for="">Select Reservation Date</label><input type="text" name="reservation_date" class="form-control" value=""></div>';
		enrollment = '<div class="form-group"><label for="">Select Enrollment Date</label><input type="text" name="enrollment_date" class="form-control" value=""></div><div class="form-group"><label for="">Deposit</label>200</div><div class="form-group"><div class="row"><div class="col-sm-1"><label for="">Deposit Collected</label></div><div class="col-sm-2"><label class="radio-inline"><input name="depo_collected"  value="1" type="radio" />Yes</label></div><div class="col-sm-2"><label class="radio-inline"><input name="depo_collected" value="0" type="radio" />No</label</div></div></div><div class="form-group"><label for="">Remarks Deposit</label><input type="text" name="remarks_deposit" class="form-control" value=""></div><div class="form-group"><label for="">Select Reservation Date</label><input type="text" name="reservation_date" class="form-control" value=""></div><div class="form-group"><label for="">Enter Extra Charges(if any)</label><input type="text" name="ex_charges" class="form-control" value=""></div><div class="form-group"><label for="">Remarks</label><input type="text" name="remarks" class="form-control" value=""></div>';
				
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
		else
		{
			window.location=$(this).val();
		}
    });
});
</script>