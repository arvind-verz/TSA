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
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/order/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . ORDER ?>
                        </a>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo ACTION ?>
                                    </th>
                                    <th>
                                        <?php echo ORDER ?> ID
                                    </th>
                                    <th>
                                        <?php echo ORDER ?> Date
                                    </th>
                                    <th>
                                        <?php echo CLASSES ?> Code
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Select <?php echo STUDENT ?>
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(count($orders)) {
                                foreach($orders as $order) {
                                ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm update_status">Submit</button>
                                    </td>
                                    <td>
                                        <input type="hidden" name="order_id" class="form-control" value="<?php echo $order->order_id;  ?>">
                                        <?php echo isset($order->order_id) ? $order->order_id : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($order->order_date) ? date('Y-m-d H:i A', strtotime($order->order_date)) : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($order->class_code) ? $order->class_code : '-' ?>
                                    </td>
                                    <td>
                                        <select name="order_status" class="form-control select2">
                                            <option value="0">Print</option>
                                            <option value="1">Given</option>
                                            <option value="2">Cancel</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="order_student_id" class="form-control select2" multiple="multiple">
                                            <?php get_order_student_content($order->order_id, $order->class_code); ?>
                                        </select>
                                    </td>
                                    
                                </tr>
                                <?php
                                }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $("button.update_status").on("click", function() {
        var order_id = $(this).parents("tr").find("input[name='order_id']").val();
        var status = $(this).parents("tr").find("select[name='order_status']").val();
        var student_id = $(this).parents("tr").find("select[name='order_student_id']").val();
        if(status != '' && student_id != '') {
            $.get("<?php echo site_url('admin/order/update_order_status'); ?>", {status : status, student_id : student_id, order_id : order_id}, function(data) {
                window.location.href = data.trim();
            })
        }
        else {
            alert("Please select appropriate option to proceed.");
        }
    })
</script>