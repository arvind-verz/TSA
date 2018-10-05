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
                        <?php echo form_open('admin/sms_template/sms_template_update/' . $sms_template->id); ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Template Name</label>
                                <input type="text" name="template_name" class="form-control" value="<?php echo isset($sms_template->template_name) ? $sms_template->template_name : '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Assign Condition</label>
                                <select name="assign_condition" class="form-control select2">
                                    <option value="">-- Select One --</option>
                                    <?php
                                    $i = 1;
                                    foreach($sms_condition as $condition) {
                                    ?>
                                    <option value="<?php echo $i; ?>" <?php if($sms_template->reason==$i) {echo 'selected';} ?>><?php echo $condition; ?></option>
                                    <?php
                                    $i++;}
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Message Content</label>
                                <textarea name="message" class="form-control" rows="5"><?php echo isset($sms_template->message) ? $sms_template->message : '' ?></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="<?php echo site_url('admin/sms_template'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                            <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>