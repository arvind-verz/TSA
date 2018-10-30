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
                    <?php echo form_open('admin/users/update/' . $users_id); ?>
                    <div class="box-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : $users_data->username ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $users_data->email ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Access Control</label>
                                <select name="perm_id" class="form-control select2">
                                    <option value="">-- Select One --</option>
                                    <?php
                                    if(count($permission_data)) {
                                    foreach($permission_data as $value) {
                                    ?>
                                    <option value="<?php echo isset($value->id) ? $value->id : '' ?>" <?php if($users_data->perm_id==$value->id) {echo "selected";} ?>><?php echo isset($value->name) ? $value->name : ''; ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                            </div>
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