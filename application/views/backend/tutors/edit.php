<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php print_r($page_title); ?></h1>
        <?php print_r($breadcrumbs); ?>
    </section> 
	<?php 
	$this->load->view('backend/include/messages');
	$subjects=$this->tutors->get_subjects();
	?>
   
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/tutors/update/' . $tutor->tutor_id); ?>
                    <div class="box-body">
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="tutor_name" class="form-control" value="<?php echo isset($tutor->tutor_name) ? $tutor->tutor_name : '' ?>">
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo isset($tutor->email) ? $tutor->email : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="tel" name="phone" class="form-control" value="<?php echo isset($tutor->phone) ? $tutor->phone : '' ?>">
                        </div>
                       
                            <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" class="form-control"><?php echo isset($tutor->address) ? $tutor->address : '' ?></textarea>
                        </div> 
                        
                        <div class="form-group">
                            <label for="">Salary Scheme</label>
                            <select name="salary_scheme" id="salary_scheme" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <option <?php if($tutor->salary_scheme==0) echo 'selected="selected"';?>  value="0">Fixed</option>
                                <option <?php if($tutor->salary_scheme==1) echo 'selected="selected"';?> value="1">Variable</option>
                               
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="remarks" class="form-control"><?php echo isset($tutor->remark) ? $tutor->remark : '' ?></textarea>
                        </div> 
                       <div class="form-group">
                            <label for="">Subject </label>
                            <select name="subject" id="subject" class="form-control select2">
                                <option value="">-- Select One --</option>
                                <?php if(count($subjects)>0){
								      foreach($subjects as $subject):?>
									  <option <?php if($subject->subject_code==$tutor->subject) echo 'selected="selected"';?> value="<?php echo $subject->subject_code;?>"><?php echo $subject->subject_name;?></option>
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
                                    <option <?php if($value->id==$tutor->tutor_permission) echo 'selected="selected"';?> value="<?php echo isset($value->id) ? $value->id : '' ?>"><?php echo isset($value->name) ? $value->name : ''; ?></option>
                                    <?php
                                    }}
                                    ?>
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
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>