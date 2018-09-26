<?php
defined('BASEPATH') or exit('No direct script access allowed');
function is_logged_in()
{
    $ci = &get_instance();
    $ci->load->library('session');
    if ($ci->session->has_userdata('logged_in')) {
        return redirect('admin/dashboard');
    } else {
        $ci->session->unset_userdata('logged_in');
        return redirect('admin/login');
    }
}
function level($value = null)
{
    if ($value == 0) {
        return "S1";
    } elseif ($value == 1) {
        return "S2";
    } elseif ($value == 2) {
        return "S3";
    } elseif ($value == 3) {
        return "S4";
    } elseif ($value == 4) {
        return "J1";
    } elseif ($value == 5) {
        return "J2";
    } else {
        return "-";
    }
}
function get_classes($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    if ($id) {
        $query = $ci->db->get_where(CLASSES, ['is_archive' => 0, 'class_id' => $id]);
    } else {
        $query = $ci->db->get_where(CLASSES, ['is_archive' => 0]);
    }
    return $query->result();
}
function get_archived_classes()
{
    $ci = &get_instance();
    $ci->load->database();
    $query = $ci->db->get_where(CLASSES, ['is_archive' => 1]);
    return $query->result();
}
function get_attendance_sheet($class_code = null)
{
    ?>
<tr>
	<td></td>
	<td></td>
	<td>
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="L">
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="M">
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="E">
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="X">
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="G">
	</td>
	<td></td>
</tr>
<tr>
	<td>121</td>
	<td>121</td>
	<td>
		<input type="text" name="attendance_value[]" class="form-control text-center w-50 d-inline" value="0" placeholder="L">
		<input type="text" name="attendance_value[]" class="form-control text-center w-50 d-inline" value="0" placeholder="M">
		<input type="text" name="attendance_value[]" class="form-control text-center w-50 d-inline" value="0" placeholder="E">
		<input type="text" name="attendance_value[]" class="form-control text-center w-50 d-inline" value="0" placeholder="X">
		<input type="text" name="attendance_value[]" class="form-control text-center w-50 d-inline" value="0" placeholder="G">
	</td>
	<td><input type="text" name="attendance_remark[]" class="form-control" value="" placeholder="Remark"></td>
</tr>
<?php
}