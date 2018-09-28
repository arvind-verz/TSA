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
                                    <th>
                                        <?php echo ACTION ?>
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
                                            <option value="">-- Select One --</option>
                                            <?php
                                            if(count($classes)) {
                                            foreach($classes as $class) {
                                            ?>
                                            <option value="<?php echo $class->class_code ?>"><?php echo $class->class_code ?></option>
                                            <?php
                                            }}
                                            ?>
                                        </select>
                                        <?php echo isset($order->status) ? order_status($order->status) : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo isset($order->student_id) ? get_order_student($order->order_id) : '-' ?>
                                    </td>
                                    <td>
                                        -
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