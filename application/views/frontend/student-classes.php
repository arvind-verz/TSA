<div class="main-container">
	<!-- Sub Nav Section -->
    <?php $this->load->view('frontend/include/messages')?>
	<div class="sub-nav bg-color1">
		<div class="container">
			<div class="navigation"></div>
			<ul>
				<li><a href="<?php echo site_url('student-profile'); ?>">My Profile </a></li>
				<li class="selected"><a href="<?php echo site_url('student-classes'); ?>">My Classes</a></li>
				<li><a href="<?php echo site_url('student-invoices'); ?>">Invoices</a></li>
			</ul>
		</div>
	</div>
    
	<!-- Sub Nav Section END -->
	<!-- Section -->
	<div class="fullcontainer">
			<div class="container">
				<div class="inner-container-md">
					<div class="animatedParent" data-sequence="300">
						<h1 class="title1 text-center txt-dark animated growIn" data-id="1">My <span>classes</span></h1>
					</div>
					<div class="toolbar">
						<div class="search-by fleft">
							<label>Search By:</label>
							<div class="tool-control fright">
								<select class="selectpicker alt" data-width="100%" data-style="" title="Class Name">
									<option>Select</option>
									<option>Select</option>
								</select>
							</div>
							<div class="clear"></div>
						</div>
						<div class="tool-input fleft">
							<input type="text" placeholder="WR-S" class="form-control alt">
						</div>
						<div class="short-by fright">
							<label>Sort By:</label>
							<div class="tool-control fright">
								<select class="selectpicker alt" data-width="100%" data-style="" title="<i class='jcon-down-thin'></i> Name">
									<option>Select</option>
									<option>Select</option>
								</select>
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="row pt40">
                    <?php 
					foreach($classes as $class):
					$attendance = $this->Cms_model->get_attendance($class['student_id']);
					if(count($attendance)>0)
					$status=json_decode($attendance[0]['status']);
					
					$subject=json_decode($class['subject']);
					
					$subjects = $this->Cms_model->get_subjects_name($subject);
					//print_r($subjects);
					foreach($subjects as $sub):
					$S[]=$sub['subject_name'];
					$book = $this->Cms_model->get_book($sub['id']);
					if($book['book_name']!='')
					$B[]=$book['book_name'];
					endforeach;
					$subjects = $this->Cms_model->get_subjects_name($subject);
					//print_r($B);
					?>
						<div class="col-md-6">
							<div class="row-inner-md">
								<div class="class-box">
									<div class="class-hd"><?php echo $class['class_name'];?></div>
									<div class="class-info">
										<ul>
											<li><strong>Class Code</strong><span class="cinfo"><?php echo $class['class_code'];?></span></li>
											<li><strong>Subject</strong><span class="cinfo"><?php if(count($subjects)>0) echo implode(',',$S);?></span></li>
											<li><strong>Day</strong><span class="cinfo"><?php echo $class['class_day'];?></span></li>
											<li><strong>Time</strong><span class="cinfo"><?php echo $class['class_time'];?></span></li>
											<li><strong>Level </strong><span class="cinfo"><?php echo level($class['level']);?></span></li>
                                            <li><strong>Monthly Fees  </strong><span class="cinfo"><?php echo $class['monthly_fees'];?></span></li>
                                            <li><strong>Tutor Name  </strong><span class="cinfo"><?php echo $class['tutor_name'];?></span></li>
                                            <li><strong>Materials </strong><span class="cinfo"><?php if(count($B)>0) echo implode(',',$B);?></span></li>
										</ul>
                                        <?php if(count($attendance)>0 && $status[1]==0):?>
										<a onclick="miss_class('<?=$class['student_id']?>')" class="button btn-light">Miss Class Request</a> 
                                        <?php endif;?>
                                        </div>
								</div>
							</div>
						</div>
					<?php endforeach;?>	
					</div>
				</div>
			</div>
		</div>
	<!-- Section END -->
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Miss Class Request</h4>
        </div>
       <?php echo form_open('miss-class'); ?>
        <div class="modal-body">
          <div class="form-group"><label for="">Reason</label><input required="required" type="text" name="remark" class="gt-input" value=""></div>
          <div class="form-group"><label for="">Date of Absence</label><input required="required" type="text" name="updated_at" class="gt-input datepicker" value=""></div>  
        </div>
        <div class="modal-footer">
         <input type="hidden" name="student_id"  id="student_id" value="<?php echo $class['student_id'];?>" /> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" class="btn btn-default">Submit</button>
        </div>
       <?php echo form_close(); ?>
      </div>
      
    </div>
  </div>
  <script type="text/javascript">
  
     function miss_class(val) {
	 $("#student_id").val(val);
	 $("#myModal").modal();
	 }

</script>