<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php print_r($page_title); ?></h1>
        <?php print_r($breadcrumbs); ?>
    </section> 
	<?php $this->load->view('backend/include/messages') ?>
   
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/students/update/' . $student->student_id); ?>
                    <div class="box-body">
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="name" class="form-control" value="<?php echo isset($student->name) ? $student->name : '' ?>">
                        </div>
                        <div class="form-group">
                         <label for="">NRIC</label>
                         <input type="text" name="nric" class="form-control" value="<?php echo isset($student->nric) ? $student->nric : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo isset($student->email) ? $student->email : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo isset($student->username) ? $student->username : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="tel" name="phone" class="form-control" value="<?php echo isset($student->phone) ? $student->phone : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Age</label>
                            <input type="number" name="age" class="form-control" value="<?php echo isset($student->age) ? $student->age : '' ?>">
                        </div>
                        
                        <div class="form-group">
                        <div class="row">
                            <div class="col-sm-1"><label for="">Gender</label></div>
                            <div class="col-sm-2">
                            <label class="radio-inline">
                                 <input name="gender"  value="0" <?php echo $student->gender==0 ? 'checked="checked"' : '' ?> type="radio" />Male
                             </label>
                            </div>
                            <div class="col-sm-2">
                             <label class="radio-inline">
                                  <input name="gender" <?php echo $student->gender==1 ? 'checked="checked"' : '' ?> value="1" type="radio" />Female
                             </label>
                            </div>
                         </div>
                        </div>
                        <div class="form-group">
                            <label for="">Parent Name</label>
                            <input type="text" name="parent_name" class="form-control" value="<?php echo isset($student->parent_name) ? $student->parent_name : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Parent Email</label>
                            <input type="email" name="parent_email" class="form-control" value="<?php echo isset($student->parent_email) ? $student->parent_email : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Siblings</label>
                            <input type="text" name="siblings" class="form-control" value="<?php echo isset($student->siblings) ? $student->siblings : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Parents Phone</label>
                            <input type="text" name="parents_phone" class="form-control" value="<?php echo isset($student->parents_phone) ? $student->parents_phone : '' ?>">
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
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>