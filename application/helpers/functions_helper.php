<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_currency($currency_code = false)
{
    $currency_array = [
        'INR' => '<i class="fa fa-inr" aria-hidden="true"></i> ',
        'SGD' => 'SGD ',
    ];

    foreach ($currency_array as $key => $value) {
        if ($currency_code == $key) {
            echo $value;
        }
    }
}

function get_all_modules()
{
    return ['SUBJECT', 'TUTOR', 'CLASSES', 'ATTENDANCE', 'MATERIAL', 'ORDER', 'BILLING', 'INVOICE', 'STUDENT', 'MENU', 'CMS', 'USERS', 'REPORTING', 'SMS_TEMPLATE', 'SMS_HISTORY', 'SMS_REMINDER'];
}

function get_tutor_of_class($tutor_id)
{
    $ci = &get_instance();

    $query  = $ci->db->get_where(DB_TUTOR, ['tutor_id' => $tutor_id]);
    $result = $query->row();
    if ($result) {
        return $result->tutor_name;
    }
}

function get_user_type($user_type)
{
    $user_type_arr = ['Admin', 'User', 'Tutor'];

    return $user_type_arr[($user_type - 1)];
}

function get_enrollment_status($status)
{
    $enrollment_type_arr = ['Reserved', 'Waitlist', 'Enrolled', 'Final Settlement'];

    return $enrollment_type_arr[($status-1)];
}

function get_enrollment_type()
{
    $enrollment_type_arr = ['Reserved', 'Waitlist', 'Enroll'];

    return $enrollment_type_arr;
}

function get_enrolled_classes($student_id)
{
    $ci         = &get_instance();
    $class_code = [];
    if ($student_id) {
        $ci->db->select('*');
        $ci->db->from(DB_CLASSES);
        $ci->db->join('student_to_class', 'class.class_id = student_to_class.class_id');
        $ci->db->where(['student_to_class.student_id' => $student_id]);
        $query  = $ci->db->get();
        $result = $query->result();
        foreach ($result as $value) {
            $class_code[] = $value->class_code;
        }
        return implode(', ', $class_code);
    } else {
        return "-";
    }
}

function get_class_size($class_id)
{
    $ci         = &get_instance();
    if($class_id) {
        $class = get_classes($class_id);
        $class_size = get_students_enrolled($class_id);

        return $class_size . '/' . $class->class_size;
    }
}

function enrollment_decision($class_id, $student_id)
{
    $ci         = &get_instance();
    $query = $ci->db->get_where('student_enrollment', ['class_id'    =>  $class_id, 'student_id' =>  $student_id]);
    
    if($query->num_rows()>0) {
        return true;
    }
}

function get_enrollment_type_popup_content($type)
{
    $ci         = &get_instance();
    $classes = get_classes();
    if($classes)
    {
        ?>
        <div class="form-group">
            <label>Class Code</label>
            <select name="class_code" class="form-control select2" required="required">
                <option value="">-- Select --</option>
                <?php
                foreach($classes as $class)
                {
                    ?>
                    <option value="<?php echo $class->class_id; ?>"><?php echo $class->class_code; ?></option>
                    <?php
                }
                ?>
            </select>
            <p class="text-danger pull-right class_size"></p>
        </div>
        <?php
        if($type=='reservation')
        {
            ?>
            <div class="form-group"><label for="">Select Reservation Date</label><input type="text" name="reservation_date" class="form-control datepicker" value="" autocomplete="off"></div>
            <?php
        }
        elseif($type=='enroll')
        {
            ?>
            <div class="form-group"><label for="">Select Enrollment Date</label><input type="text" name="enrollment_date" class="form-control datepicker" value="" required="required" autocomplete="off"></div><div class="form-group"><label for="">Deposit</label><input type="text" name="deposit" class="form-control" value="" required="required"></div><div class="form-group"><div class="row"><div class="col-sm-1"><label for="">Deposit Collected</label></div><div class="col-sm-2"><label class="radio-inline"><input name="depo_collected"  value="1" type="radio" />Yes</label></div><div class="col-sm-2"><label class="radio-inline"><input name="deposit_collected" value="0" type="radio" />No</label</div></div></div><div class="form-group"><label for="">Remarks Deposit</label><input required="required" type="text" name="remarks_deposit" class="form-control" value=""></div><div class="form-group"><label for="">Credit Value</label><input required="required" type="text" name="credit_value" class="form-control" value=""></div><div class="form-group"><label for="">Enter Extra Charges(if any)</label><input type="text" name="extra_charges" required="required" class="form-control" value=""></div><div class="form-group"><label for="">Remarks</label><input  required="required" type="text" name="remarks" class="form-control" value=""></div>
            <?php
        }
    }
}

function get_student_names_with_nric()
{
    $ci = &get_instance();
    $query = $ci->db->get_where(DB_STUDENT);
    $result = $query->result();
    if($result)
    {
        return $result;
    }
}

function get_books_by_subject($subjects /*Array*/)
{
    $ci = &get_instance();
    $material_array = [];
    if($subjects)
    {
        $query = $ci->db->get(DB_MATERIAL);
        $result = $query->result();
        if($result)
        {
            foreach($result as $row)
            {
                $subject_id = json_decode($row->subject);
                foreach($subject_id as $value)
                {
                    if(in_array($value, $subjects))
                    {
                        $material_array[] = $row->id;
                    }
                }
            }
        }
    }
    if($material_array)
    {
        $query = $ci->db->where_in('id', $material_array)->get(DB_MATERIAL);
        $result = $query->result();
        if($result)
        {
            ?>
            <option value="">-- Select One --</option>
            <?php
            foreach($result as $row)
            {
            ?>
            <option value="<?php echo $row->id ?>" <?php echo set_select('book_id', $row->id); ?>><?php echo $row->material_id ?></option>
            <?php
            }
        }
    }
}

function get_book_price_range($price_from, $price_to)
{
    $ci = &get_instance();

    $query = $ci->db->get_where(DB_MATERIAL, ['book_price >='   =>  $price_from, 'book_price <='    =>  $price_to]);
    $result = $query->result();
    if($result)
    {
        foreach($result as $book) {
            ?>
            <tr>
                <td>
                    <?php echo isset($book->book_name) ? $book->book_name : '-' ?>
                </td>
                <td>
                    <?php echo isset($book->subject) ? get_subject_classes($book->subject) : '-' ?>
                </td>
                <td>
                    <?php echo isset($book->book_price) ? $book->book_price : '-' ?>
                </td>
                <td>
                    <?php echo isset($book->book_version) ? $book->book_version : '-' ?>
                </td>
                <td>
                    <a href="<?php echo site_url('admin/material/edit/' . $book->material_id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                    <a href="<?php echo site_url('admin/material/delete/' . $book->material_id) ?>" onclick="return confirm('Are you sure you want to archive this book?')" title="Archive"><i class="fa fa-archive btn btn-danger" aria-hidden="true"></i></a>
                </td>
            </tr>
            <?php
        }
    }
}

function get_logo()
{
    $ci = &get_instance();

    $query  = $ci->db->get('logo');
    $result = $query->row();
    return $result;
}

