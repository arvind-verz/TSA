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
                        </i> Create Permission</a>
                    </div>
                    <div class="box-body">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Title</th>
                                        <th>Modules Access</th>
                                        <th>Role Access</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    if(count($permission_data)) {
                                    foreach($permission_data as $value) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo site_url('admin/users/roles-and-permission/edit/' . $value->id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                            <a href="<?php echo site_url('admin/users/roles-and-permission/delete/' . $value->id) ?>" title="Remove" onclick="return confirm('Are you sure you want to delete this?');"><i class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a>
                                        </td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo get_permission_access_module($value->id); ?></td>
                                        <td>View, Create, Edit, Delete</td>
                                        
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
                        </i> Create Roles</a>
                    </div>
                    <div class="box-body">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Permission Type</th>
                                        <th>Date of Account Creation</th>
                                        <th>Last Login</th>
                                        <th>Last Updated</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    if(count($users_data)) {
                                    foreach($users_data as $value) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo site_url('admin/users/edit/' . $value->aauth_users_id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                            <a href="<?php echo site_url('admin/users/delete/' . $value->aauth_users_id) ?>" title="Remove" onclick="return confirm('Are you sure you want to delete this?');"><i class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a>
                                        </td>
                                        <td><?php echo !empty($value->username) ? $value->username : '-'; ?></td>
                                        <td><?php echo !empty($value->user_type) ? get_user_type($value->user_type) : '-'; ?></td>
                                        <td><?php echo !empty($value->date_created) ? date("d M, Y H:i A", strtotime($value->date_created)) : '-'; ?></td>
                                        <td><?php echo !empty($value->last_login) ? date("d M, Y H:i A", strtotime($value->last_login)) : '-'; ?></td>
                                        <td><?php echo !empty($value->updated_at) ? date("d M, Y H:i A", strtotime($value->updated_at)) : '-'; ?></td>
                                        
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
<script type="text/javascript">
    $(document).ready(function() {
        $("table").DataTable();
    });
</script>