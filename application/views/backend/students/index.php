<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>
    <?php
    $this->load->view('backend/include/messages');  ?>
    <!-- Main content -->
    <section class="content">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/students/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . STUDENT ?>
                        </a>
                        <p class="text-right">
                            <?php if (!(current_url() == site_url('admin/students/archived'))) { ?>
                        <a href="javascript:void(0);" class="add_class">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> Add <?php echo CLASSES ?>
                        </a> | 
                        <?php } ?>
                        <a class="" href="<?php echo site_url('admin/students/archived') ?>">
                            <i aria-hidden="true" class="fa fa-archive">
                            </i> <?php echo ARCHIVED . ' ' . STUDENT ?>
                        </a>

                    </p>
                    
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <?php if (!(current_url() == site_url('admin/students/archived'))) { ?>
                                    <th class="no-sort">#</th>
                                <?php } ?>
                                    <th>
                                        Student <br/> Name
                                    </th>
                                    <th>
                                        Student <br/> Email
                                    </th>
                                    <th>
                                        Student <br/> Username
                                    </th>
                                    <th>
                                        Student <br/> NRIC
                                    </th>
                                    <th>
                                        Enrolled <br />classes
                                    </th>
                                    <th>
                                        Student <br/> Gender
                                    </th>
                                    <th>
                                        Student <br/> Age
                                    </th>
                                    <th>
                                        Student <br/> Phone <br />Number
                                    </th>
                                    <th>
                                        Parents <br />Name
                                    </th>
                                    <th>
                                        Parents <br />Email
                                    </th>
                                    <th>
                                        Parents <br />Phone
                                    </th>
                                    <th>
                                        Siblings
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Remark
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                    <th>
                                        Material <br /> Associated
                                    </th>
                                    <th>
                                        Extra <br /> Charges <br /> Applied
                                    </th>
                                    <th>
                                        Deposit <br /> Collected
                                    </th>
                                    <?php if (current_url() == site_url('admin/students/archived')) { ?>
                                    <th>
                                        Archive At
                                    </th>
                                    <th>
                                        #
                                    </th>
                                <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(count($students)) {
                                foreach($students as $student) {
                                ?>
                                <tr>
                                    <?php if (!(current_url() == site_url('admin/students/archived'))) { ?>
                                    <td><input type="checkbox" class="checkbox" name="student_id" value="<?php echo $student->student_id;?>"/></td>
                                <?php } ?>
                                    <td><?php echo $student->name;?></td>
                                    <td><?php echo $student->email;?></td>
                                    <td><?php echo isset($student->username) ? $student->username : '-' ?></td>
                                    <td><?php echo isset($student->nric) ? $student->nric : '-' ?></td>
                                    <td><?php print_r(get_enrolled_classes($student->student_id));?></td>
                                    <td><?php echo isset($student->gender) ? ($student->gender==0) ? 'Male' : 'Female' : '-' ?></td>
                                    <td><?php echo isset($student->age) ? $student->age : '-' ?></td>
                                    <td><?php echo isset($student->phone) ? $student->phone : '-' ?></td>
                                    <td><?php echo isset($student->parent_name ) ? $student->parent_name  : '-' ?></td>
                                    <td><?php echo isset($student->parent_email ) ? $student->parent_email  : '-' ?></td>
                                    <td><?php echo isset($student->parents_phone ) ? $student->parents_phone  : '-' ?></td>
                                    <td><?php echo isset($student->siblings) ? $student->siblings  : '-' ?></td>
                                    <td><?php //echo get_enrollment_status($student->student_id;); ?></td>
                                    <td><?php echo isset($student->remark) ? $student->remark : '-' ?></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="action" id="action" class="form-control select2 action" style="width: 200px;">
                                                <option value="">-- Select One --</option>
                                                <option name="Edit" value="<?php echo base_url();?>index.php/admin/students/edit/<?php echo $student->student_id;?>">Edit</option>
                                                <option name="Archive" value="<?php echo base_url();?>index.php/admin/students/archive/<?php echo $student->student_id;?>">Archive</option>
                                                <option value="Final Settlement">Final Settlement</option>
                                                <option value="<?php echo base_url();?>index.php/admin/students/?sid=<?php echo $student->student_id;?>">View all details</option>
                                                <option value="<?php echo base_url();?>index.php/admin/students/?sid=<?php echo $student->student_id;?>">Edit Class</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <?php if (current_url() == site_url('admin/students/archived')) { ?>
                                        <td><?php echo isset($class->updated_at) ? date('d-m-Y H:i A', strtotime($class->updated_at)) : '-' ?></td>
                                        <td>
                                            <a href="<?php echo base_url();?>index.php/admin/students/moveto_active_list/<?php echo $student->student_id;?>" title="Move to active list"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php
                                }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assign Class</h4>
            </div>
            <?php echo form_open('admin/students/enroll', ['id'  =>  'enrollment_form']); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Select Status: </label>
                        <select name="enrollment_type" class="form-control select2" style="width: 100%;">
                            <option value="">-- Select One --</option>
                            <?php                                
                                foreach ($enrollment_type as $key => $enroll) {
                                ?>
                                <option value="<?php echo ($key+1); ?>">
                                    <?php echo $enroll; ?>
                                </option>
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                    <div id="dis_content"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="student_id" id="student_id" value="" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
                <?php echo form_close(); ?>
        </div>

    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("table").dataTable({
        columnDefs: [
          { targets: 'no-sort', orderable: false }
        ]
    });

    $("body").on('change', "select[name='enrollment_type']", function(){
        var reservation = enrollment = type = "";

        if($(this).val()==1)
        {
            type = 'reservation';
            
        }
        else if($(this).val()==3)
        {
            type = 'enroll';
        }
        else
        {
            type = '';
        }
        if(type) {
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('admin/students/get_enrollment_type_popup_content'); ?>',
                data: 'type=' + type,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $("#dis_content").html(data);
                }
            });
        }
        else {
            $("#dis_content").html('');
        }
        
        $(".datepicker").datepicker({format: 'yyyy-mm-dd'});
        
    });

    $(".add_class").click(function () {
        $("select[name='enrollment_type']").val('').trigger("change");
        $("#dis_content").html('');
        if($('input.checkbox:checked').length==1){
            var val = $("input.checkbox:checked").val();
            $("#student_id").val(val);
            $("#myModal").modal();
        }
        else if($('input.checkbox:checked').length>1) {
            alert("Select one student to proceed.");
        }
        else
        {
            alert('Please make atleast one selection.');
        }
    });

    $(".action").on('change', function(){
        var attrname=$(this).find('option:selected').attr("name");
        if(attrname=='Archive')
        {
        var archive=confirm("Are you sure you want to archive this student?");
            if (archive==true){
            window.location=$(this).val();
            }   
        }
        else if(attrname=='Edit')
        {
        
            window.location=$(this).val();
            
        }
    });

    $("body").on("change", "select[name='class_code']",  function() {
        $("button[type='submit']").attr("disabled", false);
        var class_id = $(this).val();
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('admin/students/get_class_size'); ?>',
            data: 'class_id=' + class_id,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $("p.class_size").html(data);
                enrollment_decision();
            }
        });
    });

    function enrollment_decision()
    {
        var class_size = $("p.class_size").text();
        class_size.split('/');
        if(class_size[0]==class_size[1])
        {
            $("#dis_content").html('<p class="text-success">Class is enrolled fully. Please select another class to proceed.</p>');
            $("button[type='submit']").attr("disabled", true);
        }
        var class_id = $("select[name='class_code']").val();
        var student_id = $("input#student_id").val();
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('admin/students/enrollment_decision'); ?>',
            data: 'class_id=' + class_id + '&student_id=' + student_id,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                if(data.trim()==true)
                {
                    $("#dis_content").html('<p class="text-success">You are already enrolled for this class.</p>');
                }
            }
        });

    }
    
});
</script>