function miss_class_request($class_id, $reason, $date_of_absence)
{
    $ci      = &get_instance();
    $student = $ci->session->userdata('student_credentials');
    $query   = $ci->db->get_where(DB_STUDENT, ['id' => $student['id']]);
    $result  = $query->row();

    $query1  = $ci->db->get_where(DB_CLASSES, ['class_id' => $class_id]);
    $result1 = $query1->row();
    if ($result && $result1) {
        $class_code   = $result1->class_code;
        $student_id   = $result->student_id;
        $date_of_absence = $date_of_absence;
        $reason = $reason;
        $current_date = date('Y-m-d');

        $query2  = $ci->db->get_where(DB_ATTENDANCE, ['class_code' => $class_code, 'student_id' => $student_id, 'attendance_date' => $date_of_absence]);
        $result2 = $query2->row();
        if ($result2) {
            //$attendance_date = date("Y-m-d", strtotime($result2->attendance_date));
            if ($result2->status == '["0","1","0","0","0","0"]') {
                return "updated";
            }
            $recipients = [
                'phone'         => $result->phone,
                'parents_phone' => $result->parents_phone,
            ];

            $message = "Hello " . $result->name . ", You have request for missed class dated on " . date('Y-m-d', strtotime($result2->attendance_date));
            foreach ($recipients as $recipient) {
                send_sms($recipient, $message, 4, $result1->class_code);
            }

            $data = [
                'reason_for_absent'   =>  $reason,
                'status'        => json_encode(["0", "1", "0", "0", "0", "0"]),
                'missed_update' => date('Y-m-d H:i:s'),
            ];
            $ci->db->where(['class_code' => $class_code, 'student_id' => $student_id, 'attendance_date' => $date_of_absence]);
            $ci->db->update(DB_ATTENDANCE, $data);
            return "success";
        }
        return "pending";
    }
    return "failed";
}

