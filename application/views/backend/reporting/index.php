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
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="text" name="date_from" class="form-control datepicker" value="<?php echo date('d-m-Y'); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="text" name="date_to" class="form-control datepicker" value="<?php echo date('d-m-Y'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-hover"  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Class Code</th>
                                        <th>Subject Code</th>
                                        <th>Tutor ID</th>
                                        <th>No of Students Enrolled</th>
                                        <th>Fees</th>
                                        <th>Material Fees</th>
                                    </tr>
                                </thead>
                                <tbody class="display_data">
                                    <?php
                                    if(count($report_data)) {
                                    foreach($report_data as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo get_class_code_by_class($value->class_id); ?></td>
                                        <td><?php echo get_subject_code($value->student_id); ?></td>
                                        <td><?php echo get_tutor_of_class($value->class_id); ?></td>
                                        <td><?php echo get_students_enrolled($value->class_id); ?></td>
                                        <td><?php get_currency('SGD'); echo isset($value->total_amount_excluding_material) ? $value->total_amount_excluding_material : '-'; ?></td>
                                        <td><?php get_currency('SGD'); echo isset($value->total_material_amount) ? $value->total_material_amount : '-'; ?></td>
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
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $('.datepicker').datepicker({
			autoclose: true,
			format: 'dd-mm-yyyy',
			weekStart: 1
		})
        $("table").dataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv'
            ]
        });
        $("input[name='date_from'], input[name='date_to']").on("change", function() {
            var date_from = $("input[name='date_from']").val();
            var date_to = $("input[name='date_to']").val();

            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('admin/reporting/get_reporting_sheet'); ?>',
                data: 'date_from=' + date_from + '&date_to=' + date_to,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    //alert(data);
                    $(".display_data").html(data);
                    /*$("table").dataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'csv'
                        ]
                    });*/
                }
            })
        });
    });
</script>
