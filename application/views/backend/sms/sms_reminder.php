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
                    <div class="box-body">
                        <button type="button" class="btn btn-info btn-lg sms_announcement">BROADCAST</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/sms_reminder/store'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Fee Reminder</label>
                            <input class="form-control datepicker" type="text" name="fee_reminder" value="<?php echo isset($fee_reminder->fee_reminder) ? date('Y-m-d', strtotime($fee_reminder->fee_reminder)) : date('Y-m-d'); ?>" placeholder="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Late Fee Reminder</label>
                            <input class="form-control datepicker" type="text" name="late_fee_reminder" value="<?php echo isset($fee_reminder->late_fee_reminder) ? date('Y-m-d', strtotime($fee_reminder->late_fee_reminder)) : date('Y-m-d'); ?>" placeholder="" autocomplete="off">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("button.sms_announcement").on("click", function(e) {
            e.preventDefault();
            var ref = $("button.sms_announcement");
            $(ref).next('p').remove();
            $(ref).attr("disabled", true).html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Please Wait! Processing...');
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('admin/sms_announcement'); ?>',
                data: '',
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $(ref).attr("disabled", false).html('BROADCAST');
                    if(data.trim()=='success') {
                        $(ref).after('<p class="text-success">Success! Message has been broadcast.</p>');
                    }
                    else {
                        $(ref).after('<p class="text-danger">Error! Something went wrong.</p>');
                    }
                }
            })
        });
    });
</script>