function get_student_classes_search_data($searchby, $sortby, $searchfield)
{
    $ci = &get_instance();
    $searchby_array = ['classname', 'classcode', 'day', 'time', 'level', 'fees'];
    $searchby_array_value = ['class_name', 'class_code', 'class_day', 'class_time', 'level', 'monthly_fees'];
    if ($searchfield) {
        if (empty($searchby)) {
            $searchby = 'classname';
        }
        
        if (in_array($searchby, $searchby_array)) {
            $attr = array_search($searchby, $searchby_array);
            $attr = $searchby_array_value[$attr];
            $ci->db->select('*');
            $ci->db->from(DB_CLASSES);
            $ci->db->like($attr, $searchfield, 'both');
        }
        if ($searchby == 'tutor') {
            $ci->db->select('*, class.subject as subject');
            $ci->db->from(DB_CLASSES);
            $ci->db->join(DB_TUTOR, 'class.tutor_id = tutor.tutor_id');
            $ci->db->like('tutor.tutor_name', $searchfield, 'both');
        }
        if ($searchby == 'subject') {
            $query = $ci->db->query('SELECT * FROM `class` INNER join subject group BY class.id');
        }
    }
    if ($sortby) {
        if (in_array($sortby, $searchby_array)) {
            $attr = array_search($sortby, $searchby_array);
            $attr = $searchby_array_value[$attr];
            $ci->db->select('*');
            $ci->db->from(DB_CLASSES);
            $ci->db->order_by($attr, 'ASC');
        }
        if ($sortby == 'tutor') {
            $ci->db->select('*, class.subject as subject');
            $ci->db->from(DB_CLASSES);
            $ci->db->join(DB_TUTOR, 'class.tutor_id = tutor.tutor_id');
            $ci->db->order_by('tutor.tutor_name', 'asc');
        }
        if ($sortby == 'subject') {
            $query = $ci->db->query('SELECT * FROM `class` INNER join subject group BY class.id order by asc');
        }
    }
    if($searchby != 'subject' || $sortby != 'subject') {
        $query  = $ci->db->get();
    }
    $result = $query->result();

    if (count($result)) {
        foreach ($result as $class) {
            ?>
            <div class="col-md-6">
                <div class="row-inner-md">
                    <div class="class-box">
                        <div class="class-hd">
                            <?php echo isset($class->class_name) ? $class->class_name : '-'; ?>
                        </div>
                        <div class="class-info">
                            <ul>
                                <li><strong>Class Name</strong><span class="cinfo"><?php echo isset($class->class_name) ? $class->class_name : '-'; ?></span></li>
                                <li><strong>Class Code</strong><span class="cinfo"><?php echo isset($class->class_code) ? $class->class_code : '-'; ?></span></li>
                                <li><strong>Subject</strong><span class="cinfo"><?php echo get_subject_classes($class->subject); ?></span></li>
                                <li><strong>Day</strong><span class="cinfo"><?php echo isset($class->class_day) ? $class->class_day : '-'; ?></span></li>
                                <li><strong>Time</strong><span class="cinfo"><?php echo isset($class->class_time) ? $class->class_time : '-'; ?></span></li>
                                <li><strong>Level</strong><span class="cinfo"><?php echo isset($class->level) ? $class->level : '-'; ?></span></li>
                                <li><strong>Monthly Fees</strong><span class="cinfo"><?php echo isset($class->monthly_fees) ? $class->monthly_fees : '-'; ?></span></li>
                                <li><strong>Tutor Assigned</strong><span class="cinfo"><?php echo get_tutor_of_class($class->tutor_id); ?></span></li>
                                <li><strong>Materials</strong><span class="cinfo"><?php echo get_material_of_student($class->class_code, $ci->session->userdata('student_credentials')['id']); ?></span></li>
                            </ul>
                            <a href="javascript:void(0);" name="<?php echo isset($class->class_id) ? $class->class_id : ''; ?>" class="button btn-light miss_class_request">Miss Class Request</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }}
    }

    function get_student_status($class_id, $student_id)
    {
        $ci = &get_instance();

        if ($class_id && $student_id) {
            $ci->db->select('*');
            $ci->db->from(DB_STUDENT);
            $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
            $ci->db->where(['student_to_class.class_id' => $class_id, 'student.student_id' => $student_id]);
            $ci->db->order_by('student.id', 'DESC');
            $ci->db->limit(1);
            $query  = $ci->db->get();
            $result = $query->row();
            if ($result) {
                return $result->status;
            }
        }
    }

    function get_student_details($student_id = false)
    {
        $ci = &get_instance();

        if ($student_id) {
            $query  = $ci->db->get_where(DB_STUDENT, ['student_id' => $student_id]);
            $result = $query->row();
            return [
                'name'  => $result->name,
                'email' => $result->email,
                'phone' => $result->phone,
            ];
        }
    }

    function get_student_profile()
    {
        $ci = &get_instance();

        if ($ci->session->has_userdata('student_credentials')) {
            $student_id = $ci->session->userdata('student_credentials');

            $query  = $ci->db->get_where(DB_STUDENT, ['id' => $student_id['id'], 'email' => $student_id['email']]);
            $result = $query->row();
            return $result;
        }
        return false;
    }

    function get_student_invoices()
    {
        $ci = &get_instance();

        if ($ci->session->has_userdata('student_credentials')) {
            $student_id = $ci->session->userdata('student_credentials');

            $ci->db->select('*');
            $ci->db->from(DB_INVOICE);
            $ci->db->join(DB_STUDENT, DB_INVOICE . '.student_id = ' . DB_STUDENT . '.student_id');
            $ci->db->where([DB_STUDENT . '.id' => $student_id['id'], DB_STUDENT . '.email' => $student_id['email']]);
            $query  = $ci->db->get();
            $result = $query->result();
            return $result;
        }
        return false;
    }

    function get_invoice_by_filename($filename = false)
    {
        $ci = &get_instance();

        if ($filename) {
            $query  = $ci->db->get_where(DB_INVOICE, ['invoice_file' => $filename]);
            $result = $query->row();
            return $result;
        }
    }

    function get_invoice_no()
    {
        $ci = &get_instance();

        $query  = $ci->db->select('*')->from(DB_INVOICE)->like('invoice_no', 'INV', 'after')->order_by('id', 'DESC')->limit(1)->get();
        $result = $query->row();
        if ($result) {
            return 'INV00' . (substr($result->invoice_no, 3) + 1);
        } else {
            return 'INV001';
        }
    }

    function get_module_access_data($type, $module, $value, $perm_id)
    {
        $ci = &get_instance();

        $query  = $ci->db->get_where('aauth_permission_access', ['perm_id' => $perm_id, $type => $value, 'module' => $module]);
        $result = $query->row();
        if ($result) {
            return "checked";
        } elseif ($value == 1) {
            return "checked";
        }
    }
    function get_permission_data($id = false)
    {
        $ci = &get_instance();

        if ($id) {
            $query  = $ci->db->get_where('aauth_perms', ['id' => $id]);
            $result = $query->row();
        } else {
            $query  = $ci->db->get('aauth_perms');
            $result = $query->result();
        }
        return $result;
    }

    function get_permission_access_module($perm_id = false)
    {
        $ci = &get_instance();

        $modules = [];
        $query   = $ci->db->get_where('aauth_permission_access', ['perm_id' => $perm_id]);
        $result  = $query->result();
        foreach ($result as $row) {
            $modules[] = $row->module;
        }
        return implode(', ', $modules);
    }

    function get_users_data_by_id($id)
    {
        $ci = &get_instance();

        $query  = $ci->db->get_where('aauth_users', ['id' => $id]);
        $result = $query->row();
        if ($result) {
            return $result;
        }

    }

    function get_users_data($id = false)
    {
        $ci = &get_instance();

        $ci->db->select('*, aauth_users.id as aauth_users_id');
        $ci->db->from('aauth_users');
        $ci->db->join('aauth_perm_to_user', 'aauth_users.id = aauth_perm_to_user.user_id');
        $ci->db->join('aauth_perms', 'aauth_perms.id = aauth_perm_to_user.perm_id');
        if ($id) {
            $ci->db->where(['aauth_users.id' => $id]);
            $query  = $ci->db->get();
            $result = $query->row();
        } else {
            $ci->db->where(['aauth_users.deleted_at' => null]);
            $query  = $ci->db->get();
            $result = $query->result();
        }
        return $result;
    }

    function get_class_code_by_class($class_id)
    {
        $ci = &get_instance();

        $query  = $ci->db->get_where(DB_CLASSES, ['class_id' => $class_id]);
        $result = $query->row();
        if ($result) {
            return $result->class_code;
        }
    }

    function get_student_by_class_code($class_code = false)
    {
        $ci = &get_instance();

        $ci->db->select('*, student.id as student_id');
        $ci->db->from(DB_STUDENT);
        $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
        $ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
        $ci->db->where(DB_CLASSES . '.class_code', $class_code);
        $ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1]);
        $query  = $ci->db->get();
        $result = $query->result();
        if ($result) {
            ?>
            <option value="all">All Students</option>
            <?php
            foreach ($result as $row) {
                ?>
                <option value="<?php echo $row->student_id; ?>" <?php echo set_select('student[]', $row->student_id); ?>><?php echo $row->name ?></option>
                <?php
            }
        }
    }

    function get_sms_condition($id = false)
    {
        $sms_condition = ['Student absent without leave', 'Fee reminder', 'Late Fee reminder', 'Student filled a miss class request', 'Reminder one day before reservation', 'Centre wide announcements'];
        if ($id) {
            return $sms_condition[($id - 1)];
        }
        return $sms_condition;
    }

    function get_fee_reminder()
    {
        $ci = &get_instance();

        $query  = $ci->db->get(DB_SMS_REMINDER);
        $result = $query->row();
        if ($result) {
            return $result;
        }
    }

    function level($value = false)
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

    function get_class_code($student_id = false)
    {
        $ci = &get_instance();

        $ci->db->select('*');
        $ci->db->from(DB_STUDENT);
        $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
        $ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
        $ci->db->where(['student.student_id' => $student_id]);
        $query  = $ci->db->get();
        $result = $query->row();
        if ($result) {
            return [
                'class_code' => $result->class_code,
                'tutor_id'   => $result->tutor_id,
            ];
        }
    }

    function get_subject_by_subject_code($subject_code)
    {
        $ci = &get_instance();
        $subject_list = [];
        $ci->db->select('*');
        $ci->db->from('subject');
        $ci->db->where_in('subject_code', $subject_code);
        $query = $ci->db->get();
        $result = $query->result();
        if($result) {
            foreach($result as $row)
            {
                $subject_list[] = $row->subject_name;
            }
            return implode(", ", $subject_list);
        }
    }

    function get_subject_code($student_id = false)
    {
        $ci = &get_instance();

        $subject_list = [];
        $ci->db->select('*');
        $ci->db->from(DB_STUDENT);
        $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
        $ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
        $query   = $ci->db->get();
        $result  = $query->row();
        $subject = json_decode($result->subject);

        foreach ($subject as $value) {
            $query          = $ci->db->get_where(DB_SUBJECT, ['id' => $value]);
            $result         = $query->row();
            $subject_list[] = $result->subject_name;
        }
        return implode(", ", $subject_list);
    }

    function get_students_enrolled($class_id = false)
    {
        $ci = &get_instance();

        $ci->db->select('*, count(student.id) as total_students_enrolled');
        $ci->db->from(DB_STUDENT);
        $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
        $ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');

        $ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1, DB_CLASSES . '.class_id' => $class_id]);
        $query  = $ci->db->get();
        $result = $query->row();
        return $result->total_students_enrolled;
    }

    function get_attendance_status($value = false)
    {
        $value        = json_decode($value);
        $array_status = ['L', 'M', 'E', 'X', 'G', 'H'];
        if (in_array('1', $value)) {
            return $array_status[array_search(1, $value)];
        } else {
            return 'H';
        }
    }

    function order_status($value = false)
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

    function get_archived($module = false)
    {
        $ci = &get_instance();

        $query = $ci->db->get_where($module, ['is_archive' => 1]);
        if ($query) {
            return $query->result();
        }
    }

    function get_tutors()
    {
        $ci = &get_instance();

        $query = $ci->db->get(DB_TUTOR);
        if ($query) {
            return $query->result();
        }
    }

    function get_classes($id = false)
    {
        $ci = &get_instance();

        if ($id) {
            $query = $ci->db->get_where(DB_CLASSES, ['is_archive' => 0, 'class_id' => $id]);
            $result = $query->row();
        } else {
            $query = $ci->db->get_where(DB_CLASSES, ['is_archive' => 0]);
            $result = $query->result();
        }
        if ($query) {
            return $result;
        }
    }
    function check_image_valid($image)
    {
        $mime = array(
            'image/gif',
            'image/jpeg',
            'image/png',
        );
        $file_info = getimagesize($image);

        if (empty($file_info)) {
        // No Image?
            return false;
        } else {
        // An Image?
            $file_mime = $file_info['mime'];
            if (in_array($file_mime, $mime)) {
                return true;
            } else {
                return false;
            }

        }
    }

    function get_attendance_sheet($class_code = false, $attendance_date)
    {
        $i  = 1;
        $ci = &get_instance();
        $query = $ci->db->get_where(DB_ATTENDANCE, ['class_code'    =>  $class_code, 'attendance_date'  =>  $attendance_date]);
        if($query->num_rows()>0) {
            return get_attendance_edit_sheet($class_code, $attendance_date);
        }
        $ci->db->select('*');
        $ci->db->from(DB_STUDENT);
        $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
        $ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');

        $ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1, DB_CLASSES . '.class_code' => $class_code]);
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
                    <input type="hidden" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="H">
                </td>
                <td><input type="text" name="attendance_remark[]" class="form-control" value="" placeholder="Remark"></td>
            </tr>
            <?php
            $i++;}
        }

        function get_attendance_edit_sheet($class_code, $attendance_date)
        {
            $i  = 1;
            $ci = &get_instance();

            $ci->db->select('*');
            $ci->db->from(DB_STUDENT);
            $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
            $ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
            $ci->db->join(DB_ATTENDANCE, 'student.student_id = attendance.student_id');
            $ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1, DB_CLASSES . '.class_code' => $class_code, 'DATE(attendance.attendance_date)' => $attendance_date]);
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
                        <input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php echo (get_attendance_status($result->status) == 'L') ? 1 : 0; ?>" placeholder="L">
                        <input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php echo (get_attendance_status($result->status) == 'M') ? 1 : 0; ?>" placeholder="M">
                        <input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php echo (get_attendance_status($result->status) == 'E') ? 1 : 0; ?>" placeholder="E">
                        <input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php echo (get_attendance_status($result->status) == 'X') ? 1 : 0; ?>" placeholder="X">
                        <input type="text" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php echo (get_attendance_status($result->status) == 'G') ? 1 : 0; ?>" placeholder="G">
                        <input type="hidden" name="attendance_value<?php echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php echo (get_attendance_status($result->status) == 'H') ? 1 : 0; ?>" placeholder="H">
                    </td>
                    <td><input type="text" name="attendance_remark[]" class="form-control" value="<?php echo isset($result->remark) ? $result->remark : ''; ?>" placeholder="Remark">
                        <p class="text-muted">Student Reason: <strong><?php echo isset($result->reason_for_absent) ? $result->reason_for_absent : '-'; ?></strong></p></td>
                </tr>
                <?php
                $i++;}
            }

            function get_invoice_sheet($class_code = false)
            {
                $ci = &get_instance();

                $query  = $ci->db->get_where(DB_CLASSES, ['class_code' => $class_code]);
                $result = $query->row();

                $ci->db->select('*');
                $ci->db->from(DB_STUDENT);
                $ci->db->join(DB_INVOICE, 'invoice.student_id = student.student_id');
                $ci->db->where('invoice.class_id', $result->class_id);
                $query  = $ci->db->get();
                $result = $query->result();

                foreach ($result as $row) {
                    ?>
                    <tr>
                        <td><input type="checkbox" name="payment_status" value="<?php echo $row->invoice_id; ?>"></td>
                        <td><?php echo isset($row->student_id) ? $row->student_id : '-'; ?></td>
                        <td><?php echo isset($row->invoice_no) ? $row->invoice_no : '-'; ?></td>
                        <td><?php echo isset($row->invoice_date) ? date("d/m/Y", strtotime($row->invoice_date)) : '-'; ?></td>
                        <td><a href="<?php echo base_url('assets/files/pdf/invoice/' . $row->invoice_file) ?>" target="_blank">View</a><br/><a href="<?php echo base_url('assets/files/pdf/invoice/' . $row->invoice_file) ?>" target="_blank" download>Download Invoice</a></td>
                        <td><?php echo isset($row->status) ? get_invoice_status($row->invoice_id, 'status') : '-'; ?></td>
                        <td><?php echo isset($row->payment_method) ? get_invoice_status($row->invoice_id, 'payment_method') : '-'; ?></td>
                    </tr>
                    <?php
                }
            }

            function get_attendance_date_by_class_code($class_code)
            {
                $ci = &get_instance();
                $query = $ci->db->get_where(DB_CLASSES, ['class_code'   =>  $class_code]);
                $result = $query->row();
                $result = get_weekdays_of_month($result->class_month, $result->class_day);
                if(in_array(date('Y-m-d'), $result))
                {
                    return date('Y-m-d');
                }
            }

            function get_invoice_status($invoice_id, $type)
            {
                $ci = &get_instance();

                $query  = $ci->db->get_where(DB_INVOICE, ['invoice_id' => $invoice_id]);
                $result = $query->row();
                if ($type == 'status') {
                    return get_invoice_status_db($result->status);
                } elseif ($type == 'payment_method') {
                    return get_invoice_payment_method_db($result->payment_method);
                } else {
                    return '-';
                }
            }

            function get_invoice_status_db($status)
            {
                if ($status == 1) {
                    return "Cheque Error";
                } elseif ($status == 2) {
                    return "Pending Cheque Payment";
                } elseif ($status == 3) {
                    return "Paid (Cheque)";
                } elseif ($status == 4) {
                    return "Paid (Cash)";
                } elseif ($status == 5) {
                    return "Overdue";
                } else {
                    return '-';
                }
            }

            function get_invoice_payment_method_db($payment_method)
            {
                if ($payment_method == 1) {
                    return "Cash";
                } elseif ($payment_method == 2) {
                    return "Cheque";
                } else {
                    return "-";
                }
            }

            function get_weekdays_of_month($month = false, $day = false)
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

            function get_subject($id = false)
            {
                $ci = &get_instance();

                if ($id) {
                    $query = $ci->db->order_by('created_at', 'desc')->get_where(DB_SUBJECT, ['is_archive' => 0, 'subject_id' => $id]);
                } else {
                    $query = $ci->db->order_by('created_at', 'desc')->get_where(DB_SUBJECT, ['is_archive' => 0]);
                }
                if ($query) {
                    return $query->result();
                }
            }

            function get_subject_classes($id = false)
            {
                $ids     = json_decode($id);
                $storage = [];
                $ci      = &get_instance();

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

            function get_material_of_student($class_code, $student_id)
            {
                $ci      = &get_instance();

                $ci->db->select('count(*) as count_total_order');
                $ci->db->from('orders');
                $ci->db->join('order_details', 'orders.order_id = order_details.order_id');
                $ci->db->where(['orders.class_code' => $class_code, 'order_details.student_id'  =>  $student_id]);
                $query = $ci->db->get();
                $result = $query->row();

                $ci->db->select('count(*) as books_given');
                $ci->db->from('orders');
                $ci->db->join('order_details', 'orders.order_id = order_details.order_id');
                $ci->db->where(['orders.class_code' => $class_code, 'order_details.student_id'  =>  $student_id, 'order_details.status'   =>  1]);
                $query1 = $ci->db->get();
                $result1 = $query1->row();
                if($result)
                {
                    return $result1->books_given . '/' . $result->count_total_order;
                }
            }

            function get_order_student($id = false)
            {
                $storage = [];
                $ci      = &get_instance();

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

            function get_order_student_content($order_id, $class_code)
            {
                $ci = &get_instance();

                $ci->db->select('*, student.id as stud_id');
                $ci->db->from(DB_STUDENT);
                $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
                $ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
                $ci->db->join('order_details', 'student.id = order_details.student_id');
                $ci->db->where(['order_details.order_id' => $order_id, 'student.is_archive' => 0, 'student.is_active' => 1, 'student_to_class.status' => 3, 'class.class_code' => $class_code]);
                $query  = $ci->db->get();
                $result = $query->result();
                if ($result) {
                    foreach ($result as $value) {
                        ?>
                        <option value="<?php echo $value->stud_id; ?>"><?php echo $value->name . ' - ' . get_class_code_by_class($value->class_id); ?></option>
                        <?php
                    }
                }
            }

            function get_student($id = false)
            {
                $ci = &get_instance();

                if ($id) {
                    $query = $ci->db->get_where(DB_STUDENT, ['is_archive' => 0, 'is_active' => 1, 'id' => $id]);
                } else {
                    $ci->db->select('*');
                    $ci->db->from(DB_STUDENT);
                    $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
                    $ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
                    $ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1]);
                    $query = $ci->db->get();
                    //return $ci->db->last_query();
                }
                if ($query) {
                    return $query->result();
                }
            }

            function get_student_archived() {
                $ci = &get_instance();
                $ci->db->select('*');
                    $ci->db->from(DB_STUDENT);
                    $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
                    $ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 1, DB_STUDENT . '.is_active' => 1]);
                    $query = $ci->db->get();
                    if ($query) {
                    return $query->result();
                }
            }

            function get_student_archive_at($student_id)
            {
                $ci = &get_instance();
                $query = $ci->db->get_where(DB_STUDENT, ['student_id'   =>  $student_id]);
                $result = $query->row();
                return $ci->db->last_query();
                if($result) 
                {
                    return "-";
                }
            }

            function get_material_associated($student_id, $class_id) {
                /*$ci = &get_instance();

                $ci->db->select('*');
                $ci->db->from('material');
                $ci->db->join('order')*/
            }

            function has_enrollment_content($student_id, $class_id, $type) {
                $ci = &get_instance();
                $query = $ci->db->get_where('student_enrollment', ['student_id'  =>  $student_id, 'class_id' =>  $class_id]);
                $result = $query->row();
                if($result)
                {
                    if($type=='extra_charges') {
                        return !empty($result->extra_charges) ? 'Yes' : 'No';
                    }
                    else {
                        return !empty($result->deposit_collected) ? 'Yes' : 'No';
                    }
                }
            }

            function get_view_all_contents($student_id, $class_id)
            {
                $ci = &get_instance();
                $query = $ci->db->get_where('student_enrollment', ['student_id'  =>  $student_id, 'class_id' =>  $class_id]);
                $result = $query->row();
                if($result)
                {
                    ?>
                        <div class="form-group">
                            <label>Deposit : <?php echo $result->deposit; ?></label>
                        </div>
                        <div class="form-group">
                            <label>Deposit Remark : <?php echo isset($result->remarks_deposit) ? $result->remarks_deposit : '-'; ?></label>
                        </div>
                        <div class="form-group">
                            <label>Credit Value : <?php echo $result->credit_value; ?></label>
                        </div>
                        <div class="form-group">
                            <label>Extra Charges : <?php echo $result->extra_charges; ?></label>
                        </div>
                        <div class="form-group">
                            <label>Remark : <?php echo isset($result->remarks) ? $result->remarks : '-'; ?></label>
                        </div>
                    <?php 
                }
            }

            function get_student_by_student_id($id = false)
            {
                $ci = &get_instance();

                $query  = $ci->db->get_where(DB_STUDENT, ['is_archive' => 0, 'is_active' => 1, 'student_id' => $id]);
                $result = $query->row();
                if ($result) {
                    return $result->name;
                } else {
                    return '-';
                }
            }

            function get_reporting_sheet($date_from = false, $date_to = false)
            {
                $ci = &get_instance();

                $ci->db->select('*, sum(invoice_amount) as total_invoice_amount, sum(amount_excluding_material) as total_amount_excluding_material, sum(material_amount) as total_material_amount');
                $ci->db->from(DB_INVOICE);
                if ($date_from || $date_to) {
                    $ci->db->where('DATE(invoice_date) >=', $date_from);
                    $ci->db->where('DATE(invoice_date) <=', $date_to);
                }
                $ci->db->group_by('student_id');
                $query  = $ci->db->get();
                $result = $query->result();

                if ($date_from || $date_to) {
                    if (count($result)) {
                        foreach ($result as $value) {
                            $class_code = get_class_code($value->student_id);
                            ?>
                            <tr>
                                <td><?php echo $class_code['class_code']; ?></td>
                                <td><?php echo get_subject_code($value->student_id); ?></td>
                                <td><?php echo $class_code['tutor_id']; ?></td>
                                <td><?php echo get_students_enrolled($class_code['class_code']); ?></td>
                                <td><?php get_currency('INR');
                                echo isset($value->total_amount_excluding_material) ? $value->total_amount_excluding_material : '-';?></td>
                                <td><?php get_currency('INR');
                                echo isset($value->total_material_amount) ? $value->total_material_amount : '-';?></td>
                            </tr>
                            <?php
                        }}
                    } else {
                        return $result;
                    }
                }

                function get_book($id = false)
                {
                    $ci = &get_instance();

                    if ($id) {
                        $query  = $ci->db->get_where(DB_MATERIAL, ['is_archive' => 0, 'material_id' => $id]);
                        $result = $query->row();
                    } else {
                        $query  = $ci->db->get_where(DB_MATERIAL, ['is_archive' => 0]);
                        $result = $query->result();
                    }
                    if ($query) {
                        return $result;
                    }
                }

                function get_order($id = false)
                {
                    $ci = &get_instance();

                    $ci->db->select('*');
                    $ci->db->from(DB_ORDER . 's');
                    $ci->db->join('order_details', 'orders.order_id = order_details.order_id');
                    $ci->db->group_by('orders.order_id');
                    $query = $ci->db->get();
                    if ($query) {
                        return $query->result();
                    }
                }

                function get_class_code_transfer($class_code = false)
                {
                    $ci = &get_instance();

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

                function get_sms_template($id = false)
                {
                    $ci = &get_instance();

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

                function get_sms_history($id = false)
                {
                    $ci = &get_instance();

                    $ci->db->select('*');
                    $ci->db->from('sent_sms');
                    if ($id) {
                        $ci->db->where(['id' => $id]);
                        $query  = $ci->db->get();
                        $result = $query->row();
                    } else {
                        $ci->db->where(['deleted_at' => null]);
                        $ci->db->order_by('created_at', 'ASC');
                        $query  = $ci->db->get();
                        $result = $query->result();
                    }
                    if ($result) {
                        return $result;
                    }
                }

                function get_student_details_by_sms_history($recipient)
                {
                    $ci = &get_instance();

                    if ($recipient) {
                        $ci->db->select('*');
                        $ci->db->from(DB_STUDENT);
                        $ci->db->where(['phone' => $recipient]);
                        $ci->db->limit(1);
                        $query  = $ci->db->get();
                        $result = $query->row();
                        if ($result) {
                            return [
                                'student_name' => $result->name,
                                'student_id'   => $result->student_id,
                            ];
                        }
                    }
                    return false;
                }

                function get_pre_condition_template($reason)
                {
                    $ci = &get_instance();

                    $condition_array = ['Student absent without leave', 'Fee reminder', 'Late Fee reminder', 'Student filled a miss class request', 'Reminder one day before reservation', 'Centre wide announcements'];

                    $query  = $ci->db->get_where('sms_template', ['reason' => $reason]);
                    $result = $query->row();
                    if ($result) {
                        return [
                            'pre_condition' => $condition_array[($reason - 1)],
                            'template_name' => $result->template_name,
                        ];
                    }
                }

                function get_billing($id = false)
                {
                    $ci = &get_instance();

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

                function send_cron_invoice()
                {
                    $ci = &get_instance();

                    $ci->db->select('*');
                    $ci->db->from(DB_STUDENT);
                    $ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
                    $ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
                    $ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1]);
                    $query  = $ci->db->get();
                    $result = $query->result();
                    foreach ($result as $row) {
                        $ci->db->select('*, DATE(invoice_date) as invoice_date');
                        $ci->db->from(DB_INVOICE);
                        $ci->db->where(['student_id'    => $row->student_id, 'class_id'    =>  $row->class_id]);
                        $query = $ci->db->get();
                        if ($query->num_rows() > 0) {
                            send_rest_month_invoice($row->student_id, $row->class_id);
                        } else {
                            send_first_month_invoice($row->student_id, $row->class_id);
                        }
                    }

                }

                function send_first_month_invoice($student_id, $class_id)
                {
                    $ci = &get_instance();

                    $invoice_id   = uniqid();
                    $date         = date('Y-m-d H:i:s');
                    $invoice_file = uniqid() . '__invoice_pdf-' . date('Y-m-d') . '.pdf';

                    $ci->db->select('*, student.id as sid');
                    $ci->db->from(DB_CLASSES);
                    $ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
                    $ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
                    $ci->db->where(['student_enrollment.student_id'  =>  $student_id, 'student_enrollment.class_id'    =>  $class_id]);
                    $ci->db->limit(1);
                    $query1 = $ci->db->get();
                    $result1 = $query1->row();
                    if (!$result1) {
                        return false;
                    }
                    $frequency = $result1->frequency;
                    $class_code = $result1->class_code;
                    $emailto = [$result1->email, $result1->parent_email];
                    $fees = $result1->monthly_fees;
                    $extra_charges = $result1->extra_charges;
                    $deposit = $result1->deposit;
                    $credit_value = $result1->credit_value;
                    $invoice_amount = $amount_excluding_material = $credit_amount = 0;
             
   
    $result2 = get_invoice_result2($result1->sid);

    $book_charges   = isset($result2->book_price_amount) ? $result2->book_price_amount : 0;

    $invoice_data = [
        'class_code'    =>  $class_code,
        'fees_monthly'  => $fees,
        'deposit_amount'    =>  $deposit,
        'extra_charges' => $extra_charges,
        'credit_amount'  => $credit_value,
        'material_fees'  => $book_charges,
    ];

    $query = $ci->db->get_where(DB_BILLING, ['invoice_generation_date'  =>  $date]);
    $result          = $query->row();
    if(!$result) {
        return false;
    } 
    $billing_data    = json_decode($result->billing);
    $counter         = [];
    $i               = 0;
    $subject         = '';
    $message         = '';
    $invoice_content = [
        'subject' => $subject,
        'message' => $message,
    ];

    $query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' =>  $student_id, 'class_code'   =>  $result1->class_code]);
    if($query->num_rows()>0) {
        foreach ($billing_data as $billing) {
            if($billing->rest_week!=1) {
                $dates = explode("-", $billing->date_range);
                foreach($query->result() as $row) {
                    if (strtotime($row->attendance_date) >= strtotime($dates[0]) && strtotime($row->attendance_date) <= strtotime($dates[1])) {
                        $counter[] = 1;
                    }
                }
            }
        }
        $counter = count($counter);
        $invoice_amount            = (((($counter - $i) * $fees) / $frequency) + $book_charges + $extra_charges - $credit_value);
        $amount_excluding_material = (((($counter - $i) * $fees) / $frequency) + $extra_charges - $credit_value);
        $data                      = [
            'invoice_id'                => $invoice_id,
            'invoice_no'                => get_invoice_no(),
            'student_id'                => $student_id,
            'class_id'                  => $class_id,
            'invoice_date'              => $date,
            'invoice_amount'            => $invoice_amount,
            'amount_excluding_material' => $amount_excluding_material,
            'material_amount'           => $book_charges,
            'invoice_data'              => json_encode($invoice_data),
            'invoice_file'              => $invoice_file,
            'created_at'                => $date,
            'updated_at'                => $date,
        ];
        $query = $ci->db->insert(DB_INVOICE, $data);
        if ($query) {
            
            if($credit_value>0) {
                $credit_amount = ($credit_value - $invoice_amount);
                $ci->db->where('student_id', $student_id);
                $ci->db->where('class_id', $class_id);
                $ci->db->update('student_enrollment', ['credit_value'   =>  $credit_amount]);
            }
            foreach($emailto as $email) {
                $mail = send_mail($email, $invoice_id, $date, $invoice_amount, $type = null, $subject, $message);
            }
            $ci->load->library('M_pdf');
            $ci->m_pdf->download_my_mPDF($invoice_file);
            
            if ($mail == true) {
                //die(print_r($query));
            }
        }
    }

}

function send_rest_month_invoice($student_id, $class_id)
{
    $ci = &get_instance();

                    $invoice_id   = uniqid();
                    $date         = date('Y-m-d H:i:s');
                    $invoice_file = uniqid() . '__invoice_pdf-' . date('Y-m-d') . '.pdf';

                    $ci->db->select('*, student.id as sid');
                    $ci->db->from(DB_CLASSES);
                    $ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
                    $ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
                    $ci->db->where(['student_enrollment.student_id'  =>  $student_id, 'student_enrollment.class_id'    =>  $class_id]);
                    $ci->db->limit(1);
                    $query1 = $ci->db->get();
                    $result1 = $query1->row();
                    if (!$result1) {
                        return false;
                    }
                    $frequency = $result1->frequency;
                    $class_code = $result1->class_code;
                    $emailto = [$result1->email, $result1->parent_email];
                    $fees = $result1->monthly_fees;
                    $extra_charges = $result1->extra_charges;
                    $deposit = $result1->deposit;
                    $credit_value = $result1->credit_value;
                    $invoice_amount = $amount_excluding_material = $credit_amount = 0;
             
   
    $result2 = get_invoice_result2($result1->sid);

    $book_charges   = isset($result2->book_price_amount) ? $result2->book_price_amount : 0;

    $invoice_data = [
        'class_code'    =>  $class_code,
        'fees_monthly'  => $fees,
        'deposit_amount'    =>  $deposit,
        'extra_charges' => $extra_charges,
        'credit_amount'  => $credit_value,
        'material_fees'  => $book_charges,
    ];

    $query = $ci->db->get_where(DB_BILLING, ['invoice_generation_date'  =>  $date]);
    $result          = $query->row();
    if(!$result) {
        return false;
    }
    $billing_data    = json_decode($result->billing);
    $counter         = [];
    $i               = 0;
    $subject         = '';
    $message         = '';
    $invoice_content = [
        'subject' => $subject,
        'message' => $message,
    ];

    $query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' =>  $student_id, 'class_code'   =>  $result1->class_code]);
    if($query->num_rows()>0) {
        $invoice_amount            = ($fees + $book_charges + $extra_charges - $credit_value);
            $amount_excluding_material = ($fees + $extra_charges - $credit_value);
        $data                      = [
            'invoice_id'                => $invoice_id,
            'invoice_no'                => get_invoice_no(),
            'student_id'                => $student_id,
            'class_id'                  => $class_id,
            'invoice_date'              => $date,
            'invoice_amount'            => $invoice_amount,
            'amount_excluding_material' => $amount_excluding_material,
            'material_amount'           => $book_charges,
            'invoice_data'              => json_encode($invoice_data),
            'invoice_file'              => $invoice_file,
            'created_at'                => $date,
            'updated_at'                => $date,
        ];
        $query = $ci->db->insert(DB_INVOICE, $data);
        if ($query) {
            
            if($credit_value>0) {
                $credit_amount = ($credit_value - $invoice_amount);
                $ci->db->where('student_id', $student_id);
                $ci->db->where('class_id', $class_id);
                $ci->db->update('student_enrollment', ['credit_value'   =>  $credit_amount]);
            }
            foreach($emailto as $email) {
                $mail = send_mail($email, $invoice_id, $date, $invoice_amount, $type = null, $subject, $message);
            }
            $ci->load->library('M_pdf');
            $ci->m_pdf->download_my_mPDF($invoice_file);
            
            if ($mail == true) {
                //die(print_r($query));
            }
        }
    }
}

function send_archived_invoice($student_id)
{
    $ci = &get_instance();

    $invoice_id   = uniqid();
    $date         = date('Y-m-d H:i:s');
    $invoice_file = uniqid() . '__invoice_pdf-' . date('Y-m-d') . '.pdf';

    $result2 = get_invoice_result2($student_id);

    if (!$result2) {
        return false;
    }

    $result4 = get_invoice_result4($student_id);

    $L = $M = $E = $X = $G = $H = [];
    foreach ($result4 as $row) {
        $status = json_decode($row->status);
        if ($status[0] == 1) {
            $L[] = $status[0];
        }
        if ($status[1] == 1) {
            $M[] = $status[1];
        }
        if ($status[2] == 1) {
            $E[] = $status[2];
        }
        if ($status[3] == 1) {
            $X[] = $status[3];
        }
        if ($status[4] == 1) {
            $G[] = $status[4];
        }
        if ($status[5] == 1) {
            $H[] = $status[5];
        }
    }

    $result3 = get_invoice_result3($result2->sid);

    $class_code = $result2->class_code;
    $class_id       = $result2->class_id;
    $emailto        = $result2->email;
    $fees           = isset($result2->monthly_fees) ? $result2->monthly_fees : 0;
    $extra_charges  = isset($result2->ex_charges) ? $result2->ex_charges : 0;
    $deposit   = isset($result2->deposit) ? $result2->deposit : 0;
    $frequency   = isset($result2->frequency) ? $result2->frequency : 0;
    $credit_value   = isset($result2->credit_value) ? $result2->credit_value : 0;
    $book_charges   = isset($result3->book_price_amount) ? $result3->book_price_amount : 0;
    $invoice_amount = $amount_excluding_material = 0;

    $invoice_data = [
        'class_code'    =>  $class_code,
        'fees_monthly'  => $fees,
        'deposit_amount'    =>  $deposit,
        'extra_charges' => $extra_charges,
        'credit_amount'  => $credit_value,
        'material_fees'  => $book_charges,
    ];

    $subject         = '';
    $message         = '';
    $invoice_content = [
        'subject' => $subject,
        'message' => $message,
    ];

    $invoice_amount            = ((((count($L) + count($M) + abs(-count($X)) + count($E) + count($G) + count($H)) / $frequency) * $fees) + $book_charges + $extra_charges - $deposit - $credit_value);
    $amount_excluding_material = ((((count($L) + count($M) + abs(-count($X)) + count($E) + count($G) + count($H)) / $frequency) * $fees) + $extra_charges - $deposit - $credit_value);

    $data = [
        'invoice_id'                => $invoice_id,
        'invoice_no'                => get_invoice_no(),
        'student_id'                => $student_id,
        'class_id'                  => $class_id,
        'invoice_date'              => $date,
        'invoice_amount'            => $invoice_amount,
        'amount_excluding_material' => $amount_excluding_material,
        'material_amount'           => $book_charges,
        'invoice_data'              => json_encode($invoice_data),
        'invoice_file'              => $invoice_file,
        'invoice_content'           => json_encode($invoice_content),
        'created_at'                => $date,
        'updated_at'                => $date,
    ];

    $query = $ci->db->insert(DB_INVOICE, $data);
    if ($query) {
        $ci->load->library('M_pdf');
        $ci->m_pdf->download_my_mPDF($invoice_file);
        $mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type = null, $subject, $message);
        if ($mail == true) {
            //die(print_r($query));
            return true;
        }
    }
}

