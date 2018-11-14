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
                    <div class="box-header with-border">
                        <a href="<?php echo site_url('admin/users/roles-and-permission/create') ?>" class="btn btn-info">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                        </i> Create Permission and Roles</a>
                    </div>
                    <div class="box-body">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Modules</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    if(count($permission_data)) {
                                    foreach($permission_data as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo get_permission_access_module($value->id); ?></td>
                                        <td>
                                            <a href="<?php echo site_url('admin/users/roles-and-permission/edit/' . $value->id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;}}
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="<?php echo site_url('admin/users/create') ?>" class="btn btn-info">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                        </i> Create Users</a>
                    </div>
                    <div class="box-body">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Access Control</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    if(count($users_data)) {
                                    foreach($users_data as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo !empty($value->username) ? $value->username : '-'; ?></td>
                                        <td><?php echo !empty($value->email) ? $value->email : '-'; ?></td>
                                        <td><?php echo !empty($value->name) ? $value->name : '-'; ?></td>
                                        <td><?php echo get_user_type($value->user_type); ?></td>
                                        <td>
                                            <a href="<?php echo site_url('admin/users/edit/' . $value->aauth_users_id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;}}
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