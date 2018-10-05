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
                        <a class="btn btn-info" href="<?php echo site_url('admin/material/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . BOOK ?>
                        </a>
                        <a class="pull-right" href="<?php echo site_url('admin/material/archived') ?>">
                            <i aria-hidden="true" class="fa fa-archive">
                            </i> <?php echo ARCHIVED . ' ' . MATERIAL ?>
                        </a>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo BOOK ?> Name
                                    </th>
                                    <th>
                                        <?php echo BOOK ?> Version
                                    </th>
                                    <th>
                                        <?php echo BOOK ?> Price
                                    </th>
                                    <th>
                                        <?php echo SUBJECT ?>
                                    </th>
                                    <th>
                                        <?php echo CREATED ?> At
                                    </th>
                                    <?php
                                    if (current_url() == site_url('admin/material/archived')) {
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
                                if (count($books)) {
                                foreach ($books as $book) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo isset($book->book_name) ? $book->book_name : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($book->book_version) ? $book->book_version : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($book->book_price) ? $book->book_price : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($book->subject) ? get_subject_classes($book->subject) : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($book->created_at) ? date('Y-m-d H:i A', strtotime($book->created_at)) : '-' ?>
                                    </td>
                                    <?php
                                    if (current_url() == site_url('admin/material/archived')) {
                                    ?>
                                    <td>
                                        <?php echo isset($book->archive_at) ? date('d-m-Y H:i A', strtotime($book->archive_at)) : '-' ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('admin/material/moveto_active_list/' . $book->material_id) ?>" title="Move to active list"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                    </td>
                                    <?php
                                    } else {
                                    ?>
                                    <td>
                                        <a href="<?php echo site_url('admin/material/edit/' . $book->material_id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                        <a href="<?php echo site_url('admin/material/delete/' . $book->material_id) ?>" onclick="return confirm('Are you sure you want to archive?')" title="Archive"><i class="fa fa-archive btn btn-danger" aria-hidden="true"></i></a>
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