function send_final_settlement_invoice($student_id)
{
    $ci           = &get_instance();
    $invoice_id   = uniqid();
    $date         = date('Y-m-d H:i:s');
    $invoice_file = uniqid() . '__invoice_pdf-' . date('Y-m-d') . '.pdf';

    $result2 = get_invoice_result2($student_id);
    //die(print_r($result2));
    $result4 = get_invoice_result4($student_id);

    $L = $M = $E = $X = $G = $H = [];
    foreach ($result4 as $row) {
        $status = json_decode($row->status);
        if ($status[0] == 1) {
            $L[] = $status[0];
        }
        if ($status[1] == 1) {
            $M[] = $status[1];
        }
        if ($status[2] == 1) {
            $E[] = $status[2];
        }
        if ($status[3] == 1) {
            $X[] = $status[3];
        }
        if ($status[4] == 1) {
            $G[] = $status[4];
        }
        if ($status[5] == 1) {
            $H[] = $status[5];
        }
    }

    if (!$result2) {
        return false;
    }

    $result3 = get_invoice_result3($result2->sid);

    $class_code = $result2->class_code;
    $class_id       = $result2->class_id;
    $emailto        = $result2->email;
    $fees           = isset($result2->monthly_fees) ? $result2->monthly_fees : 0;
    $extra_charges  = isset($result2->ex_charges) ? $result2->ex_charges : 0;
    $deposit   = isset($result2->deposit) ? $result2->deposit : 0;
    $credit_value   = isset($result2->credit_value) ? $result2->credit_value : 0;
    $frequency   = isset($result2->frequency) ? $result2->frequency : 0;
    $book_charges   = isset($result3->book_price_amount) ? $result3->book_price_amount : 0;
    $invoice_amount = $amount_excluding_material = 0;

    $invoice_data = [
        'class_code'    =>  $class_code,
        'fees_monthly'  => $fees,
        'deposit_amount'    =>  $deposit,
        'extra_charges' => $extra_charges,
        'credit_amount'  => $credit_value,
        'material_fees'  => $book_charges,
    ];

    $subject         = '';
    $message         = '';
    $invoice_content = [
        'subject' => $subject,
        'message' => $message,
    ];

    $invoice_amount            = ((((count($L) + count($M) + abs(-count($X)) + count($E) + count($G) + count($H)) / $frequency) * $fees) + $book_charges + $extra_charges - $deposit - $credit_value);
    $amount_excluding_material = ((((count($L) + count($M) + abs(-count($X)) + count($E) + count($G) + count($H)) / $frequency) * $fees) + $extra_charges - $deposit - $credit_value);

    $data = [
        'invoice_id'                => $invoice_id,
        'invoice_no'                => get_invoice_no(),
        'student_id'                => $student_id,
        'class_id'                  => $class_id,
        'invoice_date'              => $date,
        'invoice_amount'            => $invoice_amount,
        'amount_excluding_material' => $amount_excluding_material,
        'material_amount'           => $book_charges,
        'invoice_data'              => json_encode($invoice_data),
        'invoice_file'              => $invoice_file,
        'invoice_content'           => json_encode($invoice_content),
        'created_at'                => $date,
        'updated_at'                => $date,
    ];
    $query = $ci->db->insert(DB_INVOICE, $data);

    if ($query) {
        $ci->load->library('M_pdf');
        $ci->m_pdf->download_my_mPDF($invoice_file);
        $mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type = null, $subject, $message);
        if ($mail == true) {
            //die(print_r($query));
            return true;
        }
    }
}

