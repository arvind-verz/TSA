<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php print_r($page_title); ?></h1>
        <?php print_r($breadcrumbs); ?>
    </section>
    <?php $this->load->view('backend/include/messages') ?>
    <?php if (validation_errors()) {?>
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo validation_errors(); ?>
            </div>
        </div>
    <?php }?>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open_multipart('admin/students/update/' . $student->student_id); ?>
                    <div class="box-body">
                      <div class="form-group">
                          <label for="">Student First Name</label>
                          <input type="text" name="firstname" class="form-control" value="<?php echo isset($student->firstname) ? $student->firstname : '' ?>">
                      </div>
                      <div class="form-group">
                          <label for="">Student Last Name</label>
                          <input type="text" name="lastname" class="form-control" value="<?php echo isset($student->lastname) ? $student->lastname : '' ?>">
                      </div>
                      <div class="form-group">
                          <label for="">Profile</label>
                          <input type="file" name="profile_picture" class="form-control" value="">
                          <input type="hidden" name="profile_picture_exist" class="form-control" value="<?php echo isset($student->profile_picture) ? $student->profile_picture : '' ?>">
                          <img src="<?php echo isset($student->profile_picture) ? base_url('assets/files/profile_picture/' . $student->profile_picture) : '' ?>" alt="" width="100px">
                      </div>
                      <div class="form-group">
                        <label for="">Student Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo isset($student->email) ? $student->email : '' ?>">
                    </div>
                    <div class="form-group">
                       <label for="">Student NRIC</label>
                       <input type="text" name="nric" class="form-control" value="<?php echo isset($student->nric) ? $student->nric : '' ?>">
                   </div>


                   <div class="form-group">
                    <label for="">Student Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo isset($student->username) ? $student->username : '' ?>">
                </div>
                <div class="form-group">
                    <label for="">Student Phone</label>
                    <input type="tel" name="phone" class="form-control" value="<?php echo isset($student->phone) ? $student->phone : '' ?>">
                </div>
                <div class="form-group">
                    <label for="">Student Age</label>
                    <input type="number" name="age" class="form-control" value="<?php echo isset($student->age) ? $student->age : '' ?>">
                </div>
                <div class="form-group">
                    <label>Student Gender</label>
                    <select name="gender"  class="form-control select2">
                        <option value="0" <?php echo $student->gender==0 ? 'checked="checked"' : '' ?>>Male</option>
                        <option value="1" <?php echo $student->gender==1 ? 'checked="checked"' : '' ?>>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="">Salutation</label>
                            <select name="salutation" class="form-control select2">
                                <option value="Mr." <?php if($student->salutation=='Mr.') {echo 'selected';} ?>>Mr.</option>
                                <option value="Ms." <?php if($student->salutation=='Ms.') {echo 'selected';} ?>>Ms.</option>
                                <option value="Dr." <?php if($student->salutation=='Dr.') {echo 'selected';} ?>>Dr.</option>
                                <option value="Mrs." <?php if($student->salutation=='Mrs.') {echo 'selected';} ?>>Mrs.</option>
                                <option value="Mdm." <?php if($student->salutation=='Mdm.') {echo 'selected';} ?>>Mdm.</option>
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <label for="">Parent First Name</label>
                            <input type="text" name="parent_first_name" class="form-control" value="<?php echo isset($student->parent_first_name) ? $student->parent_first_name : '' ?>">
                        </div>
                        <div class="col-lg-5">
                            <label for="">Parent Last Name</label>
                            <input type="text" name="parent_last_name" class="form-control" value="<?php echo isset($student->parent_last_name) ? $student->parent_last_name : '' ?>">
                        </div>
                </div>
                <div class="form-group">
                    <label for="">Parent Email</label>
                    <input type="email" name="parent_email" class="form-control" value="<?php echo isset($student->parent_email) ? $student->parent_email : '' ?>">
                </div>
                <div class="form-group">
                    <?php
                    $siblings = isset($student->siblings) ? json_decode($student->siblings) : '';
                    if(count($siblings)<1)
                    {
                        $query = $this->db->like('siblings', $student->nric, 'both')->group_by('nric')->get(DB_STUDENT);
                        $result = $query->result();
                        foreach($result as $row)
                        {
                            $siblings[] = $row->firstname . ' ' . $row->lastname . ' - ' . $row->nric;
                        }
                    }
                    ?>
                    <label for="">Siblings</label>
                    <select name="siblings[]" class="form-control select2" multiple>
                        <?php if(student_names) {
                        foreach($student_names as $student_name) { ?>
                        <option value="<?php echo $student_name->firstname . ' ' . $student_name->lastname . ' - ' . $student_name->nric; ?>" <?php if($siblings) {if(in_array($student_name->firstname . ' ' . $student_name->lastname . ' - ' . $student_name->nric, $siblings)) {echo 'selected';}} ?>><?php echo $student_name->firstname . ' ' . $student_name->lastname . ' - ' . $student_name->nric; ?></option>
                        <?php }} ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Parents Phone</label>
                    <input type="text" name="parents_phone" class="form-control" value="<?php echo isset($student->parents_phone) ? $student->parents_phone : '' ?>">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" name="password" class="form-control" value="">
                </div>
            </div>
            <div class="box-footer">
                <a href="<?php echo site_url('admin/students'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
</section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("input[name='nric']").on("change", function() {
            $("input[name='username']").val($(this).val());
        });
    });
</script>
