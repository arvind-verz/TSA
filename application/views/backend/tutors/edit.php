<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php print_r($page_title); ?></h1>
        <?php print_r($breadcrumbs); ?>
    </section>
	<?php
	$this->load->view('backend/include/messages');
	//$subjects=$this->tutors->get_subjects();
	?>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/tutors/update/' . $tutor->user_id); ?>
                    <div class="box-body">
                        <div class="form-group">
                          <label for="">Tutor ID</label>
                          <input type="text" name="tutor_id" class="form-control" value="<?php echo isset($tutor->tutor_id) ? $tutor->tutor_id : '' ?>">
                        </div>
                        <div class="form-group">
                          <label for="">First Name</label>
                          <input type="text" name="firstname" class="form-control" value="<?php echo isset($tutor->firstname) ? $tutor->firstname : '' ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo isset($tutor->lastname) ? $tutor->lastname : '' ?>">
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
                                <option <?php if($tutor->salary_scheme==1) echo 'selected="selected"';?>  value="1">Fixed</option>
                                <option <?php if($tutor->salary_scheme==2) echo 'selected="selected"';?> value="2">Variable</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Remarks</label>
                            <textarea name="remarks" class="form-control"><?php echo isset($tutor->remark) ? $tutor->remark : '' ?></textarea>
                        </div>
                       <div class="form-group">
                            <label for="">Subject </label>
                            <select name="subject[]" id="subject" class="form-control select2" multiple="multiple">
                                <option value="">-- Select One --</option>
                                <?php if(count($subjects)>0){
                                    $subject_code_list = json_decode($tutor->subject);
								      foreach($subjects as $subject):?>
									  <option <?php if(count($subject_code_list)) {if(in_array($subject->subject_code, $subject_code_list) && count($subject_code_list)) {echo 'selected';}}?> value="<?php echo $subject->subject_code;?>"><?php echo $subject->subject_name;?></option>
								<?php endforeach;}?>

                            </select>
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo isset($tutor->user_id) ? $tutor->user_id : null; ?>">
                        <div class="form-group">
                                <label>Tutor Permission</label>
                                <select name="tutor_permission" id="tutor_permission" class="form-control select2">
                                    <option value="">-- Select One --</option>
                                    <?php
                                    if(count($permission_data)) {
                                    foreach($permission_data as $value) {
                                    ?>
                                    <option <?php if($value->id==$tutor->perm_id) echo 'selected';?> value="<?php echo isset($value->id) ? $value->id : '' ?>"><?php echo isset($value->name) ? $value->name : ''; ?></option>
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
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
  $(document).ready(function() {
    $("input[name='phone']").on("change", function() {
      $("input[name='password']").val($(this).val());
    });
  });
</script>