function send_class_transfer_invoice($student_id)
{
    $ci = &get_instance();

    $invoice_id   = uniqid();
    $date         = date('Y-m-d H:i:s');
    $invoice_file = uniqid() . '__invoice_pdf-' . date('Y-m-d') . '.pdf';

    $result2 = get_invoice_result2($student_id);
    //die(print_r($result2));
    $result4 = get_invoice_result4($student_id);

    $L = $M = $E = $X = $G = $H = [];
    foreach ($result4 as $row) {
        $status = json_decode($row->status);
        if ($status[0] == 1) {
            $L[] = $status[0];
        }
        if ($status[1] == 1) {
            $M[] = $status[1];
        }
        if ($status[2] == 1) {
            $E[] = $status[2];
        }
        if ($status[3] == 1) {
            $X[] = $status[3];
        }
        if ($status[4] == 1) {
            $G[] = $status[4];
        }
        if ($status[5] == 1) {
            $H[] = $status[5];
        }
    }

    if (!$result2) {
        return false;
    }

    $result3 = get_invoice_result3($result2->sid);

    $class_code = $result2->class_code;
    $class_id       = $result2->class_id;
    $emailto        = $result2->email;
    $fees           = isset($result2->monthly_fees) ? $result2->monthly_fees : 0;
    $extra_charges  = isset($result2->ex_charges) ? $result2->ex_charges : 0;
    $deposit   = isset($result2->deposit) ? $result2->deposit : 0;
    $frequency   = isset($result2->frequency) ? $result2->frequency : 0;
    $credit_value   = isset($result2->credit_value) ? $result2->credit_value : 0;
    $book_charges   = isset($result3->book_price_amount) ? $result3->book_price_amount : 0;

    $invoice_amount = $amount_excluding_material = 0;

    $invoice_data = [
        'class_code'    =>  $class_code,
        'fees_monthly'  => $fees,
        'deposit_amount'    =>  $deposit,
        'extra_charges' => $extra_charges,
        'credit_amount'  => $credit_value,
        'material_fees'  => $book_charges,
    ];

    $subject         = '';
    $message         = '';
    $invoice_content = [
        'subject' => $subject,
        'message' => $message,
    ];

    $invoice_amount            = ((((count($L) + count($M) + abs(-count($X)) + count($E) + count($G) + count($H)) / $frequency) * $fees) + $book_charges + $extra_charges - $deposit - $credit_value);
    $amount_excluding_material = ((((count($L) + count($M) + abs(-count($X)) + count($E) + count($G) + count($H)) / $frequency) * $fees) + $extra_charges - $deposit - $credit_value);

    $data = [
        'invoice_id'                => $invoice_id,
        'invoice_no'                => get_invoice_no(),
        'student_id'                => $student_id,
        'class_id'                  => $class_id,
        'invoice_date'              => $date,
        'invoice_amount'            => $invoice_amount,
        'amount_excluding_material' => $amount_excluding_material,
        'material_amount'           => $book_charges,
        'invoice_data'              => json_encode($invoice_data),
        'invoice_file'              => $invoice_file,
        'invoice_content'           => json_encode($invoice_content),
        'created_at'                => $date,
        'updated_at'                => $date,
    ];
    $query = $ci->db->insert(DB_INVOICE, $data);
    if ($query) {
        $ci->load->library('M_pdf');
        $ci->m_pdf->download_my_mPDF($invoice_file);
        $mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type = null, $subject, $message);
        if ($mail == true) {
            //die(print_r($query));
            return true;
        }
    }
}

