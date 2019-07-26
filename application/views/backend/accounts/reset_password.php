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

        <?php $this->aauth->print_errors(); ?>

        <div class="col-lg-12">

            <?php echo form_open('safelogin/login/reset_process'); ?>

            

            <div class="form-group has-feedback">

                <input type="password" name="password" class="form-control" placeholder="Password">

                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

            </div>

            
			<div class="form-group has-feedback">

                <input type="password" name="conf_password" class="form-control" placeholder="Confirm Password">

                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

            </div>
            <input type="hidden" name="email" value="<?php if(isset($_GET['email'])) echo base64_decode($_GET['email']); else echo $email;?>" />
             <div class="col-xs-4">

                    <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>

                </div>
            <?php echo form_close(); ?>

        </div

    ></div>

    <!-- /.login-box-body -->

</div>

<!-- /.login-box -->

<script type="text/javascript">

$(function() {

$('input').iCheck({

checkboxClass: 'icheckbox_square-blue',

radioClass: 'iradio_square-blue',

increaseArea: '20%' /* optional */

});

});

</script>