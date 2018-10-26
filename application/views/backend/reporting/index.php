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
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-hover" id="datatable" style="width:100%">
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
                                <tbody>
                                    <?php
                                    if(count($report_data)) {
                                    foreach($report_data as $value) {
                                    $class_code = get_class_code($value->student_id);
                                    ?>
                                    <tr>
                                        <td><?php echo $class_code['class_code']; ?></td>
                                        <td><?php echo get_subject_code($value->student_id); ?></td>
                                        <td><?php echo $class_code['tutor_id']; ?></td>
                                        <td><?php echo get_students_enrolled($value->student_id); ?></td>
                                        <td><?php get_currency('INR'); echo isset($value->total_amount_excluding_material) ? $value->total_amount_excluding_material : '-'; ?></td>
                                        <td><?php get_currency('INR'); echo isset($value->total_material_amount) ? $value->total_material_amount : '-'; ?></td>
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