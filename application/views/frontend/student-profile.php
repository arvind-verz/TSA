<div class="main-container">
	<!-- Sub Nav Section -->
	<div class="sub-nav bg-color1">
		<div class="container">
			<div class="navigation"></div>
			<ul>
				<li class="selected"><a href="<?php echo site_url('student-profile'); ?>">My Profile </a></li>
				<li><a href="<?php echo site_url('student-classes'); ?>">My Classes</a></li>
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
					<h1 class="title1 text-center txt-dark animated growIn" data-id="1">My <span>profile</span></h1>
				</div>
				<div class="row pt40">
					<div class="col-md-6">
						<div class="row-inner-md">
							<div class="tbl-holder">
								<div class="scroll-container">
									<table border="0" align="center" cellpadding="0" cellspacing="0" class="scrl-tbl xs tbl-odd-event">
										<thead>
											<tr>
												<th colspan="2">Student’s Details</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><strong>NRIC</strong></td>
												<td><?php echo isset($student_profile->nric) ? $student_profile->nric : '-'; ?></td>
											</tr>
											<tr>
												<td><strong>Full Name</strong></td>
												<td><?php echo isset($student_profile->name) ? $student_profile->name : '-'; ?></td>
											</tr>
											<tr>
												<td><strong>Email Address</strong></td>
												<td><?php echo isset($student_profile->email) ? $student_profile->email : '-'; ?></td>
											</tr>
											<tr>
												<td><strong>Username</strong></td>
												<td><?php echo isset($student_profile->username) ? $student_profile->username : '-'; ?></td>
											</tr>
											<!-- <tr>
													<td><strong>Password</strong></td>
													<td>noone</td>
											</tr> -->
											<tr>
												<td><strong>Phone Number</strong></td>
												<td><?php echo isset($student_profile->phone) ? $student_profile->phone : '-'; ?></td>
											</tr>
											<tr>
												<td><strong>Age</strong></td>
												<td><?php echo isset($student_profile->age) ? $student_profile->age : '-'; ?></td>
											</tr>
											<tr>
												<td><strong>Gender</strong></td>
												<td><?php echo isset($student_profile->gender) ? ($student_profile->gender==0) ? 'Male' : 'Female' : '-'; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row-inner-md">
							<div class="tbl-holder">
								<div class="scroll-container">
									<table border="0" align="center" cellpadding="0" cellspacing="0" class="scrl-tbl xs tbl-odd-event">
										<thead>
											<tr>
												<th colspan="2">Parent’s Details</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><strong>Full Name</strong></td>
												<td><?php echo isset($student_profile->parent_name) ? $student_profile->parent_name : '-'; ?></td>
											</tr>
											<tr>
												<td><strong>Email Address</strong></td>
												<td><?php echo isset($student_profile->parent_email) ? $student_profile->parent_email : '-'; ?></td>
											</tr>
											<tr>
												<td><strong>Phone Number</strong></td>
												<td><?php echo isset($student_profile->parents_phone) ? $student_profile->parents_phone : '-'; ?></td>
											</tr>
											<tr>
												<td><strong>Siblings</strong></td>
												<td>
													<?php
													$siblings = json_decode($student_profile->siblings);
													if(count($siblings)) {
														foreach($siblings as $sibling) {
															echo ucwords($sibling) . ', <br/>';
														}
													}
													else {
													echo isset($student_profile->siblings) ? $student_profile->siblings : '-';
													}
													
													?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Section END -->
</div>