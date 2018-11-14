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