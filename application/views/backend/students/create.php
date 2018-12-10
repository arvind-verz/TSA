<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>

    <?php $this->load->view('backend/include/messages') ?>
    <?php if (validation_errors()) {?>
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo validation_errors(); ?>
            </div>
        </div>
    <?php }?>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open_multipart('admin/students/store'); ?>
                    <div class="box-body">
                        <div class="form-group">
                          <label for="">Student Name</label>
                          <input type="text" name="name" class="form-control" value="<?php echo set_value('name');?>">
                      </div>
                      <div class="form-group">
                          <label for="">Profile</label>
                          <input type="file" name="profile_picture" class="form-control" value="<?php echo set_value('profile_picture');?>">
                      </div>
                      <div class="form-group">
                        <label for="">Student Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo set_value('email');?>">
                    </div>
                    <div class="form-group">
                       <label for="">Student NRIC</label>
                       <input type="text" name="nric" class="form-control" value="<?php echo set_value('nric');?>">
                   </div>
                   <div class="form-group">
                    <label for="">Student Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo set_value('username');?>">
                </div>
                <div class="form-group">
                    <label for="">Student Phone</label>
                    <input type="tel" name="phone" class="form-control" value="<?php echo set_value('phone');?>">
                </div>
                <div class="form-group">
                    <label for="">Student Age</label>
                    <input type="text" name="age" class="form-control" value="<?php echo set_value('age');?>">
                </div>

                <div class="form-group">
                    <label>Student Gender</label>
                    <select name="gender"  class="form-control select2">
                        <option value="0" <?php echo set_select('gender', '0');?>>Male</option>
                        <option value="1" <?php echo set_select('gender', '1');?>>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Parent Name</label>
                    <input type="text" name="parent_name" class="form-control" value="<?php echo set_value('parent_name');?>">
                </div>
                <div class="form-group">
                    <label for="">Parent Email</label>
                    <input type="email" name="parent_email" class="form-control" value="<?php echo set_value('parent_email');?>">
                </div>
                <div class="form-group">
                    <label for="">Siblings</label>
                    <select name="siblings[]" class="form-control select2" multiple>
                        <?php if(student_names) {
                        foreach($student_names as $student_name) { ?>
                        <option value="<?php echo $student_name->name ?>"><?php echo $student_name->name . ' - ' . $student_name->nric; ?></option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Parents Phone</label>
                    <input type="text" name="parents_phone" class="form-control" value="<?php echo set_value('parents_phone');?>">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" value="">
                </div>
            </div>
            <div class="box-footer">
                <a href="<?php echo site_url('admin/students'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                <button type="submit" class="btn btn-info pull-right"><?php echo SUBMIT ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
</section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("input[name='nric']").on("change", function() {
            $("input[name='username']").val($(this).val());
        });
    });
</script>