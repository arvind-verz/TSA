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
                        <a class="btn btn-info" href="<?php echo site_url('admin/attendance/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . ATTENDANCE ?>
                        </a>
                        <!-- <a class="btn btn-warning" href="<?php echo site_url('admin/attendance/edit') ?>">
                            <i aria-hidden="true" class="fa fa-pencil-square-o">
                            </i> <?php echo EDIT . ' ' . ATTENDANCE ?>
                        </a> -->
                    </div>
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
                                    <option value="<?php echo $class->class_code ?>" data-id="<?php echo $class->class_id; ?>" <?php if($this->session->flashdata('summary_content')) {if($this->session->flashdata('summary_content')['class_code']==$class->class_code) {echo 'selected';}} ?>><?php echo $class->class_code ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Month</label>
                                <select name="class_month" class="form-control select2">
                                    <option value="">-- Select One --</option>
                                    <?php
                                    foreach(get_all_months() as $month) {
                                    ?>
                                    <option value="<?php echo $month ?>" <?php if($this->session->flashdata('summary_content')) {if($this->session->flashdata('summary_content')['class_month']==$month) {echo 'selected';}} ?>><?php echo $month ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <table class="table table-striped table-bordered text-center display_data" style="width:100%">
                            
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
        refresh_summary();
        //$("select[name='class_code']").trigger("change.select2");//$("select[name='class_month']").val('').trigger("change");
        $("body").on("click", "th.attendance", function() {
            var date = $(this).attr("data-date");
            var class_id = $("select[name='class_code'] option:selected").attr("data-id");
            //alert(class_id);
            window.location.href = '<?php echo site_url("admin/attendance/create-edit/") ?>' + class_id + '/' + date;
        });

        $("select[name='class_code'], select[name='class_month']").on("change", function() {
            refresh_summary();
        });

        function refresh_summary() {
            if ($.fn.DataTable.isDataTable(".display_data")) {
                $('.display_data').DataTable().clear().destroy();
            }
            var class_code = $("select[name='class_code']").val();
            var class_month = $("select[name='class_month']").val();
            if(class_month!='' && class_code!='') {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo site_url('admin/attendance/get_attendance_summary'); ?>',
                    data: 'class_code=' + class_code + '&class_month=' + class_month,
                    async: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        //alert(data);
                        $(".display_data").html(data).dataTable({
                            columnDefs: [
                              { targets: 'no-sort', orderable: false }
                            ]
                        });
                    }
                })
            }
        }
    });
</script>