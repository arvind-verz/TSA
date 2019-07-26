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
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo CLASSES ?> Code
                                    </th>
                                    <th>
                                        <?php echo STUDENT ?> Name
                                    </th>
                                    <th>
                                        <?php echo STUDENT ?> NRIC
                                    </th>
                                    <th>
                                        SMS Sent Date
                                    </th>
                                    <th>
                                        Pre-Condition
                                    </th>
                                    <th>
                                        <?php echo SMS_TEMPLATE ?> Used
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        <?php echo ACTION ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($sms_history) {
                                foreach($sms_history as $history) {
								$student_details = get_student_details_by_sms_history(ltrim($history->recipient, '65'));
                                $pre_condition_template = get_pre_condition_template($history->template_id);
                                ?>
                                <tr>
                                    <td><?php echo isset($history->class_code) ? $history->class_code : '-'; ?></td>
                                    <td><?php echo isset($student_details['student_name']) ? $student_details['student_name'] : '-'; ?></td>
                                    <td><?php echo isset($student_details['student_nric']) ? $student_details['student_nric'] : '-'; ?></td>
                                    <td><?php echo isset($history->created_at) ? date('d M, Y H:i A', strtotime($history->created_at)) : '-'; ?></td>
                                    <td><?php echo isset($pre_condition_template['pre_condition']) ? $pre_condition_template['pre_condition'] : '-'; ?></td>
                                    <td><?php echo isset($pre_condition_template['template_name']) ? $pre_condition_template['template_name'] : '-'; ?></td>
                                    <td><?php echo isset($history->status) ? ($history->status==1) ? '<p class="text-success">Sent</p>' : '<p class="text-danger">Not Sent</p>' : '-'; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('admin/delete_sms_history/' . $history->id) ?>" onclick="return confirm('Are you sure you want to delete this SMS Record?')" title="Remove Data"><i class="fa fa-archive btn btn-danger" aria-hidden="true"></i></a>
                                    </td>
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
    </section>
</div>
