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
                    <?php echo form_open('admin/order/store'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for=""><?php echo CLASSES ?> Code</label>
                            <select name="class_code" class="form-control select2">
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
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo SUBJECT ?></label>
                            <select name="subject[]" class="form-control select2" multiple="multiple">
                                <option value="">-- Select One --</option>
                                <?php
                                if(count($subjects)) {
                                foreach($subjects as $subject) {
                                ?>
                                <option value="<?php echo $subject->id ?>"><?php echo $subject->subject_name ?></option>
                                <?php
                                }}
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo STUDENT ?></label>
                            <select name="student[]" class="form-control select2" multiple="multiple">
                                <option value="">-- Select One --</option>
                                <?php
                                if(count($students)) {
                                foreach($students as $student) {
                                ?>
                                <option value="<?php echo $student->id ?>"><?php echo $student->name ?></option>
                                <?php
                                }}
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo BOOK ?> ID</label>
                            <select name="book_id" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <?php
                                if(count($books)) {
                                foreach($books as $book) {
                                ?>
                                <option value="<?php echo $book->id ?>"><?php echo $book->material_id ?></option>
                                <?php
                                }}
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('admin/order'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo SUBMIT ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>