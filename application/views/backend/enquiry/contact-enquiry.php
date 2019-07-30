<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>
    <?php $this->load->view('backend/include/messages')?>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body">
						<div class="col-md-12  table-responsive">
							<table class="table table-striped table-bordered datatable" id="" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Phone No.</th>
										<th>Subject</th>
										<th>Message</th>
										<th>Created At</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($contact_enquiry)
									{
										foreach($contact_enquiry as $enquiry)
										{
									?>
									<tr>
										<td><?php echo isset($enquiry->name) ? $enquiry->name : '-'; ?></td>
										<td><?php echo isset($enquiry->email) ? $enquiry->email : '-'; ?></td>
										<td><?php echo isset($enquiry->phone_no) ? $enquiry->phone_no : '-'; ?></td>
										<td><?php echo isset($enquiry->enquiry_type) ? $enquiry->enquiry_type : '-'; ?></td>
										<td><?php echo isset($enquiry->message) ? $enquiry->message : '-'; ?></td>
										<td data-order="<?php echo isset($enquiry->create_date) ? $enquiry->create_date : ''; ?>"><?php echo isset($enquiry->create_date) ? date('Y-m-d h:i A', strtotime($enquiry->create_date)) : '-'; ?></td>
									</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function() {
	$(".datatable").DataTable({
		"order": [[ 5, "desc" ]]
	});
});
</script>
