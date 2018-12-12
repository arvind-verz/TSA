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
                        <table class="table table-bordered" style="width:100%">
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
                                    <!-- <th>
                                        #
                                    </th> -->
                                <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(count($students)) {
                                foreach($students as $student) {
                                ?>                                
                                <tr class="<?php if(has_enrollment_content($student->student_id, $student->class_id, 'depo_collected')=='No') {echo 'bg-danger';} ?>">
                                    <?php if (!(current_url() == site_url('admin/students/archived'))) { ?>
                                    <td><input type="hidden" name="student_id_ref" value="<?php echo $student->student_id; ?>">
                                <input type="hidden" name="class_id_ref" value="<?php echo $student->class_id; ?>"><input type="checkbox" class="checkbox" name="student_id" value="<?php echo $student->student_id;?>"/></td>
                                <?php } ?>
                                    <td><?php echo $student->name;?></td>
                                    <td><?php echo $student->email;?></td>
                                    <td><?php echo isset($student->username) ? $student->username : '-' ?></td>
                                    <td><?php echo isset($student->nric) ? $student->nric : '-' ?></td>
                                    <td><?php echo isset($student->class_code) ? $student->class_code : '-' ?></td>
                                    <td><?php echo isset($student->gender) ? ($student->gender==0) ? 'Male' : 'Female' : '-' ?></td>
                                    <td><?php echo isset($student->age) ? $student->age : '-' ?></td>
                                    <td><?php echo isset($student->phone) ? $student->phone : '-' ?></td>
                                    <td><?php echo isset($student->parent_name ) ? $student->parent_name  : '-' ?></td>
                                    <td><?php echo isset($student->parent_email ) ? $student->parent_email  : '-' ?></td>
                                    <td><?php echo isset($student->parents_phone ) ? $student->parents_phone  : '-' ?></td>
                                    <td><?php $siblings = json_decode($student->siblings);
                                    if($siblings) {foreach($siblings as $sibling) {echo $sibling . ', ';}} ?></td>
                                    <td><?php echo get_enrollment_status($student->status); ?></td>
                                    <td><?php echo isset($student->remark) ? $student->remark : '-' ?></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="action" id="action" class="form-control select2 action" style="width: 200px;">
                                                <option value="">-- Select One --</option>
                                                <option name="Edit" value="<?php echo base_url();?>index.php/admin/students/edit/<?php echo $student->student_id;?>">Edit</option>
                                                <option name="Archive" value="<?php echo base_url();?>index.php/admin/students/archive/<?php echo $student->student_id;?>">Archive</option>
                                                <option name="final_settlement" value="<?php echo base_url();?>index.php/admin/students/final_settlement/<?php echo $student->student_id;?>">Final Settlement</option>
                                                <option value="view_all_details" name="view_all_details">View all details</option>
                                                <?php if($student->status!='') { ?>
                                                <option value="edit_class" name="edit_class" data-id="<?php echo $student->student_id; ?>" data-class="<?php echo $student->class_id; ?>">Edit Class</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <select name="material" class="form-control select2">
                                            <?php echo get_material_associated($student->sid, $student->class_code); ?>
                                        </select>
                                    </td>
                                    <td><?php echo has_enrollment_content($student->student_id, $student->class_id, 'extra_charges'); ?></td>
                                    <td><?php echo has_enrollment_content($student->student_id, $student->class_id, 'depo_collected'); ?></td>
                                    <?php if (current_url() == site_url('admin/students/archived')) { ?>
                                        <td><?php echo get_student_archive_at($student->student_id); ?></td>
                                        <!-- <td>
                                            <a href="<?php echo base_url();?>index.php/admin/students/moveto_active_list/<?php echo $student->student_id;?>" title="Move to active list"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                        </td> -->
                                    <?php } ?>
                                </tr>
                                <?php
                                }}
                                ?>
                            </tbody>
                            <tfoot>
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
                                <?php } ?>
                                </tr>
                            </tfoot>
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

<div class="modal fade" id="myModalEditClass" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assign Class Updates</h4>
            </div>
            <?php echo form_open('admin/students/enroll/update_enrollment'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Status: Enrolled</label>
                        <input type="hidden" name="enrollment_type" value="3">
                    </div>
                    <div id="dis_content1"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="student_id" id="student_id" value="" />
                    <input type="hidden" name="class_id" id="class_id" value="" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
                <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="ViewAllDetails" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Details</h4>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 display_content">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('table tfoot tr th').each( function () {
        var title = $(this).text().trim();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('table').DataTable({
        columnDefs: [
          { targets: 'no-sort', orderable: false }
        ]
    });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

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
        if(attrname=='final_settlement')
        {
        var archive=confirm("Are you sure you want to Final Settlement this student?");
            if (archive==true){
            window.location=$(this).val();
            }   
        }
        else if(attrname=='Edit')
        {
        
            window.location=$(this).val();
            
        }
        else if(attrname=='view_all_details')
        {
            var student_id = $(this).parents("tbody").find("input[name='student_id_ref']").val();
            var class_id = $(this).parents("tbody").find("input[name='class_id_ref']").val();
            $.ajax({
            type: 'GET',
            url: '<?php echo site_url('admin/students/get_view_all_contents'); ?>',
            data: 'student_id=' + student_id + '&class_id=' + class_id,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $("div.display_content").html(data);
                $("#ViewAllDetails").modal('show');
            }
        });
            
        }
        else if(attrname=='edit_class')
        {
            var student_id = $(this).parents("tbody").find("input[name='student_id_ref']").val();
            var class_id = $(this).parents("tbody").find("input[name='class_id_ref']").val();
            $("input#student_id").val(student_id);
            $("input#class_id").val(class_id);
            $("#myModalEditClass").modal('show');
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('admin/students/get_enrollment_type_popup_content_update'); ?>',
                data: 'class_id=' + class_id + '&student_id=' + student_id,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $("#dis_content1").html(data);
                }
            });
        }
        $(this).val('');
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
        var class_size = ($("p.class_size").text()).split('/').map(Number);
        if(class_size[0]==class_size[1])
        {
            $("select[name='enrollment_type']").val('').trigger("change");
            $("#dis_content").html('<p class="text-danger">Class is enrolled fully. Please select another class to proceed.</p>');
            $("button[type='submit']").attr("disabled", true);
        }
        else {
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
                        $("select[name='enrollment_type']").val('').trigger("change");
                        $("#dis_content").html('<p class="text-success">You are already enrolled for this class.</p>');
                    }
                }
            });
        }
        //

    }

    /*function enrollment_decision()
    {
        var class_size = ($("p.class_size").text()).split('/').map(Number);
        if(class_size[0]==class_size[1])
        {
            $("select[name='enrollment_type']").val('').trigger("change");
            $("#dis_content").html('<p class="text-danger">Class is enrolled fully. Please select another class to proceed.</p>');
            $("button[type='submit']").attr("disabled", true);
        }
        else {
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
                        $("select[name='enrollment_type']").val('').trigger("change");
                        $("#dis_content").html('<p class="text-success">You are already enrolled for this class.</p>');
                    }
                }
            });
        }
        //

    }*/
    
});
</script>