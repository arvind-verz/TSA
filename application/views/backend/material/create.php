<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>

    <?php $this->load->view('backend/include/messages') ?>
    <?php if (validation_errors()) {?>
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo validation_errors(); ?>
            </div>
        </div>
    <?php }?>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/material/store'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for=""><?php echo BOOK ?> ID</label>
                            <input type="text" name="material_id" class="form-control" value="<?php echo set_value('material_id'); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo BOOK ?> Name</label>
                            <input type="text" name="book_name" class="form-control" value="<?php echo set_value('book_name'); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo BOOK ?> Price</label>
                            <input type="text" name="book_price" class="form-control" value="<?php echo set_value('book_price'); ?>">
                        </div>
                        <!-- <div class="form-group">
                            <label for=""><?php echo BOOK ?> Version</label>
                            <input type="text" name="book_version" class="form-control" value="<?php echo set_value('book_version'); ?>">
                        </div> -->
                        <div class="form-group">
                            <label for="">Subject</label>
                            <select name="subject[]" class="form-control select2" multiple="multiple">
                                <option value="">-- Select One --</option>
                                <?php
                                if(count($subjects)) {
                                foreach($subjects as $subject) {
                                ?>
                                <option value="<?php echo $subject->id ?>" <?php echo set_select('subject', $subject->id) ?>><?php echo $subject->subject_name ?></option>
                                <?php
                                }}
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('admin/material'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo SUBMIT ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
