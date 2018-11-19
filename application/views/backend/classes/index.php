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
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/classes/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . CLASSES ?>
                        </a>
                        <a class="pull-right" href="<?php echo site_url('admin/classes/archived') ?>">
                            <i aria-hidden="true" class="fa fa-archive">
                            </i> <?php echo ARCHIVED . ' ' . CLASSES ?>
                        </a>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo CLASSES ?> Name
                                    </th>
                                    <th>
                                        <?php echo CLASSES ?> Code
                                    </th>
                                    <th>
                                        <?php echo TUTOR ?> ID
                                    </th>
                                    <th>
                                        <?php echo SUBJECT ?>
                                    </th>
                                    <th>
                                        Time
                                    </th>
                                    <th>
                                        Frequency
                                    </th>
                                    <th>
                                        Day
                                    </th>
                                    <th>
                                        Monthly Fees(S$)
                                    </th>
                                    <th>
                                        Level
                                    </th>
                                    <th>
                                        Class Size
                                    </th>
                                    <?php
                                    if (current_url() == site_url('admin/classes/archived')) {
                                    ?>
                                    <th>
                                        <?php echo ARCHIVED ?> At
                                    </th>
                                    <?php
                                    }
                                    ?>
                                    <th>
                                        <?php echo ACTION ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($classes)) {
                                foreach ($classes as $class) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo isset($class->class_name) ? $class->class_name : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($class->class_code) ? $class->class_code : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($class->tutor_id) ? $class->tutor_id : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($class->subject) ? get_subject_classes($class->subject) : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($class->class_time) ? $class->class_time : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($class->class_day) ? $class->class_day : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($class->class_month) ? $class->class_month : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($class->monthly_fees) ? $class->monthly_fees : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($class->level) ? level($class->level) : '-'; ?>
                                    </td>
                                    <td>
                                        <?php echo isset($class->class_size) ? get_students_enrolled($class->class_code) . '/' . $class->class_size : '-' ?>
                                    </td>
                                    <?php
                                    if (current_url() == site_url('admin/classes/archived')) {
                                    ?>
                                    <td>
                                        <?php echo isset($class->archive_at) ? date('d-m-Y H:i A', strtotime($class->archive_at)) : '-' ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('admin/classes/moveto_active_list/' . $class->class_id) ?>" title="Move to active list"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                    </td>
                                    <?php
                                    } else {
                                    ?>
                                    <td>
                                        <a href="<?php echo site_url('admin/classes/edit/' . $class->class_id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                        <a href="<?php echo site_url('admin/classes/delete/' . $class->class_id) ?>" onclick="return confirm('Are you sure you want to archive?')" title="Archive"><i class="fa fa-archive btn btn-danger" aria-hidden="true"></i></a>
                                    </td>
                                    <?php }?>
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
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable').DataTable({
        "order": [
            [0, "desc"]
        ]
    });
});
</script>