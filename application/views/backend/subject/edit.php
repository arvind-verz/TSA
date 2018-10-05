<?php $subject = $subject[0] ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title); ?>
        </h1>
        <?php print_r($breadcrumbs); ?>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/subject/update/' . $subject->subject_id); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for=""><?php echo SUBJECT ?> Name</label>
                            <input type="text" name="subject_name" class="form-control" value="<?php echo isset($subject->subject_name) ? $subject->subject_name : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo SUBJECT ?> Code</label>
                            <input type="text" name="subject_code" class="form-control" value="<?php echo isset($subject->subject_code) ? $subject->subject_code : '' ?>">
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('admin/subject'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>