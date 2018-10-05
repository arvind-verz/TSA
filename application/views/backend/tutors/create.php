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
                    <?php echo form_open('admin/tutors/store'); ?>
                    <div class="box-body">
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="tutor_name" class="form-control" value="<?php echo set_value('tutor_name');?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="tel" name="phone" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div> 
                        <div class="form-group">
                            <label for="">Salary Scheme</label>
                            <select name="salary_scheme" id="salary_scheme" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="0">Scheme 1</option>
                                <option value="1">Scheme 2</option>
                                <option value="2">Scheme 3</option>
                                <option value="3">Scheme 4</option>
                               
                            </select>
                        </div>                       
                        <div class="form-group">
                            <label for="">Remarks </label>
                            <input type="text" name="remarks" class="form-control" value="">
                        </div>
                         <div class="form-group">
                            <label for="">Subject </label>
                            <select name="subject" id="subject" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="0">subject 1</option>
                                <option value="1">subject 2</option>
                                <option value="2">subject 3</option>
                                <option value="3">subject 4</option>
                               
                            </select>
                        </div>  
                         <div class="form-group">
                            <label for="">Tutor Permission</label>
                            <select name="tutor_permission" id="tutor_permission" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option value="0">Permission 1</option>
                                <option value="1">Permission 2</option>
                                <option value="2">Permission 3</option>
                                <option value="3">Permission 4</option>
                               
                            </select>
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