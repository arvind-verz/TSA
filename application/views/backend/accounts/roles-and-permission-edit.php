<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>
    <?php $this->load->view('backend/include/messages')?>
    <?php if (validation_errors()) {?>
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo validation_errors(); ?>
        </div>
    </div>
    <?php }?>
    <?php $this->aauth->print_errors(); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/users/roles-and-permission/update/' . $perm_id); ?>
                    <div class="box-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" type="text" name="name" value="<?php echo isset($permission_data->name) ? $permission_data->name : ''; ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label>Modules</label>
                            <table class="table row border">
                                <tbody>
                                    <?php
                                    $i = 0;
                                    if(count($modules_arr)) {
                                    foreach($modules_arr as $modules) {
                                    ?>
                                    <tr>
                                        <input type="hidden" name="module[<?php echo $i; ?>][name][]" value="<?php echo $modules; ?>">
                                        <th colspan="2" style="border:0;"><?php echo $modules; ?></th>
                                    </tr>
                                    <tr>
                                        <td>View
                                        </td>
                                        <td>
                                            <input type="radio" name="module[<?php echo $i; ?>][view][]" value="1" <?php echo get_module_access_data('views', $modules, 1, $perm_id) ?>>Yes
                                            <input type="radio" name="module[<?php echo $i; ?>][view][]" value="0" <?php echo get_module_access_data('views', $modules, 0, $perm_id) ?>>No
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Create</td>
                                        <td>
                                            <input type="radio" name="module[<?php echo $i; ?>][create][]" value="1" <?php echo get_module_access_data('creates', $modules, 1, $perm_id) ?>>Yes
                                            <input type="radio" name="module[<?php echo $i; ?>][create][]" value="0" <?php echo get_module_access_data('creates', $modules, 0, $perm_id) ?>>No
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Edit</td>
                                        <td>
                                            <input type="radio" name="module[<?php echo $i; ?>][edit][]" value="1" <?php echo get_module_access_data('edits', $modules, 1, $perm_id) ?>>Yes
                                            <input type="radio" name="module[<?php echo $i; ?>][edit][]" value="0" <?php echo get_module_access_data('edits', $modules, 0, $perm_id) ?>>No
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Delete
                                        </td>
                                        <td>
                                            <input type="radio" name="module[<?php echo $i; ?>][delete][]" value="1" <?php echo get_module_access_data('deletes', $modules, 1, $perm_id) ?>>Yes
                                            <input type="radio" name="module[<?php echo $i; ?>][delete][]" value="0" <?php echo get_module_access_data('deletes', $modules, 0, $perm_id) ?>>No
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;}}
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('admin/users'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>