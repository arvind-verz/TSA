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
                    <?php echo form_open('admin/material/update/' . $book->material_id); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for=""><?php echo BOOK ?> Name</label>
                            <input type="text" name="book_name" class="form-control" value="<?php echo isset($book->book_name) ? $book->book_name : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo BOOK ?> Price</label>
                            <input type="text" name="book_price" class="form-control" value="<?php echo isset($book->book_price) ? $book->book_price : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo BOOK ?> Version</label>
                            <input type="text" name="book_version" class="form-control" value="<?php echo isset($book->book_version) ? $book->book_version : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Subject</label>
                            <select name="subject[]" class="form-control select2" multiple="multiple">
                                <option value="">-- Select One --</option>
                                <?php
                                if(count($subjects)) {
                                foreach($subjects as $subject) {
                                $subject_id = json_decode($book->subject);
                                ?>
                                <option value="<?php echo $subject->id ?>" <?php if(in_array($subject->id, $subject_id)) {echo 'selected';} ?>><?php echo $subject->subject_name ?></option>
                                <?php
                                }}
                                ?>
                            </select>
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