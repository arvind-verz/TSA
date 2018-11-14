<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
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
                        <a class="btn btn-info" href="<?php echo site_url('admin/students/archived') ?>">
                            <i aria-hidden="true" class="fa fa-archive">
                            </i> <?php echo ARCHIVED . ' ' . STUDENT ?>
                        </a>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        NRIC
                                    </th>
                                    <th>
                                        Enrolled <br />classes
                                    </th>
                                    <th>
                                        Phone <br />Number
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(count($students)) {
                                foreach($students as $student) {
                                ?>
                                <tr>
                                    <td><?php echo $student->name;?></td>
                                    <td><?php echo $student->email;?></td>
                                    <td><?php echo isset($student->nric) ? $student->nric : '-' ?></td>
                                    <td><?php print_r(get_enrolled_classes($student->student_id));?></td>
                                    <td><?php echo isset($student->phone) ? $student->phone : '-' ?></td>
                                        <div class="form-group">
                                            <select name="action" id="action" class="form-control select2 action">
                                                <option value="">-- Select One --</option>
                                                <option value="<?php echo base_url();?>index.php/admin/students/edit/<?php echo $student->student_id;?>">Edit</option>
                                                <option name="Archive" value="<?php echo base_url();?>index.php/admin/students/archive/<?php echo $student->student_id;?>">Archive</option>
                                                <!-- <option value="Final Settlement">Final Settlement</option>
                                                <option value="<?php echo base_url();?>index.php/admin/students/?sid=<?php echo $student->student_id;?>">View all details</option> -->
                                            </select>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td>
                                        <a onClick="return confirm('Are you sure want to move to active list?');" href="<?php echo base_url();?>index.php/admin/students/moveto_active_list/<?php echo $student->student_id;?>">Move to Active List</a>
                                    </td>
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
            <?php echo form_open('admin/students/enroll'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Class Code: </label>
                    <select name="class_code" class="form-control select2">
                        <option value="0">-- Select One --</option>
                        <?php
                        if (count($classes)) {
                        foreach ($classes as $class) {
                        ?>
                        <option value="<?php echo $class->class_id; ?>">
                            <?php echo $class->class_code; ?>
                        </option>
                        <?php
                        }}
                        ?>
                    </select>
                </div>
                <div id="dis_content"></div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="student_code" id="student_code" value="" />
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

function reset_modal_fields() {
$("select[name='class_code']").parents("div.modal-body").find('div').not('div:first, div:last').remove();
$("select[name='class_code']").val('');
}
$('#select_all').on('click',function(){
reset_modal_fields();
if(this.checked){
$('.checkbox').each(function(){
this.checked = true;
});
}else{
$('.checkbox').each(function(){
this.checked = false;
});
}
});

$('.checkbox').on('click',function(){
reset_modal_fields();
if($('.checkbox:checked').length == $('.checkbox').length){
$('#select_all').prop('checked',true);
}else{
$('#select_all').prop('checked',false);
}
});
$("body").on('change', "#student_status", function(){
var reservation = enrollment = "";

reservation ='<div class="form-group"><label for="">Select Reservation Date</label><input type="text" name="reservation_date" class="form-control datepicker" value="" autocomplete="off"></div>';
enrollment = '<div class="form-group"><label for="">Select Enrollment Date</label><input type="text" name="enrollment_date" class="form-control datepicker" value="" required="required" autocomplete="off"></div><div class="form-group"><label for="">Deposit</label><input type="text" name="deposit" class="form-control" value="" required="required"></div><div class="form-group"><div class="row"><div class="col-sm-1"><label for="">Deposit Collected</label></div><div class="col-sm-2"><label class="radio-inline"><input name="depo_collected"  value="1" type="radio" />Yes</label></div><div class="col-sm-2"><label class="radio-inline"><input name="depo_collected" value="0" type="radio" />No</label</div></div></div><div class="form-group"><label for="">Remarks Deposit</label><input required="required" type="text" name="remarks_deposit" class="form-control" value=""></div><div class="form-group"><label for="">Select Reservation Date</label><input required="required" type="text" name="reservation_date" class="form-control datepicker" value=""  autocomplete="off"></div><div class="form-group"><label for="">Credit Value</label><input required="required" type="text" name="credit_value" class="form-control" value=""></div><div class="form-group"><label for="">Enter Extra Charges(if any)</label><input type="text" name="ex_charges" required="required" class="form-control" value=""></div><div class="form-group"><label for="">Remarks</label><input  required="required" type="text" name="remarks" class="form-control" value=""></div>';


if($(this).val()==1)
{
$("#dis_content").html(enrollment);

}
else if($(this).val()==2)
{
$("#dis_content").html(reservation);

}
else
{
$("#dis_content").html('');
}

$(".datepicker").datepicker({format: 'yyyy-mm-dd'});

});
$(".add_class").click(function () {
if($('input[type=checkbox]').is(':checked') == true){
var val = [];
$(':checkbox:checked').each(function(i){
val[i] = $(this).val();
});
$("#student_code").val(val);
$("#myModal").modal();
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
else if(attrname=='View all details')
{

window.location=$(this).val();

}
else
{
window.location=$(this).val();
}
});
$("select[name='class_code']").on("change", function() {
$("#myModal").find("button[type='submit']").show();
$(this).parents("div.modal-body").find('p').remove();
var case_length = $("input[name='case[]']:checked").length;
var status_html = '<option value="2">Reserved</option> <option value="3">Waitlist</option>';
if (case_length == 1) {
var class_id = $(this).val();
var student_id = $("input[name='case[]']:checked").val();
$.ajax({
type: 'GET',
url: '<?php echo site_url('admin/students/get_student_status'); ?>',
data: 'class_id=' + class_id + '&student_id=' + student_id,
async: false,
processData: false,
contentType: false,
success: function(data) {
if (data.trim() == 1) {
status_html = '<option value="4">Final Settlement Sent</option>';
}
else if (data.trim() == 4) {
status_html = '';
$("select[name='class_code']").parents("div.form-group").after('<p class="text-danger">Class has been assigned to student.</p>');
$("#myModal").find("button[type='submit']").hide();
}
else if(data.trim() == 2) {
status_html = '<option value="1">Enrolled</option><option value="4">Final Settlement Sent</option>';
}
student_status_modify(status_html);
}
})
}
});
function student_status_modify(status_html) {
var student_status = '<div class="form-group student_status"> <label for="">Select Status</label> <select name="student_status" id="student_status" class="form-control select2"> <option value="0">-- Select One --</option> '+ status_html +' </select> </div>';

$("div.form-group.student_status").remove();
$("select[name='class_code']").parents("div.form-group").after(student_status);
$(".select2").select2();
}

});
</script>