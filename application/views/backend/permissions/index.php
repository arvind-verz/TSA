<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
    <?php //echo '<pre>'; print_r($permissions); echo '</pre>';?>
</section>
<?php
$this->load->view('backend/include/messages');  ?>
<!-- Main content -->
<section class="content">
    
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <a class="btn btn-info" href="<?php echo site_url('admin/permission/create') ?>">
                        <i aria-hidden="true" class="fa fa-plus-circle">
                        </i> <?php echo CREATE . ' ' . PERMISSION ?>
                    </a>
                </div>
                
                <div class="box-body">
                    
                    <table style="table-layout: fixed; width: 100%;">
                        <tbody><tr>
                            <td>
                                <div style="width: 100%; overflow-x: auto;">
                                    <div id="brands_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-12"><table id="brands" class="table dataTable no-footer" role="grid" aria-describedby="brands_info">
                                        <thead>
                                            <tr role="row"><th>Role Name</th><th>Modules</th><th>Role Access</th><th>Action</th></tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($permissions as $permission):?>                                        <tr role="row" class="odd">
                                                <td><?php echo $permission->name;?></td>
                                                <td><?php echo implode(",",$modules);?></td>
                                                <td>
                                                    View, Create, Edit, Delete
                                                </td>
                                                <td class="text-center sorting_1">
                                                    <a class="btn btn-app edit" title="Edit Permission" href="<?php echo site_url('admin/permission/edit/'.$permission->id) ?>"><i class="fa fa-edit"></i> Edit</a>
                                                    <a class="btn btn-app delete" title="Delete Permission" onclick="return confirm('Are you sure to delete this?')" href="<?php echo site_url('admin/permission/delete/'.$permission->id) ?>"><i class="fa fa-trash"></i> Delete</a></td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                        </table></div></div></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    
                </div>
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/role/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . ROLE ?>
                        </a>
                    </div>
                    
                    <div class="box-body">
                        
                        <table style="table-layout: fixed; width: 100%;">
                            <tbody><tr>
                                <td>
                                    <div style="width: 100%; overflow-x: auto;">
                                        <div id="brands_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-12"><table class="table dataTable no-footer">
                                            <thead><tr role="row"><th>Name</th><th>Permission Type</th><th>Creation Date</th><th>Last Login</th><th>Last Updated</th><th>Action</th></tr></thead>
                                            <tbody>
                                                <?php foreach($users as $user):
                                                $detail=$this->permission->get_permission_details($user->role_type_id);
                                                ?>                                        <tr>
                                                    <td><?php echo $user->first_name.' '.$user->last_name;?></td>
                                                    <td><?php echo $detail->name;?></td>
                                                    <td><?php echo $user->created_at;?></td>
                                                    <td><?php echo $user->created_at;?></td>
                                                    <td><?php echo $user->updated_at ;?></td>
                                                    <td>
                                                        <a class="btn btn-app edit" title="Edit Permission" href="<?php echo site_url('admin/role/edit/'.$user->id) ?>"><i class="fa fa-edit"></i> Edit</a>
                                                        <a class="btn btn-app delete" title="Delete Permission" onclick="return confirm('Are you sure to delete this?')" href="<?php echo site_url('admin/user/delete/'.$user->id) ?>"><i class="fa fa-trash"></i> Delete</a></td>
                                                    </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table></div></div></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>