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

            <?php echo form_open('safelogin/login/forget_process'); ?>

            <div class="form-group has-feedback">

                <input type="email" name="email" class="form-control" placeholder="Email">

                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

            </div>

            

            <div class="col-xs-4">

                    <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>

                </div>

            <?php echo form_close(); ?>

        </div>

    </div>

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