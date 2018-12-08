<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>

    <?php $this->load->view('backend/include/messages') ;
    if (validation_errors()) {?>
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo validation_errors(); ?>
            </div>
        </div>
    <?php }
    ?>
    
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/tutors/store'); ?>
                    <div class="box-body">
                        <div class="form-group">
                          <label for="">Tutor ID</label>
                          <input type="text" name="tutor_id" class="form-control" value="<?php echo set_value('tutor_id');?>">
                      </div>
                        <div class="form-group">
                          <label for="">Tutor Name</label>
                          <input type="text" name="tutor_name" class="form-control" value="<?php echo set_value('tutor_name');?>">
                      </div>

                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo set_value('email');?>">
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="tel" name="phone" class="form-control" value="<?php echo set_value('phone');?>">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" class="form-control"><?php echo set_value('address');?></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="">Salary Scheme</label>
                        <select name="salary_scheme" id="salary_scheme" class="form-control select2">
                            <option value="">-- Select One --</option>
                            <option value="1" <?php echo  set_select('salary_scheme', '1'); ?>>Fixed</option>
                            <option value="2" <?php echo  set_select('salary_scheme', '2'); ?>>Variable</option>
                        </select>
                    </div>                       
                    <div class="form-group">
                        <label for="">Remarks </label>
                        <input type="text" name="remarks" class="form-control" value="<?php echo set_value('remarks');?>">
                    </div>
                    <div class="form-group">
                        <label for="">Subject </label>
                        <select name="subject[]" id="subject" class="form-control select2" multiple="multiple">
                            <option value="">-- Select One --</option>
                            <?php if(count($subjects)>0){
                              foreach($subjects as $subject):?>
                                 <option value="<?php echo $subject->subject_code;?>" <?php echo  set_select('subject[]', $subject->subject_code); ?>><?php echo $subject->subject_name;?></option>
                             <?php endforeach;}?>

                         </select>
                     </div>  

                     <div class="form-group">
                        <label>Tutor Permission</label>
                        <select name="tutor_permission" id="tutor_permission" class="form-control select2">
                            <option value="">-- Select One --</option>
                            <?php
                            if(count($permission_data)) {
                                foreach($permission_data as $value) {
                                    ?>
                                    <option value="<?php echo isset($value->id) ? $value->id : '' ?>"><?php echo isset($value->name) ? $value->name : ''; ?></option>
                                    <?php
                                }}
                                ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" value="">
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?php echo site_url('admin/tutors'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo SUBMIT ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>