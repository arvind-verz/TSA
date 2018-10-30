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
                    <?php echo form_open('admin/students/store'); ?>
                    <div class="box-body">
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="name" class="form-control" value="<?php echo set_value('name');?>">
                        </div>
                        <div class="form-group">
                         <label for="">NRIC</label>
                         <input type="text" name="nric" class="form-control" value="<?php echo set_value('nric');?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="tel" name="phone" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Age</label>
                            <input type="number" name="age" class="form-control" value="">
                        </div>
                        
                        <div class="form-group">
                        <div class="row">
                            <div class="col-sm-1"><label for="">Gender</label></div>
                            <div class="col-sm-2">
                            <label class="radio-inline">
                                 <input name="gender" checked="checked"  value="0" type="radio" />Male
                             </label>
                            </div>
                            <div class="col-sm-2">
                             <label class="radio-inline">
                                  <input name="gender" value="1" type="radio" />Female
                             </label>
                            </div>
                         </div>
                        </div>
                        <div class="form-group">
                            <label for="">Parent Name</label>
                            <input type="text" name="parent_name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Parent Email</label>
                            <input type="email" name="parent_email" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Siblings</label>
                            <input type="text" name="siblings" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Parents Phone</label>
                            <input type="text" name="parents_phone" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="passconf" class="form-control" value="">
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