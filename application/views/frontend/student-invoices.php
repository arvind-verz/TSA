<div class="main-container">
	<!-- Sub Nav Section -->
	<div class="sub-nav bg-color1">
		<div class="container">
			<div class="navigation"></div>
			<ul>
				<li><a href="<?php echo site_url('student-profile'); ?>">My Profile </a></li>
				<li><a href="<?php echo site_url('student-classes'); ?>">My Classes</a></li>
				<li class="selected"><a href="<?php echo site_url('student-invoices'); ?>">Invoices</a></li>
			</ul>
		</div>
	</div>
	<!-- Sub Nav Section END -->
	<!-- Section -->
	<div class="fullcontainer">
		<div class="container">
			<div class="inner-container-md">
				<div class="animatedParent" data-sequence="300">
					<h1 class="title1 text-center txt-dark animated growIn" data-id="1"><span>Invoice</span></h1>
				</div>
				<div class="tbl-holder pt40">
					<div class="scroll-container">
						<table border="0" align="center" cellpadding="0" cellspacing="0" class="scrl-tbl  tbl-odd-event">
							<thead>
								<tr>
									<th width="20%">Invoice ID</th>
									<th>Month of invoice</th>
									<th width="30%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(count($student_invoices)) {
								foreach($student_invoices as $invoice) {
								?>
								<tr>
									<td><strong><?php echo isset($invoice->invoice_no) ? $invoice->invoice_no : '-'; ?></strong></td>
									<td><?php echo isset($invoice->invoice_date) ? date('M', strtotime($invoice->invoice_date)) : '-'; ?></td>
									<td><div class="tbl-action"><a href="<?php echo base_url('assets/files/pdf/invoice/' . $invoice->invoice_file); ?>" target="_blank"><i class="jcon-eye-1 ileft"></i>View</a><a href="<?php echo base_url('assets/files/pdf/invoice/' . $invoice->invoice_file); ?>" download><i class="jcon-download ileft"></i>Download</a></div></td>
								</tr>
								<?php
								}}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Section END -->
</div>