/* RESULT FOR INVOICE */
function get_invoice_result4($student_id)
{
    $ci = &get_instance();

    $ci->db->select('*');
    $ci->db->from(DB_ATTENDANCE);
    $ci->db->where('attendance.student_id', $student_id);
    $ci->db->where('MONTH(attendance.attendance_date) = MONTH(CURRENT_DATE())');
    $ci->db->where('YEAR(attendance.attendance_date) = YEAR(CURRENT_DATE())');
    $query = $ci->db->get();
    return $query->result();
}

function get_invoice_result2($sid)
{
    $ci = &get_instance();

    $ci->db->select('*, SUM(book_price) as book_price_amount');
    $ci->db->from(DB_ORDER . 's');
    $ci->db->join('order_details', 'orders.order_id = order_details.order_id');
    $ci->db->join(DB_MATERIAL, 'orders.book_id = material.id');
    $ci->db->where('order_details.student_id', $sid);
    $ci->db->where('order_details.status', 1);
    $ci->db->where('MONTH(orders.order_date) = MONTH(CURRENT_DATE())');
    $query = $ci->db->get();
    return $query->row();
}

/* END RESULT FOR INVOICE */

function fee_reminder()
{
    $ci = &get_instance();

    $query  = $ci->db->get('sms_reminder');
    $result = $query->result();
    if ($result) {
        $fee_reminder = date('Y-m-d', strtotime($result->fee_reminder));
        $today_date   = date('Y-m-d');

        if ($fee_reminder->$today_date) {
            $query1  = $ci->db->get(DB_INVOICE);
            $result1 = $query1->result();
            if ($result) {
                foreach ($result as $row) {
                    if (empty($row->status) || $row->status == 1 || $row->status == 2) {
                        $student_details = get_student($row->student_id);
                        $recipients      = [
                            'phone'         => $student_details->phone,
                            'parents_phone' => $student_details->parents_phone,
                        ];
                        $message    = "Dear " . $student_details->name . ', Your Invoice #' . $row->invoice_no . ' payment of amount $' . $row->invoice_amount . ' is pending. Pay at the counter.';
                        $class_code = get_class_code_by_class($row->class_id);
                        foreach ($recipients as $recipient) {
                            send_sms($recipient, $message, 2, $class_code);
                        }
                    }
                }
            }
        }
    }
}

