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
                    <?php echo form_open('admin/classes/store'); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for=""><?php echo CLASSES ?> Name</label>
                            <input type="text" name="class_name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo TUTOR ?> ID</label>
                            <input type="text" name="tutor_id" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Level</label>
                            <select name="level" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="0">S1</option>
                                <option value="1">S2</option>
                                <option value="2">S3</option>
                                <option value="3">S4</option>
                                <option value="4">S5</option>
                                <option value="5">S6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Subject</label>
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
                            <label for=""><?php echo CLASSES ?> Code</label>
                            <input type="text" name="class_code" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Frequency <span class="text-muted">(per month)</span></label>
                            <input type="text" name="frequency" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Time</label>
                            <input type="text" name="class_time" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Day</label>
                            <select name="class_day" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Month</label>
                            <select name="class_month" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Monthly Fees</label>
                            <input type="text" name="monthly_fees" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Deposit Fees</label>
                            <input type="text" name="deposit_fees" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo CLASSES ?> Size</label>
                            <input type="text" name="class_size" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Remark</label>
                            <textarea name="remark" class="form-control" rows="3"></textarea>
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