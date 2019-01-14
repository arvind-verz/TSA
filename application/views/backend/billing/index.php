<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title); ?>
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
                  <?php echo form_open('admin/billing/archive'); ?>
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/billing/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . BILLING ?>
                        </a>
                        <a class="pull-right" href="<?php echo site_url('admin/billing/archived') ?>">
                            <i aria-hidden="true" class="fa fa-archive">
                                </i> <?php echo ARCHIVED . ' ' . BILLING ?>
                            </a>
                            <button type="submit" class="btn btn-primary hide pull-right">Archive Selected <span class="badge"></span></button>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                  <?php
                                      if (!(current_url() == site_url('admin/billing/archived'))) {
                                  ?>
                                  <th class="no-sort" width="15px">
                                      <input type="checkbox" name="select_all_billing">
                                  </th>
                                  <?php } ?>
                                    <th>
                                        <?php echo ACTION ?>
                                    </th>
                                    <th>
                                        Billing Title
                                    </th>
                                    <th>
                                        <?php echo INVOICE ?> Generation Date
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(count($billings)) {
                                foreach($billings as $billing) {
                                ?>
                                <tr>
                                  <?php
                                  if (!(current_url() == site_url('admin/billing/archived'))) {
                                      ?>
                                      <td>
                                          <input type="checkbox" class="checkbox" name="billing_id[]" value="<?php echo $billing->id;?>"/>
                                      </td>
                                        <td>
                                            <a href="<?php echo site_url('admin/billing/edit/' . $billing->id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                        </td>
                                      <?php
                                  } else {
                                      ?>
                                      <td>
                                          <a href="<?php echo site_url('admin/billing/moveto_active_list/' . $billing->id) ?>" title="Move to active list"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                          <a href="<?php echo site_url('admin/billing/delete-archive/' . $billing->id) ?>" title="Remove Data" onclick="return confirm('Are you sure, you will not be able to recover data?')"><i class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a>
                                      </td>
                                      <?php
                                  }
                                  ?>
                                    <td>
                                        <?php echo isset($billing->billing_title) ? $billing->billing_title : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($billing->invoice_generation_date) ? date('d-m-Y H:i', strtotime($billing->invoice_generation_date)) : '-' ?>
                                    </td>

                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        function is_checkbox_checked(count) {
            $("button[type='submit']").find("span").text(count);
            if(count>0) {
                $("button[type='submit']").removeClass('hide');
            }
            else {
                $("button[type='submit']").addClass('hide');
            }
        }

        $("input[name='select_all_billing']").on("change", function() {

            if($(this).is(":checked")) {
                $(".checkbox").prop("checked", true);
            }
            else {
                $(".checkbox").prop("checked", false);
            }
            var count = $(".checkbox:checked").length;
            is_checkbox_checked(count);
        });

        $(".checkbox").on("change", function() {
            var count = $(".checkbox:checked").length;
            if($(".checkbox").length!=count)
            {
                $("input[name='select_all_billing']").prop("checked", false);
            }
            else {
                $("input[name='select_all_billing']").prop("checked", true);
            }
            is_checkbox_checked(count);
        });
      });
    </script>
