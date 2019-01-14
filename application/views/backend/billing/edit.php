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
                    <?php echo form_open('admin/billing/update/' . $billing->id); ?>
                    <div class="box-body">
                        <div class="row">
                            <?php $billing_group = json_decode($billing->billing); ?>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Billing Title</label>
                                        <input type="text" name="billing_title" class="form-control" value="<?php echo $billing->billing_title; ?>">
                                    </div>
                                </div>
                            </div>
                            <?php

                            //die(print_r($billing_group));
                            $i = 0;
                            if($billing_group) {
                            foreach($billing_group as $billings) {
                            ?>
                            <div class="col-lg-12">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Name</label>
                                        <input type="text" name="billing_name[]" class="form-control billing_name" value="<?php echo $billing_group[$i]->billing_name; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Range</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right date_range" name="date_range[]" value="<?php echo $billing_group[$i]->date_range; ?>"  autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-5">
                                        <label>
                                            <input type="checkbox" class="flat-green form-control" name="rest_week[<?php echo $i ?>]" value="1" <?php if(isset($billing_group[$i]->rest_week)) {if($billing_group[$i]->rest_week==1) {echo 'checked';}} ?>> Rest Week
                                            &nbsp;&nbsp;<input type="checkbox" class="flat-green form-control disable_checkbox" name="working_week[<?php echo $i; ?>]" value="1" <?php if(isset($billing_group[$i]->working_week)) {if($billing_group[$i]->working_week==1) {echo 'checked';}} ?>> Disable
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php $i++;}}else {
                                for($i=0;$i<5;$i++) {
                            ?>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for=""><?php echo BILLING ?> Name</label>
                                        <input type="text" name="billing_name[]" class="form-control billing_name" value="">
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
                                            <input type="checkbox" class="flat-green form-control " name="rest_week[<?php echo $i; ?>]" value="<?php echo ($i+1); ?>"> Rest Week
                                            &nbsp;&nbsp;<input type="checkbox" class="flat-green form-control disable_checkbox" name="working_week[<?php echo $i; ?>]" value="1"> Disable
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Invoice Generation Date</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datetimepicker1" name="invoice_generation_date" value="<?php echo date("Y-m-d H:i", strtotime($billing->invoice_generation_date)); ?>" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('admin/billing'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
        $(function () {
            $(".datetimepicker1").datetimepicker({format: 'yyyy-mm-dd hh:ii', weekStart: 1});
        });

        $(document).ready(function() {
          if($("input.disable_checkbox").is(":checked"))
          {
            $("input.disable_checkbox:checked").closest(".col-lg-12").find(".date_range, .billing_name").attr("readonly", true);
          }
          $("input.disable_checkbox").on("ifChanged", function() {
            if($(this).is(":checked"))
            {
              $(this).closest(".col-lg-12").find(".date_range, .billing_name").attr("readonly", true);
            }
            else {
              $(this).closest(".col-lg-12").find(".date_range, .billing_name").attr("readonly", false);
            }
          });
        });
</script>