function late_fee_reminder()
{
    $ci = &get_instance();

    $query  = $ci->db->get('sms_reminder');
    $result = $query->result();
    if ($result) {
        $late_fee_reminder = date('Y-m-d', strtotime($result->late_fee_reminder));
        $today_date        = date('Y-m-d');

        if ($late_fee_reminder->$today_date) {
            $query1  = $ci->db->get(DB_INVOICE);
            $result1 = $query1->result();
            if ($result) {
                foreach ($result as $row) {
                    if ($row->status == 5) {
                        $student_details = get_student($row->student_id);
                        $recipients      = [
                            'phone'         => $student_details->phone,
                            'parents_phone' => $student_details->parents_phone,
                        ];
                        $message    = "Dear " . $student_details->name . ', Your Invoice #' . $row->invoice_no . ' payment of amount $' . $row->invoice_amount . ' is pending. Pay at the counter. Late Fees could be charged';
                        $class_code = get_class_code_by_class($row->class_id);
                        foreach ($recipients as $recipient) {
                            send_sms($recipient, $message, 3, $class_code);
                        }
                    }
                }
            }
        }
    }
}

function send_mail($emailto, $invoice_id = false, $invoice_date = false, $invoice_amount = false, $type = false, $subject, $message)
{
    $ci = &get_instance();
    $query = $ci->db->get_where('aauth_users', ['id' =>  1]);
    $result = $query->row();
    $ci->load->library('email');

    $config['protocol']     = 'smtp';
    $config['smtp_host']    = 'smtp.gmail.com';
    $config['smtp_port']    = '587';
    $config['smtp_user']    = 'arvind.verz@gmail.com';
    $config['smtp_pass']    = 'zebCd6SXvZ5J73x';
    $config['mailpath']     = '/usr/sbin/sendmail';
    $config['smtp_crypto']  = "tls";
    $config['smtp_timeout'] = "5";
    $config['charset']      = 'iso-8859-1';
    $config['wordwrap']     = true;
    $config['mailtype']     = 'html';
    $config['crlf']         = "\r\n";
    $config['newline']      = "\r\n";

    $ci->email->initialize($config);
    $ci->email->from($result->email, 'The Science Academy');
    $ci->email->to($emailto);

    $ci->email->subject($subject);
    $ci->email->message($message);

    if ($ci->email->send()) {
        return true;
    }
    return false;
}

function send_sms($recipient, $message, $template_id = null, $class_code = null)
{
    $ci = &get_instance();

    if (empty($recipient)) {
        return false;
    }
    $status     = 0;
    $app_id     = '2927';
    $app_secret = '0f42dc3b-29c2-4824-b51f-4fa3cca4ca5f';

    $url = "http://www.smsdome.com/api/http/sendsms.aspx?appid=" . urlencode($app_id) . "&appsecret=" . urlencode($app_secret) . "&receivers=" . urlencode($recipient) . "&content=" . urlencode($message) . "&responseformat=JSON";

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result   = curl_exec($ch);
    $response = json_decode($result);
    curl_close($ch);
    if ($response->result->status == 'OK') {
        $status = 1;
    }
    $data = [
        'template_id' => $template_id,
        'class_code'  => $class_code,
        'recipient'   => $recipient,
        'message'     => $message,
        'status'      => $status,
        'created_at'  => date('Y-m-d H:i:s'),
    ];
    $ci->db->insert('sent_sms', $data);
}