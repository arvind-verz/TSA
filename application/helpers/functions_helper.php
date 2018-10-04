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
    if ($value == 1) {
        return "S1";
    } elseif ($value == 2) {
        return "S2";
    } elseif ($value == 3) {
        return "S3";
    } elseif ($value == 4) {
        return "S4";
    } elseif ($value == 5) {
        return "J1";
    } elseif ($value == 6) {
        return "J2";
    } else {
        return "-";
    }
}

function get_attendance_status($value = null) {
    $value = json_decode($value);
    $array_status = ['L', 'M', 'E', 'X', 'G', 'H'];
    if(in_array('1', $value)) {
        return $array_status[array_search(1, $value)];
    }
    else {
        return 'H';
    }
}

function order_status($value = null)
{
    if ($value == 0) {
        return "Print";
    } elseif ($value == 1) {
        return "Given";
    } elseif ($value == 2) {
        return "Cancel";
    } else {
        return "-";
    }
}

function get_archived($module = null)
{
    $ci = &get_instance();
    $ci->load->database();
    $query = $ci->db->get_where($module, ['is_archive' => 1]);
    if($query) {
        return $query->result();
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
    if($query) {
        return $query->result();
    }
}

function get_attendance_sheet($class_code = null)
{
    $i = 1;
    $ci = &get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->from('student');
    $ci->db->join('class', 'student.class_id = class.id');
    $ci->db->where(['class.class_code' => $class_code]);
    $query = $ci->db->get();
    $query = $query->result();
    ?>
<tr>
    <td></td>
	<td></td>
	<td></td>
	<td>
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="L" readonly>
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="M" readonly>
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="E" readonly>
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="X" readonly>
		<input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="G" readonly>
	</td>
	<td></td>
</tr>
<?php
foreach($query as $result) {
?>
<tr>
    <td><input type="checkbox" name="student_id_transfer" value="<?php echo $result->student_id; ?>"></td>
	<td><?php echo $result->student_id; ?></td>
	<td><?php echo $result->name; ?></td>
	<td>
        <input type="hidden" name="student_id[]" class="form-control" value="<?php echo $result->student_id; ?>">
		<input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="L">
		<input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="M">
		<input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="E">
		<input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="X">
		<input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="G">
	</td>
	<td><input type="text" name="attendance_remark[]" class="form-control" value="" placeholder="Remark"></td>
</tr>
<?php
$i++;}
}

function get_weekdays_of_month($month = null, $day = null) {
    $counter_list = ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth'];
    $storage = [];
    $match1 = date('m', strtotime($month));
    for($i=0;$i<count($counter_list);$i++) {
        $dates = date('Y-m-d', strtotime($counter_list[$i] . ' ' . $day . ' of ' . $month));
        $match2 = date('m', strtotime($dates));
        if($match1==$match2) {
            $storage[] = $dates;
        }
    }
    return $storage;
}

function get_subject($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    if ($id) {
        $query = $ci->db->get_where(SUBJECT, ['is_archive' => 0, 'subject_id' => $id]);
    } else {
        $query = $ci->db->get_where(SUBJECT, ['is_archive' => 0]);
    }
    if($query) {
        return $query->result();
    }
}

function get_subject_classes($id = null)
{
    $ids = json_decode($id);
    $storage = [];
    $ci = &get_instance();
    $ci->load->database();
    if(isset($ids)) {
        foreach($ids as $id) {
            $query = $ci->db->get_where(SUBJECT, ['id' => $id]);
            $result = $query->row();
            if($result) {
                $storage[] = $result->subject_name;
            }
        }
        $storage = implode(", " ,$storage);
        return $storage;
    }
}

function get_order_student($id = null)
{
    $storage = [];
    $ci = &get_instance();
    $ci->load->database();
    $query = $ci->db->get_where('order_details', ['order_id' => $id]);
    $result = $query->result();
    if($result) {
        foreach($result as $value) {
            $query = $ci->db->get_where(STUDENT, ['id' => $value->student_id]);
            $result = $query->row();
            $storage[] = $result->name;
        }
        $storage = implode(", " ,$storage);
        return $storage;
    }
}

function get_order_student_content($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    $ci->db->select('*, student.id as stud_id');
    $ci->db->from('student');
    $ci->db->join('order_details', 'student.id = order_details.student_id');
    $ci->db->where(['order_details.order_id' => $id]);
    $query = $ci->db->get();
    $result = $query->result();
    if($result) {
        foreach($result as $value) {
            ?>
            <option value="<?php echo $value->stud_id; ?>"><?php echo $value->name; ?></option>
            <?php
        }
    }
}

function get_student($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    if ($id) {
        $query = $ci->db->get_where(STUDENT, ['is_archive' => 0, 'id' => $id]);
    } else {
        $query = $ci->db->get_where(STUDENT, ['is_archive' => 0]);
    }
    if($query) {
        return $query->result();
    }
}

function get_student_by_student_id($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    $query = $ci->db->get_where(STUDENT, ['is_archive' => 0, 'student_id' => $id]);
    if($query) {
        $result = $query->row();
        return $result->name;
    }
}

function get_book($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    if ($id) {
        $query = $ci->db->get_where(MATERIAL, ['is_archive' => 0, 'id' => $id]);
    } else {
        $query = $ci->db->get_where(MATERIAL, ['is_archive' => 0]);
    }
    if($query) {
        return $query->result();
    }
}

function get_order($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->from(ORDER . 's');
    $ci->db->join('order_details', 'orders.order_id = order_details.order_id');
    $ci->db->group_by('orders.order_id');
    $query = $ci->db->get();
    if($query) {
        return $query->result();
    }
}

function get_class_code_transfer($class_code) {
    $ci = &get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->from(CLASSES);
    $ci->db->where(['is_archive' => 0, 'class_code !=' => $class_code]);
    $query = $ci->db->get();
    if($query) {
        $result = $query->result();
        ?>
        <option value="">-- Select One --</option>
        <?php
        foreach($result as $row) {
        ?>
        <option value="<?php echo $row->class_code ?>"><?php echo $row->class_code ?></option>
        <?php
        }
    }
}