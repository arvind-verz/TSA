<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>
    <?php $this->load->view('backend/include/messages');?>
    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/tutors/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                                </i> <?php echo CREATE . ' ' . TUTOR ?>
                            </a>
                            <a class="pull-right" href="<?php echo site_url('admin/tutors/archived') ?>">
                                <i aria-hidden="true" class="fa fa-archive">
                                    </i> <?php echo ARCHIVED . ' ' . TUTOR ?>
                                </a>
                            </div>

                            <div class="box-body table-responsive">
                                <table class="table table-striped table-bordered" id="datatable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tutor ID</th>
                                            <th>
                                                Tutor Name
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>Class Code</th>
                                            <th>
                                                Subject
                                            </th>
                                            <th>
                                                Phone Number
                                            </th>
                                            <th>Salary Scheme</th>
                                            <?php
                                            if (current_url() == site_url('admin/tutors/archived')) {
                                                ?>
                                                <th>Archived At</th>
                                            <?php } ?>
                                            <th>
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($tutors) {
                                            foreach ($tutors as $tutor) {
                                                ?>
                                                <tr>
                                                    <td><?php echo isset($tutor->tutor_id) ? $tutor->tutor_id : '-'; ?></td>
                                                    <td><?php echo isset($tutor->tutor_name) ? $tutor->tutor_name : '-'; ?></td>
                                                    <td><?php echo isset($tutor->email) ? $tutor->email : '-'; ?></td>
                                                    <td><?php //echo get_class_code_by_tutor(); ?></td>
                                                    <td><?php echo isset($tutor->subject) ? get_subject_by_subject_code(json_decode($tutor->subject)) : '-'; ?></td>
                                                    <td><?php echo isset($tutor->phone) ? $tutor->phone : '-' ?></td>
                                                    <td><?php echo isset($tutor->phone) ? $tutor->phone : '-' ?></td>
                                                    <?php
                                                    if (current_url() == site_url('admin/tutors/archived')) {
                                                        ?>
                                                        <td><?php echo isset($tutor->updated_at) ? date('Y-m-d H:i A', strtotime($tutor->updated_at)) : '-'; ?></td>
                                                        <td><a title="Archive" href="<?php echo site_url('admin/tutors/moveto_active_list/'.$tutor->tutor_id) ?>"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a> </td>
                                                    <?php }else { ?>
                                                        <td>
                                                            <a title="Edit" href="<?php echo site_url('admin/tutors/edit/' . $tutor->tutor_id) ?>"><i aria-hidden="true" class="fa fa-pencil-square-o btn btn-warning"></i></a>
                                                            <a title="Edit" href="<?php echo site_url('admin/tutors/archive/' . $tutor->tutor_id) ?>" onclick="return confirm('Are you sure you want to archive this tutor?');"><i aria-hidden="true" class="fa fa-archive btn btn-danger"></i></a>
                                                        </td>
                                                    <?php } ?>
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