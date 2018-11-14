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
										<li><strong>Status</strong><span class="cinfo txt-green">Enrolled</span></li>
										<li><strong>Tutor</strong><span class="cinfo"><?php echo get_tutor_of_class($class->tutor_id); ?></span></li>
										<li><strong>Frequency (Monthly)</strong><span class="cinfo"><?php echo isset($class->frequency) ? $class->frequency : '-'; ?></span></li>
										<li><strong>Monthly Fee</strong><span class="cinfo">$<?php echo isset($class->monthly_fees) ? $class->monthly_fees : '-'; ?></span></li>
										<li><strong>First Lesson Date</strong><span class="cinfo">1 Jun 2018</span></li>
										<li><strong>Last Lesson Date</strong><span class="cinfo">N/A</span></li>
									</ul>
									<a href="javascript:void(0);" name="<?php echo isset($class->id) ? $class->id : ''; ?>" class="button btn-light miss_class_request">Miss Class Request</a>
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

<script type="text/javascript">
	$(document).ready(function() {
		$("a.miss_class_request").on("click", function() {
			$("a.miss_class_request").next().remove();
			var r = confirm("Are you sure?");
			var class_id = $(this).attr("name");
			var ref = $(this);
			if(r==true) {
				$.ajax({
					type: 'GET',
	                url: '<?php echo site_url('admin/attendance/miss_class_request'); ?>',
	                data: 'class_id=' + class_id,
	                async: false,
	                processData: false,
	                contentType: false,
	                success: function(data) {
	                    if(data.trim()=='updated') {
	                    	$(ref).after("<p class='text-warning'>Warning! Your request has already been updated.</p>");
	                    }
	                    else if(data.trim()=='success') {
	                    	$(ref).after("<p class='text-success'>Success! Your request has been submitted.</p>");
	                    }
	                    else if(data.trim()=='pending') {
	                    	$(ref).after("<p class='text-info'>Sorry! Try again after attendance sheet is updated.</p>");
	                    }
	                    else {
	                    	$(ref).after("<p class='text-danger'>Error! Something went wrong.</p>");
	                    }
	                }
				});
			}
		});
	});
</script>