<div class="main-container">
	<!-- Sub Nav Section -->
	<?php $this->load->view('frontend/include/messages');?>
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
							<select class="selectpicker alt searchby" data-width="100%" data-style="" title="Class Name">
								<option value="classname">Class Name</option>
								<option value="classcode">Class Code</option>
								<option value="subject">Subject</option>
								<option value="day">Day</option>
								<option value="time">Time</option>
								<option value="level">Level</option>
								<option value="fees">Fees</option>
								<option value="tutor">Tutor</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="tool-input fleft">
						<input type="text" placeholder="WR-S" class="form-control alt searchfield">
					</div>
					<div class="short-by fright">
						<label>Sort By:</label>
						<div class="tool-control fright">
							<select class="selectpicker alt sortby" data-width="100%" data-style="" title="<i class='jcon-down-thin'></i> Name">
								<option value="classname">Class Name</option>
								<option value="classcode">Class Code</option>
								<option value="subject">Subject</option>
								<option value="day">Day</option>
								<option value="time">Time</option>
								<option value="level">Level</option>
								<option value="fees">Fees</option>
								<option value="tutor">Tutor</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="row pt40 display_data">
					<?php
					if(count($classes)) {
					foreach($classes as $class) {
					?>
					<div class="col-md-6">
						<div class="row-inner-md">
							<div class="class-box">
								<div class="class-hd">
									<?php echo isset($class->class_name) ? $class->class_name : '-'; ?>
								</div>
								<div class="class-info">
									<ul>
										<li><strong>Class Name</strong><span class="cinfo"><?php echo isset($class->class_name) ? $class->class_name : '-'; ?></span></li>
										<li><strong>Class Code</strong><span class="cinfo"><?php echo isset($class->class_code) ? $class->class_code : '-'; ?></span></li>
										<li><strong>Subject</strong><span class="cinfo"><?php echo get_subject_classes($class->subject); ?></span></li>
										<li><strong>Day</strong><span class="cinfo"><?php echo isset($class->class_day) ? $class->class_day : '-'; ?></span></li>
										<li><strong>Time</strong><span class="cinfo"><?php echo isset($class->class_time) ? $class->class_time : '-'; ?></span></li>
										<li><strong>Level</strong><span class="cinfo"><?php echo isset($class->level) ? $class->level : '-'; ?></span></li>
										<li><strong>Monthly Fees</strong><span class="cinfo"><?php echo isset($class->monthly_fees) ? $class->monthly_fees : '-'; ?></span></li>
										<li><strong>Tutor Assigned</strong><span class="cinfo"><?php echo get_tutor_of_class($class->tutor_id); ?></span></li>
										<li><strong>Materials</strong><span class="cinfo"><?php echo get_material_of_student($class->class_code, $this->session->userdata('student_credentials')['id']); ?></span></li>
									</ul>
									<a href="javascript:void(0);" data-name="<?php echo isset($class->class_id) ? $class->class_id : ''; ?>" class="button btn-light miss_class_request">Miss Class Request</a>
								</div>
							</div>
						</div>
					</div>
					<?php
					}}
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- Section END -->
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<p class="miss_class_error"></p>
        	<div class="col-lg-12">
        		<div class="form-group">
        			<label>Reason</label>
        			<textarea name="reason" rows="5" class="form-control" required="required"></textarea>
        		</div>
        		<div class="form-group">
        			<label>Date of Absence</label>
        			<input type="date" name="date_of_absense" class="form-control" required="required">
        		</div>
        	</div>
        	<input type="hidden" name="class_id">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default miss_class_request">Submit</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("body").on("click", "button.miss_class_request", function() {
			var ref = $(this).parents(".modal-content").find("p.miss_class_error");
			$(ref).html('');
			var ref1 = $(this);
			$(ref1).attr("disabled", true).text('Processing...');
			//$(ref).next().remove();
			var class_id = $("input[name='class_id']").val();
			var date_of_absence = $("input[name='date_of_absense']").val();
			var reason = $("textarea[name='reason']").val();
			
			var r = confirm("Are you sure?");
			
			if(r==true) {
				$.ajax({
					type: 'GET',
	                url: '<?php echo site_url('attendance/miss_class_request'); ?>',
	                data: 'class_id=' + class_id + '&date_of_absence=' + date_of_absence + '&reason=' + reason,
	                async: false,
	                processData: false,
	                contentType: false,
	                success: function(data) {
	                	//$("#myModal").modal('hide');
	                	$(ref1).attr("disabled", false).text('Submit');
	                	$("input[name='date_of_absense'], textarea[name='reason']").val('');
	                    if(data.trim()=='updated') {
	                    	$(ref).html("<p class='text-warning'>Warning! Your request has already been submitted.</p>");
	                    }
	                    else if(data.trim()=='success') {
	                    	$(ref).html("<p class='text-success'>Success! Your request has been submitted.</p>");
	                    }
	                    else if(data.trim()=='pending') {
	                    	$(ref).html("<p class='text-info'>Sorry! Try again after attendance sheet is updated.</p>");
	                    }
	                    else {
	                    	$(ref).html("<p class='text-danger'>Error! Something went wrong.</p>");
	                    }
	                }
				});
			}
		});

		$("body").on("click", "a.miss_class_request", function() {
			$("#myModal").modal("show");
			$("input[name='class_id']").val($(this).attr('data-name'));
		});

		$("select.sortby").on("change", function() {
			var sortby = $("select.sortby").val();

			$.ajax({
				type: 'GET',
                url: '<?php echo site_url('students/student-classes-search'); ?>',
                data: 'sortby=' + sortby,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                	//alert(data);
                	$(".display_data").html(data);
                }
            });
		});

		$("input.searchfield, select.searchby").on("change", function() {
			var searchby = $("select.searchby").val();
			var searchfield = $("input.searchfield").val();

			$.ajax({
				type: 'GET',
                url: '<?php echo site_url('students/student-classes-search'); ?>',
                data: 'searchby=' + searchby + '&searchfield=' + searchfield,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                	//alert(data);
                	$(".display_data").html(data);
                }
            });
		});
	});
</script>