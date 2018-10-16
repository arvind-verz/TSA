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
function get_invoice_no()
{
    $ci = &get_instance();
    $ci->load->database();

    $query  = $ci->db->select('*')->from(DB_INVOICE)->like('invoice_no', 'INV', 'after')->order_by('id', 'DESC')->limit(1)->get();
    $result = $query->row();
    if ($result) {
        return 'INV00' . (substr($result->invoice_no, 3) + 1);
    } else {
        return 'INV001';
    }
}
function get_sms_condition($id = null)
{
    $sms_condition = ['Student absent without leave', 'Fee reminder', 'Late Fee reminder', 'Student filled a miss class request', 'Reminder one day before reservation', 'Centre wide announcements'];
    if ($id) {
        return $sms_condition[($id - 1)];
    } else {
        return $sms_condition;
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

function get_attendance_status($value = null)
{
    $value        = json_decode($value);
    $array_status = ['L', 'M', 'E', 'X', 'G', 'H'];
    if (in_array('1', $value)) {
        return $array_status[array_search(1, $value)];
    } else {
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
    if ($query) {
        return $query->result();
    }
}

function get_classes($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    if ($id) {
        $query = $ci->db->get_where(DB_CLASSES, ['is_archive' => 0, 'class_id' => $id]);
    } else {
        $query = $ci->db->get_where(DB_CLASSES, ['is_archive' => 0]);
    }
    if ($query) {
        return $query->result();
    }
}

function get_attendance_sheet($class_code = null)
{
    $i  = 1;
    $ci = &get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->from('student');
    $ci->db->join('class', 'student.class_id = class.id');
    $ci->db->where(['class.class_code' => $class_code, 'student.is_archive' => 0, 'student.is_active' => 1, 'student.status' => 3]);
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
foreach ($query as $result) {
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

function get_invoice_sheet($class_code = null)
{

    $ci = &get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->from(INVOICE);
    $ci->db->join(STUDENT, 'invoice.student_id = student.student_id');
    $ci->db->join(CLASSES, 'student.class_id = class.id');
    $ci->db->where('class.class_code', $class_code);
    $query  = $ci->db->get();
    $result = $query->result();
    foreach ($result as $row) {
        ?>
    <tr>
        <td><input type="checkbox" name="payment_status" value="<?php echo $row->invoice_id; ?>"></td>
        <td><?php echo isset($row->student_id) ? $row->student_id : '-'; ?></td>
        <td><?php echo isset($row->invoice_no) ? $row->invoice_no : '-'; ?></td>
        <td><?php echo isset($row->invoice_date) ? date("d/m/Y", strtotime($row->invoice_date)) : '-'; ?></td>
        <td><a href="#">View</a><br/><a href="#">Download Invoice</a></td>
        <td><?php echo isset($row->status) ? get_invoice_status($row->invoice_id, 'status') : '-'; ?></td>
        <td><?php echo isset($row->payment_method) ? get_invoice_status($row->invoice_id, 'payment_method') : '-'; ?></td>
    </tr>
    <?php
}
}

function get_invoice_status($invoice_id, $type)
{
    $ci = &get_instance();
    $ci->load->database();
    $query = $ci->db->get_where(INVOICE, ['invoice_id'   =>  $invoice_id]);
    $result = $query->row();
    if($type=='status') {
        return get_invoice_status_db($result->status);
    }
    elseif($type=='payment_method') {
        return get_invoice_payment_method_db($result->payment_method);
    }
    else {
        return '-';
    }
}

function get_invoice_status_db($status) {
    if($status==1) {
        return "Cheque Error";
    }
    elseif($status==2) {
        return "Pending Cheque Payment";
    }
    elseif($status==3) {
        return "Paid (Cheque)";
    }
    elseif($status==4) {
        return "Paid (Cash)";
    }
    elseif($status==5) {
        return "Overdue";
    }
    else {
        return '-';
    }
}

function get_invoice_payment_method_db($payment_method) {
    if($payment_method==1) {
        return "Cash";
    }
    elseif($payment_method==2) {
        return "Cheque";
    }
    else {
        return "-";
    }
}

function get_weekdays_of_month($month = null, $day = null)
{
    $counter_list = ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth'];
    $storage      = [];
    $match1       = date('m', strtotime($month));
    for ($i = 0; $i < count($counter_list); $i++) {
        $dates  = date('Y-m-d', strtotime($counter_list[$i] . ' ' . $day . ' of ' . $month));
        $match2 = date('m', strtotime($dates));
        if ($match1 == $match2) {
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
        $query = $ci->db->get_where(DB_SUBJECT, ['is_archive' => 0, 'subject_id' => $id]);
    } else {
        $query = $ci->db->get_where(DB_SUBJECT, ['is_archive' => 0]);
    }
    if ($query) {
        return $query->result();
    }
}

function get_subject_classes($id = null)
{
    $ids     = json_decode($id);
    $storage = [];
    $ci      = &get_instance();
    $ci->load->database();
    if (isset($ids)) {
        foreach ($ids as $id) {
            $query  = $ci->db->get_where(DB_SUBJECT, ['id' => $id]);
            $result = $query->row();
            if ($result) {
                $storage[] = $result->subject_name;
            }
        }
        $storage = implode(", ", $storage);
        return $storage;
    }
}

function get_order_student($id = null)
{
    $storage = [];
    $ci      = &get_instance();
    $ci->load->database();
    $query  = $ci->db->get_where('order_details', ['order_id' => $id]);
    $result = $query->result();
    if ($result) {
        foreach ($result as $value) {
            $query     = $ci->db->get_where(DB_STUDENT, ['id' => $value->student_id]);
            $result    = $query->row();
            $storage[] = $result->name;
        }
        $storage = implode(", ", $storage);
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
    $ci->db->where(['order_details.order_id' => $id, 'student.is_archive' => 0, 'student.is_active' => 1, 'student.status' => 3]);
    $query  = $ci->db->get();
    $result = $query->result();
    if ($result) {
        foreach ($result as $value) {
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
        $query = $ci->db->get_where(DB_STUDENT, ['is_archive' => 0, 'id' => $id]);
    } else {
        $query = $ci->db->get_where(DB_STUDENT, ['is_archive' => 0]);
    }
    if ($query) {
        return $query->result();
    }
}

function get_student_by_student_id($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    $query  = $ci->db->get_where(DB_STUDENT, ['is_archive' => 0, 'student_id' => $id]);
    $result = $query->row();
    if ($result) {
        return $result->name;
    } else {
        return '-';
    }
}

function get_book($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    if ($id) {
        $query = $ci->db->get_where(DB_MATERIAL, ['is_archive' => 0, 'id' => $id]);
    } else {
        $query = $ci->db->get_where(DB_MATERIAL, ['is_archive' => 0]);
    }
    if ($query) {
        return $query->result();
    }
}

function get_order($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->from(DB_ORDER . 's');
    $ci->db->join('order_details', 'orders.order_id = order_details.order_id');
    $ci->db->group_by('orders.order_id');
    $query = $ci->db->get();
    if ($query) {
        return $query->result();
    }
}

function get_class_code_transfer($class_code)
{
    $ci = &get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->from(DB_CLASSES);
    $ci->db->where(['is_archive' => 0, 'class_code !=' => $class_code]);
    $query = $ci->db->get();
    if ($query) {
        $result = $query->result();
        ?>
        <option value="">-- Select One --</option>
        <?php
foreach ($result as $row) {
            ?>
        <option value="<?php echo $row->class_code ?>"><?php echo $row->class_code ?></option>
        <?php
}
    }
}

function get_sms_template($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    if ($id) {
        $query  = $ci->db->get_where('sms_template', ['id' => $id]);
        $result = $query->row();
    } else {
        $query  = $ci->db->get('sms_template');
        $result = $query->result();
    }
    if ($query) {
        return $result;
    }
}

function get_billing($id = null)
{
    $ci = &get_instance();
    $ci->load->database();
    if ($id) {
        $query  = $ci->db->get_where(DB_BILLING, ['id' => $id]);
        $result = $query->row();
    } else {
        $query  = $ci->db->get(DB_BILLING);
        $result = $query->result();
    }
    if ($query) {
        return $result;
    }
}

function send_first_month_invoice($student_id)
{

    $ci = &get_instance();
    $ci->load->database();

    $invoice_id = uniqid();
    $date       = date('Y-m-d H:i:s');

    $result2 = get_invoice_result2($student_id);
    /*echo $ci->db->last_query();
    echo '<br/>';*/

    if (!$result2) {
        return false;
    }

    $result3 = get_invoice_result2($result2->sid);

    $emailto        = $result2->email;
    $fees           = $result2->monthly_fees;
    $extra_charges  = $result2->ex_charges;
    $credit_value   = $result2->credit_value;
    $book_charges   = $result3->book_price_amount;
    $invoice_amount = 0;

    $query           = "select * from " . DB_BILLING . " where MONTH(invoice_generation_date) = MONTH(CURRENT_DATE()) and YEAR(invoice_generation_date) = YEAR(CURRENT_DATE())";
    $query           = $ci->db->query($query);
    $result          = $query->row();
    $billing_data    = json_decode($result->billing);
    $counter         = count($billing_data);
    $i               = 0;
    $subject         = '';
    $message         = '';
    $invoice_content = [
        'subject' => $subject,
        'message' => $message,
    ];

    if (date("Y-m-d", strtotime($result->invoice_generation_date)) != date('Y-m-d')) {
        return false;
    }

    foreach ($billing_data as $billing) {
        $dates = explode("-", $billing->date_range);
        if (strtotime($result2->attendance_date) >= strtotime($dates[0]) && strtotime($result2->attendance_date) <= strtotime($dates[1])) {
            $invoice_amount = (((($counter - $i) * $fees) / 4) + $book_charges + $extra_charges - $credit_value);
            $data           = [
                'invoice_id'     => $invoice_id,
                'student_id'     => $student_id,
                'invoice_date'   => $date,
                'invoice_amount' => $invoice_amount,
                'created_at'     => $date,
                'updated_at'     => $date,
            ];
            $query = $ci->db->insert(DB_INVOICE, $data);
            if ($query) {
                $mail = invoice_mail($emailto, $invoice_id, $date, $invoice_amount, $type = null, $subject, $message);
                if ($mail == true) {
                    //die(print_r($query));
                }
            }
        }
        $i++;
    }

}

function send_archived_invoice($student_id)
{
    $ci = &get_instance();
    $ci->load->database();

    $invoice_id = uniqid();
    $date       = date('Y-m-d H:i:s');

    $result2 = get_invoice_result2($student_id);
    //die(print_r($result2));

    if (!$result2) {
        return false;
    }

    $result3 = get_invoice_result3($result2->sid);

    $emailto         = $result2->email;
    $fees            = $result2->monthly_fees;
    $extra_charges   = $result2->ex_charges;
    $deposit         = $result2->deposit;
    $credit_value    = $result2->credit_value;
    $frequency       = $result2->frequency;
    $book_charges    = $result3->book_price_amount;
    $invoice_amount  = 0;
    $subject         = '';
    $message         = '';
    $invoice_content = [
        'subject' => $subject,
        'message' => $message,
    ];

    $invoice_amount = (((4 / $frequency) * $fees) + $book_charges + $extra_charges - $deposit - $credit_value);

    $data = [
        'invoice_id'      => $invoice_id,
        'student_id'      => $student_id,
        'invoice_date'    => $date,
        'invoice_amount'  => $invoice_amount,
        'invoice_content' => json_encode($invoice_content),
        'created_at'      => $date,
        'updated_at'      => $date,
    ];
    $query = $ci->db->insert(DB_INVOICE, $data);
    if ($query) {
        $mail = invoice_mail($emailto, $invoice_id, $date, $invoice_amount, $type = null, $subject, $message);
        if ($mail == true) {
            //die(print_r($query));
            return true;
        }
    }
}

function send_final_settlement_invoice($student_id)
{
    $ci = &get_instance();
    $ci->load->database();

    $invoice_id = uniqid();
    $date       = date('Y-m-d H:i:s');

    $result2 = get_invoice_result2($student_id);
    //die(print_r($result2));

    if (!$result2) {
        return false;
    }

    $result3 = get_invoice_result3($result2->sid);

    $emailto         = $result2->email;
    $fees            = $result2->monthly_fees;
    $extra_charges   = $result2->ex_charges;
    $deposit         = $result2->deposit;
    $credit_value    = $result2->credit_value;
    $frequency       = $result2->frequency;
    $book_charges    = $result3->book_price_amount;
    $invoice_amount  = 0;
    $subject         = '';
    $message         = '';
    $invoice_content = [
        'subject' => $subject,
        'message' => $message,
    ];

    $invoice_amount = (((4 / $frequency) * $fees) + $book_charges + $extra_charges - $deposit - $credit_value);

    $data = [
        'invoice_id'      => $invoice_id,
        'student_id'      => $student_id,
        'invoice_date'    => $date,
        'invoice_amount'  => $invoice_amount,
        'invoice_content' => json_encode($invoice_content),
        'created_at'      => $date,
        'updated_at'      => $date,
    ];
    $query = $ci->db->insert(DB_INVOICE, $data);
    if ($query) {
        $mail = invoice_mail($emailto, $invoice_id, $date, $invoice_amount, $type = null, $subject, $message);
        if ($mail == true) {
            //die(print_r($query));
            return true;
        }
    }
}

function send_class_transfer_invoice($student_id)
{
    $ci = &get_instance();
    $ci->load->database();

    $invoice_id = uniqid();
    $date       = date('Y-m-d H:i:s');

    $result2 = get_invoice_result2($student_id);
    //die(print_r($result2));

    if (!$result2) {
        return false;
    }

    $result3 = get_invoice_result3($result2->sid);

    $emailto         = $result2->email;
    $fees            = $result2->monthly_fees;
    $extra_charges   = $result2->ex_charges;
    $deposit         = $result2->deposit;
    $credit_value    = $result2->credit_value;
    $frequency       = $result2->frequency;
    $book_charges    = $result3->book_price_amount;
    $invoice_amount  = 0;
    $subject         = '';
    $message         = '';
    $invoice_content = [
        'subject' => $subject,
        'message' => $message,
    ];

    $invoice_amount = (((4 / $frequency) * $fees) + $book_charges + $extra_charges - $deposit - $credit_value);

    $data = [
        'invoice_id'      => $invoice_id,
        'invoice_no'      => get_invoice_no(),
        'student_id'      => $student_id,
        'invoice_date'    => $date,
        'invoice_amount'  => $invoice_amount,
        'invoice_content' => json_encode($invoice_content),
        'created_at'      => $date,
        'updated_at'      => $date,
    ];
    $query = $ci->db->insert(DB_INVOICE, $data);
    if ($query) {
        $mail = invoice_mail($emailto, $invoice_id, $date, $invoice_amount, $type = null, $subject, $message);
        if ($mail == true) {
            //die(print_r($query));
            return true;
        }
    }
}

/* RESULT FOR INVOICE */
function get_invoice_result2($student_id)
{
    $ci = &get_instance();
    $ci->load->database();

    $ci->db->select('*, student.id as sid');
    $ci->db->from(DB_ATTENDANCE);
    $ci->db->join(DB_CLASSES, 'attendance.class_code = class.class_code');
    $ci->db->join('student_enrollment', 'attendance.student_id = student_enrollment.student_id');
    $ci->db->join(DB_STUDENT, 'student.student_id = attendance.student_id');
    $ci->db->where('attendance.student_id', $student_id);
    $ci->db->order_by('attendance.attendance_date', 'DESC');
    $ci->db->limit(1);
    $query2 = $ci->db->get();
    return $query2->row();
}

function get_invoice_result3($sid)
{
    $ci = &get_instance();
    $ci->load->database();

    $ci->db->select('*, SUM(book_price) as book_price_amount');
    $ci->db->from(DB_ORDER . 's');
    $ci->db->join('order_details', 'orders.order_id = order_details.order_id');
    $ci->db->join(DB_MATERIAL, 'orders.book_id = material.id');
    $ci->db->where('order_details.student_id', $sid);
    $ci->db->where('order_details.status', 1);
    $ci->db->where('MONTH(orders.order_date) = MONTH(CURRENT_DATE())');
    $query3 = $ci->db->get();
    return $query3->row();
}
/* END RESULT FOR INVOICE */

function invoice_mail($emailto, $invoice_id, $invoice_date, $invoice_amount, $type, $subject, $message)
{
    $ci = &get_instance();
    $ci->load->library('email');

    $config['protocol'] = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_user']    = 'purohitarvind777@gmail.com';
    $config['smtp_pass']    = '@tif@sl@m';
    $config['mailpath'] = '/usr/sbin/sendmail';
    $config['charset']  = 'iso-8859-1';
    $config['wordwrap'] = true;
    $config['mailtype'] = 'html';

    $ci->email->initialize($config);
    $ci->email->from('purohitarvind777@gmail.com', 'The Science Academy');
    $ci->email->to('arvind.verz@gmail.com');

    $ci->email->subject('Email Test');
    $ci->email->message('Testing the email class.');

    $ci->email->send();
    echo $ci->email->print_debugger();
    /*$to = "arvind.verz@gmail.com";
    $subject = "My subject";
    $txt = "Hello world!";
    $headers = "From: purohitarvind77@gmail.com";

    mail($to,$subject,$txt,$headers);*/
    return true;
}