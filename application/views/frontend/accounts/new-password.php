
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>TSA</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body col-lg-12">
        <?php $this->load->view('backend/include/messages')?>
        <?php if (validation_errors()) {?>
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo validation_errors(); ?>
            </div>
        </div>
        <?php }?>
        <div class="col-lg-12">
            <?php echo form_open('login/reset-password/new-password/process/'); ?>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password" value="">
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="">
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                </div>
                <!-- /.col -->
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>