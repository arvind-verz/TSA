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
                    <?php echo form_open('admin/classes/store'); ?>
                    <div class="box-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for=""><?php echo CLASSES ?> Code</label>
                                <select name="class_code" class="form-control select2">
                                    <option value="">-- Select One --</option>
                                    <?php
                                    if (count($classes)) {
                                    foreach ($classes as $class) {
                                    ?>
                                    <option value="<?php echo $class->class_code ?>"><?php echo $class->class_code ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="text" name="attendance_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="form-group pull-right">
                                <button type="button" class="btn btn-info copy_fist_line">Copy First Line</button>
                                <button type="button" class="btn btn-info">Transfer</button>
                                <select name="class_code" class="select2">
                                    <option value="">-- Select One --</option>
                                    <?php
                                    if (count($classes)) {
                                    foreach ($classes as $class) {
                                    ?>
                                    <option value="<?php echo $class->class_code ?>"><?php echo $class->class_code ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Attendance Status</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody class="display_data">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="L" readonly>
                                            <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="M" readonly>
                                            <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="E" readonly>
                                            <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="X" readonly>
                                            <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="G" readonly>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('admin/classes'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo SUBMIT ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
$("body").on("change", "select[name='class_code']", function() {
    var class_code = $("select[name='class_code']").val();
    var content = '<tr> <td></td><td></td><td> <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="L" readonly> <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="M" readonly> <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="E" readonly> <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="X" readonly> <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="G" readonly> </td><td></td></tr>';
    if (class_code != '') {
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('admin/attendance/get_attendance_sheet'); ?>',
            data: 'class_code=' + class_code,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                //alert(data);
                $("tbody.display_data").html(data);
            }
        })
    } else {
        $("tbody.display_data").html(content);
    }
});
$("body").on("change", ".attendance", function() {
    var current = $(this).parents("td").find("input.attendance");
    var check_storage = [];
    current.each(function() {
        if ($(this).val() > 1) {
            current.val(0);
        }
        if ($(this).val() == 1) {
            check_storage.push(1);
        }
        if ($(this).val() == 1 && check_storage.length > 1) {
            current.val(0);
        }
    });
});

$("button.copy_fist_line").on("click", function() {
    var current_value = $("input[name='attendance_value1[]']");
    var i = 2;
    current_value.each(function() {
        $("td input.attendance:nth-of-type("+i+")").val($(this).val());
        i++;
    });
});
</script>