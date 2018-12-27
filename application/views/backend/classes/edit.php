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
                    <?php echo form_open('admin/classes/update/' . $classes->class_id); ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for=""><?php echo CLASSES ?> Name</label>
                            <input type="text" name="class_name" class="form-control" value="<?php echo isset($classes->class_name) ? $classes->class_name : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo TUTOR ?> ID</label>
                            <select name="tutor_id" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <?php
                                if(count($tutors)) {
                                foreach($tutors as $tutor) {
                                ?>
                                <option value="<?php echo $tutor->tutor_id; ?>" <?php if($classes->tutor_id==$tutor->tutor_id) {echo "selected";} ?>><?php echo $tutor->tutor_id; ?></option>
                                <?php
                                }}
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Level</label>
                            <select name="level" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="1" <?php if($classes->level==1) {echo 'selected';} ?>>S1</option>
                                <option value="2" <?php if($classes->level==2) {echo 'selected';} ?>>S2</option>
                                <option value="3" <?php if($classes->level==3) {echo 'selected';} ?>>S3</option>
                                <option value="4" <?php if($classes->level==4) {echo 'selected';} ?>>S4</option>
                                <option value="5" <?php if($classes->level==5) {echo 'selected';} ?>>S5</option>
                                <option value="6" <?php if($classes->level==6) {echo 'selected';} ?>>S6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Subject</label>
                            <select name="subject[]" class="form-control select2" multiple="multiple">
                                <?php
                                if(count($subjects)) {
                                foreach($subjects as $subject) {
                                $subject_id = json_decode($classes->subject);
                                ?>
                                <option value="<?php echo $subject->id; ?>" <?php if($classes->subject) {if(in_array($subject->id, $subject_id)) {echo 'selected';}} ?>><?php echo $subject->subject_name; ?></option>
                                <?php
                                }}
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo CLASSES ?> Code</label>
                            <input type="text" name="class_code" class="form-control" value="<?php echo isset($classes->class_code) ? $classes->class_code : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Frequency <span class="text-muted">(per month)</span></label>
                            <input type="number" name="frequency" class="form-control" value="<?php echo isset($classes->frequency) ? $classes->frequency : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Time</label>
                            <input type="text" name="class_time" class="form-control" value="<?php echo isset($classes->class_time) ? $classes->class_time : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Day</label>
                            <select name="class_day" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="Monday" <?php if($classes->class_day=="Monday") {echo 'selected';} ?>>Monday</option>
                                <option value="Tuesday" <?php if($classes->class_day=="Tuesday") {echo 'selected';} ?>>Tuesday</option>
                                <option value="Wednesday" <?php if($classes->class_day=="Wednesday") {echo 'selected';} ?>>Wednesday</option>
                                <option value="Thursday" <?php if($classes->class_day=="Thursday") {echo 'selected';} ?>>Thursday</option>
                                <option value="Friday" <?php if($classes->class_day=="Friday") {echo 'selected';} ?>>Friday</option>
                                <option value="Saturday" <?php if($classes->class_day=="Saturday") {echo 'selected';} ?>>Saturday</option>
                                <option value="Sunday" <?php if($classes->class_day=="Sunday") {echo 'selected';} ?>>Sunday</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Month</label>
                            <select name="class_month" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="January" <?php if($classes->class_month=="January") {echo 'selected';} ?>>January</option>
                                <option value="February" <?php if($classes->class_month=="February") {echo 'selected';} ?>>February</option>
                                <option value="March" <?php if($classes->class_month=="March") {echo 'selected';} ?>>March</option>
                                <option value="April" <?php if($classes->class_month=="April") {echo 'selected';} ?>>April</option>
                                <option value="May" <?php if($classes->class_month=="May") {echo 'selected';} ?>>May</option>
                                <option value="June" <?php if($classes->class_month=="June") {echo 'selected';} ?>>June</option>
                                <option value="July" <?php if($classes->class_month=="July") {echo 'selected';} ?>>July</option>
                                <option value="August" <?php if($classes->class_month=="August") {echo 'selected';} ?>>August</option>
                                <option value="September" <?php if($classes->class_month=="September") {echo 'selected';} ?>>September</option>
                                <option value="October">October</option>
                                <option value="November" <?php if($classes->class_month=="November") {echo 'selected';} ?>>November</option>
                                <option value="December" <?php if($classes->class_month=="December") {echo 'selected';} ?>>December</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Monthly Fees</label>
                            <input type="text" name="monthly_fees" class="form-control" value="<?php echo isset($classes->monthly_fees) ? $classes->monthly_fees : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Deposit Fees</label>
                            <input type="text" name="deposit_fees" class="form-control" value="<?php echo isset($classes->deposit_fees) ? $classes->deposit_fees : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><?php echo CLASSES ?> Size</label>
                            <input type="text" name="class_size" class="form-control" value="<?php echo isset($classes->class_size) ? $classes->class_size : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Remark</label>
                            <textarea name="remark" class="form-control" rows="3"><?php echo isset($classes->remark) ? $classes->remark : '' ?></textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('admin/classes'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>