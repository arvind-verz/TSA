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
                        <a class="btn btn-info" href="<?php echo site_url('admin/subject/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . SUBJECT ?>
                        </a>
                        <a class="pull-right" href="<?php echo site_url('admin/subject/archived') ?>">
                            <i aria-hidden="true" class="fa fa-archive">
                            </i> <?php echo ARCHIVED . ' ' . SUBJECT ?>
                        </a>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo SUBJECT ?> Code
                                    </th>
                                    <th>
                                        <?php echo SUBJECT ?> Name
                                    </th>
                                    <?php
                                    if (!(current_url() == site_url('admin/subject/archived'))) {
                                    ?>
                                    <th>
                                        <?php echo CREATED ?> At
                                    </th>
                                    <th>
                                        <?php echo UPDATED ?> At
                                    </th>
                                    <?php
                                    } else {
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
                                if(count($subjects)) {
                                foreach($subjects as $subject) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo isset($subject->subject_code) ? $subject->subject_code : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($subject->subject_name) ? $subject->subject_name : '-' ?>
                                    </td>
                                    <?php
                                    if (!(current_url() == site_url('admin/subject/archived'))) {
                                    ?>
                                    <td>
                                        <?php echo isset($subject->created_at) ? date('Y-m-d H:i A', strtotime($subject->created_at)) : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($subject->updated_at) ? date('Y-m-d H:i A', strtotime($subject->updated_at)) : '-' ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('admin/subject/edit/' . $subject->subject_id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                        <a href="<?php echo site_url('admin/subject/delete/' . $subject->subject_id) ?>" onclick="return confirm('Are you sure you want to archive?')" title="Archive"><i class="fa fa-archive btn btn-danger" aria-hidden="true"></i></a>
                                    </td>
                                    <?php
                                    } else {
                                    ?>
                                    <td>
                                        <?php echo isset($subject->archive_at) ? date('Y-m-d H:i A', strtotime($subject->archive_at)) : '-' ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('admin/subject/moveto_active_list/' . $subject->subject_id) ?>" title="Move to active list"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>