<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php print_r($page_title);?>
		</h1>
		<?php print_r($breadcrumbs);?>
	</section>
	<?php
    $this->load->view('backend/include/messages');  ?>
	<!-- Main content -->
	<section class="content">

		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<?php echo form_open('admin/students/archive'); ?>
					<div class="box-header">
						<a class="btn btn-info" href="<?php echo site_url('admin/students/create') ?>">
							<i aria-hidden="true" class="fa fa-plus-circle">
							</i> <?php echo CREATE . ' ' . STUDENT ?>
						</a>
						<p class="text-right">
							<?php if (!(current_url() == site_url('admin/students/archived'))) { ?>
							<button type="submit" class="btn btn-primary hide">Archive Selected <span
									class="badge"></span></button> |
							<a href="javascript:void(0);" class="add_class">
								<i aria-hidden="true" class="fa fa-plus-circle">
								</i> Add <?php echo CLASSES ?>
							</a> |
							<?php } ?>
							<a class="" href="<?php echo site_url('admin/students/archived') ?>">
								<i aria-hidden="true" class="fa fa-archive">
								</i> <?php echo ARCHIVED . ' ' . STUDENT ?>
							</a>
						</p>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-bordered" style="width:100%">
							<thead>
								<tr>
									<?php if (!(current_url() == site_url('admin/students/archived'))) { ?>
									<th class="no-sort" width="15px">
										<input type="checkbox" name="select_all_students">
									</th>
									<?php } ?>
									<?php if (current_url() == site_url('admin/students/archived')) { ?>
									<th>
										#
									</th>
									<?php } ?>
									<th>
										Action
									</th>
									<th>
										Material <br /> Associated
									</th>
									<th>
										Student <br /> Name
									</th>
									<th>
										Student <br /> Email
									</th>
									<th>
										Student <br /> Username
									</th>
									<th>
										Student <br /> NRIC
									</th>
									<th>
										Enrolled <br />classes
									</th>
									<th>
										Enrolled <br />Date
									</th>
									<th>
										Student <br /> Gender
									</th>
									<th>
										Student <br /> Age
									</th>
									<th>
										Student <br /> Phone <br />Number
									</th>
									<th>
										Parents <br />Name
									</th>
									<th>
										Parents <br />Email
									</th>
									<th>
										Parents <br />Phone
									</th>
									<th>
										Siblings
									</th>
									<th>
										Status
									</th>
									<th>
										Remark
									</th>
									<th>
										Extra <br /> Charges <br /> Applied
									</th>
									<th>
										Deposit <br /> Collected
									</th>
									<?php if (current_url() == site_url('admin/students/archived')) { ?>
									<th>
										Archive At
									</th>

									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php
                                if(count($students)) {
                                foreach($students as $student) {
									if (current_url() == site_url('admin/students/archived')) {
										$student_details = get_student_archive_details($student->student_id);
									}
									else
									{
										$student_details = $student;
									}
                                    $previous_month_balance = 0;
                                    if(isset($student_details->status)) {if($student_details->status==3) {$previous_month_balance = get_previous_month_balance($student_details->student_id, $student_details->class_id);}}
                                ?>
								<tr
									class="<?php if(isset($student_details->student_id)) {if(has_enrollment_content($student_details->student_id, $student_details->class_id, 'depo_collected')=='No' || $previous_month_balance<0) {echo 'bg-danger';}} ?>">
									<?php if (!(current_url() == site_url('admin/students/archived'))) { ?>
									<td><input type="hidden" name="student_id_ref"
											value="<?php echo $student_details->student_id; ?>">
										<input type="hidden" name="class_id_ref"
											value="<?php echo $student_details->class_id; ?>"><input type="checkbox"
											class="checkbox" name="student_id[]"
											value="<?php echo $student_details->student_id;?>" /></td>
									<?php } ?>
									<?php if (current_url() == site_url('admin/students/archived')) { ?>
									<td>
										<a href="<?php echo site_url('admin/students/moveto_active_list/' . $student->student_id) ?>"
											title="Move to active list"><i class="fa fa-reply btn btn-warning"
												aria-hidden="true"></i></a>
										<a href="<?php echo site_url('admin/students/delete-archive/' . $student->student_id) ?>"
											title="Remove Data"
											onclick="return confirm('Are you sure, you will not be able to recover data?')"><i
												class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a>
									</td>
									<?php } ?>
									<td>
										<div class="form-group">
											<select name="action" id="action" class="form-control select2 action"
												style="width: 200px;">
												<option value="">-- Select One --</option>
												<?php if(isset($student_details->student_id)) { ?>
												<option name="Edit"
													value="<?php echo base_url();?>index.php/admin/students/edit/<?php echo $student_details->student_id;?>">
													Edit</option>
												<!-- <option name="Archive" value="<?php echo base_url();?>index.php/admin/students/archive/<?php echo $student_details->student_id;?>">Archive</option> -->
												<option name="final_settlement"
													value="<?php echo base_url();?>index.php/admin/students/final_settlement/<?php echo $student_details->student_id.'/'.$student_details->class_id;?>">
													Final Settlement</option>
												<option value="view_all_details" name="view_all_details"
													data-id="<?php echo $student_details->student_id; ?>"
													data-class="<?php echo $student_details->class_id; ?>"
													data-status="<?php echo $student_details->status; ?>">View all
													details</option>
												<?php if($student_details->status!='') { ?>
												<option value="edit_class" name="edit_class"
													data-id="<?php echo $student_details->student_id; ?>"
													data-class="<?php echo $student_details->class_id; ?>"
													data-status="<?php echo $student_details->status; ?>">Edit Class
												</option>

												<option value="generate_invoice" name="generate_invoice"
													data-id="<?php echo $student_details->student_id; ?>"
													data-class="<?php echo $student_details->class_id; ?>"
													data-status="<?php echo $student_details->status; ?>" data-student="<?php echo $student->firstname . ' ' . $student->lastname; ?>" data-class_code="<?php echo get_class_code_by_class($student_details->class_id); ?>">Generate Invoice
												</option> <?php }} ?>
											</select>
										</div>
									</td>
									<td>
										<select name="material" class="form-control select2">
											<?php if(isset($student_details->student_id)) { ?>
											<?php echo get_material_associated($student_details->sid, $student_details->class_code); ?>
											<?php } ?>
										</select>
									</td>
									<td><?php echo $student->firstname . ' ' . $student->lastname;?></td>
									<td><?php echo $student->email;?></td>
									<td><?php echo isset($student->username) ? $student->username : '-' ?></td>
									<td><?php echo isset($student->nric) ? $student->nric : '-' ?></td>
									<td><?php if(isset($student_details->student_id)) { echo get_class_code_by_class($student_details->class_id); } ?>
									</td>
									<td><?php if(isset($student_details->class_id)) { echo getEnrollmentStatus($student_details->student_id, $student_details->class_id); } else {echo '-';} ?>
									</td>
									<td><?php echo isset($student->gender) ? ($student->gender==0) ? 'Male' : 'Female' : '-' ?>
									</td>
									<td><?php echo isset($student->age) ? $student->age : '-' ?></td>
									<td><?php echo isset($student->phone) ? $student->phone : '-' ?></td>
									<td><?php echo isset($student->parent_first_name ) ? $student->parent_first_name . ' ' . $student->parent_last_name  : '-' ?>
									</td>
									<td><?php echo isset($student->parent_email ) ? $student->parent_email  : '-' ?>
									</td>
									<td><?php echo isset($student->parents_phone ) ? $student->parents_phone  : '-' ?>
									</td>
									<td><?php $siblings = json_decode($student->siblings);
                                    if($siblings) {foreach($siblings as $sibling) {echo $sibling . ', ';}} ?></td>
									<td><?php if(isset($student_details->student_id)) { echo get_enrollment_status($student_details->status); } ?>
									</td>
									<td><?php if(isset($student_details->student_id)) {  echo get_student_remark($student_details->student_id, $student_details->class_id); } ?>
									</td>
									<td><?php if(isset($student_details->student_id)) { echo has_enrollment_content($student_details->student_id, $student_details->class_id, 'extra_charges'); } ?>
									</td>
									<td><?php if(isset($student_details->student_id)) { echo has_enrollment_content($student_details->student_id, $student_details->class_id, 'depo_collected'); } ?>
									</td>
									<?php if (current_url() == site_url('admin/students/archived')) { ?>
									<td><?php if(isset($student_details->student_id)) { echo get_student_archive_at($student_details->student_id); } ?>
									</td>
									<?php } ?>
								</tr>
								<?php
                                }}
                                ?>
							</tbody>
							<tfoot>
								<tr>

									<th><button type="button" class="btn btn-default clearall">Clear All</button></th>
									<th>
										Action
									</th>
									<th>
										Material <br /> Associated
									</th>
									<th>
										Student <br /> Name
									</th>
									<th>
										Student <br /> Email
									</th>
									<th>
										Student <br /> Username
									</th>
									<th>
										Student <br /> NRIC
									</th>
									<th>
										Enrolled <br />classes
									</th>
									<th>
										Enrolled <br />Date
									</th>
									<th>
										Student <br /> Gender
									</th>
									<th>
										Student <br /> Age
									</th>
									<th>
										Student <br /> Phone <br />Number
									</th>
									<th>
										Parents <br />Name
									</th>
									<th>
										Parents <br />Email
									</th>
									<th>
										Parents <br />Phone
									</th>
									<th>
										Siblings
									</th>
									<th>
										Status
									</th>
									<th>
										Remark
									</th>
									<th>
										Extra <br /> Charges <br /> Applied
									</th>
									<th>
										Deposit <br /> Collected
									</th>
									<?php if (current_url() == site_url('admin/students/archived')) { ?>
									<th>
										Archive At
									</th>
									<?php } ?>
								</tr>
							</tfoot>
						</table>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Assign Class</h4>
			</div>
			<?php echo form_open('admin/students/enroll', ['id'  =>  'enrollment_form']); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Select Status: </label>
					<select name="enrollment_type" class="form-control select2" style="width: 100%;">
						<option value="">-- Select One --</option>
						<?php
                                foreach ($enrollment_type as $key => $enroll) {
                                ?>
						<option value="<?php echo ($key+1); ?>">
							<?php echo $enroll; ?>
						</option>
						<?php
                                }
                                ?>
					</select>
				</div>
				<div id="dis_content"></div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="store_type" id="store_type" value="" />
				<input type="hidden" name="old_class_id" id="class_id" value="" />
				<input type="hidden" name="enrollment_status" id="enrollment_status" value="" />
				<input type="hidden" name="student_id" id="student_id" value="" />
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<div class="modal fade" id="myModalEditClass" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Assign Class Updates</h4>
			</div>
			<?php echo form_open('admin/students/enroll/update_enrollment'); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Status: Enrolled</label>
					<input type="hidden" name="enrollment_type" value="3">
				</div>
				<div id="dis_content1"></div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="student_id" id="student_id" value="" />
				<input type="hidden" name="class_id" id="class_id" value="" />
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<div class="modal fade" id="ViewAllDetails" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">View Details</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 display_content">

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="myInvoiceModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<?php echo form_open('admin/students/generate-invoice'); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Generate Invoice</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Student Name</label>: <span class="student_id"></span>
							<input type="hidden" name="student_id">
						</div>
						<div class="form-group">
							<label>Class Code</label>: <span class="class_id"></span>
							<input type="hidden" name="class_id">
						</div>
						<div class="form-group">
							<label>Deposit</label>
							<input type="text" class="form-control" name="deposit" id="" required>
						</div>
						<div class="form-group">
							<label>Lesson Fees</label>
							<input type="text" class="form-control" name="lesson_fees" id="" required>
						</div>
						<div class="form-group">
							<label>Material Fees</label>
							<input type="text" class="form-control" name="material_fees" id="" required>
						</div>
						<div class="form-group">
							<label>Extra Charges</label>
							<input type="text" class="form-control" name="extra_charges" id="" required>
						</div>
						<div class="form-group">
							<label>Previous Month Payment</label>
							<input type="text" class="form-control" name="previous_month_payment" id="" required>
						</div>
						<div class="form-group">
							<label>Previous Month Balance</label>
							<input type="text" class="form-control" name="previous_month_balance" id="" required>
						</div>
						<div class="form-group">
							<label>Returned Deposit</label>
							<input type="text" class="form-control" name="returned_deposit" id="" required>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
			<?php echo form_close(); ?>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		function is_checkbox_checked(count) {
			$("button[type='submit']").find("span").text(count);
			if (count > 0) {
				$("button[type='submit']").removeClass('hide');
			} else {
				$("button[type='submit']").addClass('hide');
			}
		}

		$("input[name='select_all_students']").on("change", function () {

			if ($(this).is(":checked")) {
				$(".checkbox").prop("checked", true);
			} else {
				$(".checkbox").prop("checked", false);
			}
			var count = $(".checkbox:checked").length;
			is_checkbox_checked(count);
		});

		$(".checkbox").on("change", function () {
			var count = $(".checkbox:checked").length;
			if ($(".checkbox").length != count) {
				$("input[name='select_all_students']").prop("checked", false);
			} else {
				$("input[name='select_all_students']").prop("checked", true);
			}
			is_checkbox_checked(count);
		});

		$('table tfoot tr th:gt(0)').each(function () {
			var title = $(this).text().trim();
			$(this).html('<input type="text" placeholder="Search ' + title + '" />');
		});

		// DataTable
		var table = $('table').DataTable({
			columnDefs: [{
				targets: 'no-sort',
				orderable: false
			}]
		});

		// Apply the search
		table.columns().every(function () {
			var that = this;

			$('input', this.footer()).on('keyup change', function () {
				if (that.search() !== this.value) {
					that
						.search(this.value)
						.draw();
				}
			});
		});

		$("body").on("click", "button.clearall", function () {
			$("tfoot input").val('');
			table.search('')
				.columns().search('')
				.draw();
		})

		$("body").on('change', "select[name='enrollment_type']", function () {
			var reservation = enrollment = type = "";

			if ($(this).val() == 1) {
				type = 'reservation';

			} else if ($(this).val() == 3) {
				type = 'enroll';
			} else {
				type = 'waitlist';
			}
			if (type) {
				$.ajax({
					type: 'GET',
					url: '<?php echo site_url('admin/students/get_enrollment_type_popup_content'); ?>',
					data: 'type=' + type,
					async: false,
					processData: false,
					contentType: false,
					success: function (data) {
						$("#dis_content").html(data);
					}
				});
			} else {
				$("#dis_content").html('');
			}

			$(".datepicker").datepicker({
				format: 'yyyy-mm-dd'
			});

		});

		$(".add_class").click(function () {
			$("select[name='enrollment_type']").val('').trigger("change");
			$("#dis_content").html('');
			if ($('input.checkbox:checked').length > 0) {
				var student_id = [];

				$("input.checkbox:checked").each(function () {
					student_id.push($(this).val());
				});
				$("#student_id").val(student_id);
				$("#store_type").val('insert');
				$("#myModal").modal();
			} else {
				alert('Please make selection.');
			}
		});

		$("body").on('change', ".action", function () {

			var attrname = $(this).find('option:selected').attr("name");
			var student_id = $(this).find("option:selected").attr("data-id");
			var class_id = $(this).find("option:selected").attr("data-class");
			var student_name = $(this).find("option:selected").attr("data-student");
			var class_code = $(this).find("option:selected").attr("data-class_code");
			var enrollment_status = $(this).find("option:selected").attr("data-status");
			//alert(enrollment_status);
			if (attrname == 'Archive') {
				var archive = confirm("Are you sure you want to archive this student?");
				if (archive == true) {
					window.location = $(this).val();
				}
			}
			if (attrname == 'final_settlement') {
				var archive = confirm("Are you sure you want to Final Settlement this student?");
				if (archive == true) {
					window.location = $(this).val();
				}
			} else if (attrname == 'Edit') {
				window.location = $(this).val();
			} else if (attrname == 'view_all_details') {

				$.ajax({
					type: 'GET',
					url: '<?php echo site_url('admin/students/get_view_all_contents'); ?>',
					data: 'student_id=' + student_id + '&class_id=' + class_id,
					async: false,
					processData: false,
					contentType: false,
					success: function (data) {
						$("div.display_content").html(data);
						$("#ViewAllDetails").modal('show');
					}
				});

			} else if (attrname == 'edit_class') {
				$("input#student_id").val(student_id);
				$("input#class_id").val(class_id);
				$("#store_type").val('update');

				if (enrollment_status == 3) {
					$("#myModalEditClass").modal('show');
					$.ajax({
						type: 'GET',
						url: '<?php echo site_url('admin/students/get_enrollment_type_popup_content_update'); ?>',
						data: 'class_id=' + class_id + '&student_id=' + student_id,
						async: false,
						processData: false,
						contentType: false,
						success: function (data) {
							$("#dis_content1").html(data);
						}
					});
				} else {
					$("#myModal").modal('show');
				}
			} else if (attrname == 'generate_invoice') {
				if (class_id) {
					$("#myInvoiceModal").find("span.student_id").text(student_name);
					$("#myInvoiceModal").find("input[name='student_id']").val(student_id);
					$("#myInvoiceModal").find("span.class_id").text(class_code);
					$("#myInvoiceModal").find("input[name='class_id']").val(class_id);
					$("#myInvoiceModal").modal("show");
				} else {
					alert("No Class has been assigned.");
				}
			}
			$(this).val('');
		});

		$("body").on("change", "input[name='select_all_students']", function () {
			$('input.checkbox').not(this).prop('checked', this.checked);
		});

		$("body").on("change", "select[name='class_code']", function () {
			$("button[type='submit']").attr("disabled", false);
			var enrollment_type = $("select[name='enrollment_type']").val();
			var class_id = $(this).val();
			if (enrollment_type != 2) {
				$.ajax({
					type: 'GET',
					url: '<?php echo site_url('admin/students/get_class_size'); ?>',
					data: 'class_id=' + class_id + '&enrollment_type=' + enrollment_type,
					async: false,
					processData: false,
					contentType: false,
					success: function (data) {
						$("p.class_size").html(data);
						enrollment_decision();
					}
				});
			}

			$.ajax({
				type: 'GET',
				url: '<?php echo site_url('admin/students/get_class_deposit_amount'); ?>',
				data: 'class_id=' + class_id,
				async: false,
				processData: false,
				contentType: false,
				success: function (data) {
					$("span.deposit").html(data);
					//enrollment_decision();
				}
			});
		});

		function enrollment_decision() {
			var enrollment_type = $("select[name='enrollment_type']").val();
			var class_size = ($("p.class_size").text()).split('/').map(Number);
			if (class_size[0] == class_size[1] && enrollment_type == 3) {
				$("select[name='enrollment_type']").val('').trigger("change");
				$("#dis_content").html(
					'<p class="text-danger">Class is enrolled fully. Please select another class to proceed.</p>'
					);
				$("button[type='submit']").attr("disabled", true);
			} else {
				var class_id = $("select[name='class_code']").val();
				var student_id = $("input#student_id").val();
				$.ajax({
					type: 'GET',
					url: '<?php echo site_url('admin/students/enrollment_decision'); ?>',
					data: 'class_id=' + class_id + '&student_id=' + student_id,
					async: false,
					processData: false,
					contentType: false,
					success: function (data) {
						if (data.trim() == true) {
							$("select[name='enrollment_type']").val('').trigger("change");
							$("#dis_content").html(
								'<p class="text-success">You are already enrolled for this class.</p>'
								);
						}
					}
				});
			}
			//

		}


	});

</script>
