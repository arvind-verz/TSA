<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>
    <?php $this->load->view('backend/include/messages') ?>
    
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/billing/store'); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Name</label>
                                        <input type="text" name="billing_name[]" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Range</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right date_range" name="date_range[]">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-5">
                                        <label>
                                            <input type="checkbox" class="flat-green form-control" name="rest_week[0]" value="1"> Rest Week
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Name</label>
                                        <input type="text" name="billing_name[]" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Range</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right date_range" name="date_range[]">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-5">
                                        <label>
                                            <input type="checkbox" class="flat-green form-control" name="rest_week[1]" value="1"> Rest Week
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Name</label>
                                        <input type="text" name="billing_name[]" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Range</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right date_range" name="date_range[]">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-5">
                                        <label>
                                            <input type="checkbox" class="flat-green form-control" name="rest_week[2]" value="1"> Rest Week
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Name</label>
                                        <input type="text" name="billing_name[]" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Range</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right date_range" name="date_range[]">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-5">
                                        <label>
                                            <input type="checkbox" class="flat-green form-control" name="rest_week[3]" value="1"> Rest Week
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Invoice Generation Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" name="invoice_generation_date" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('admin/billing'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo SUBMIT ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>