<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends CI_Model
{

    public function __construct()
    {
        $this->uniq_id = uniqid();
        $this->date    = date('Y-m-d H:i:s');
    }

    public function store()
    {
        if(empty($_POST['student_id'])) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return false;
        }

        $query = $this->db->get_where(DB_ATTENDANCE, ['class_code' => $_POST['class_code'], 'attendance_date' => $_POST['attendance_date']]);
        if($query->num_rows()>0) {
        	$this->update($_POST);
        }

        for ($i = 0; $i < count($_POST['student_id']); $i++) {
            $data = array(
                'class_code'      => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
                'student_id'      => !empty($_POST['student_id'][$i]) ? $_POST['student_id'][$i] : null,
                'attendance_date' => !empty($_POST['attendance_date']) ? $_POST['attendance_date'] : null,
                'status'          => !empty($_POST['attendance_value' . ($i+1)]) ? json_encode($_POST['attendance_value' . ($i+1)]) : null,
                'remark'          => !empty($_POST['attendance_remark'][$i]) ? $_POST['attendance_remark'][$i] : null,
                'created_at'      => $this->date,
                'updated_at'      => $this->date,
            );
            $missed_class = $_POST['attendance_value' . ($i+1)][1];
            $class_code = $_POST['class_code'];
            $this->db->trans_start();
            if($missed_class==1) {
                $query = $this->db->get_where(DB_STUDENT, ['student_id'  =>  $_POST['student_id'][$i]]);
                $result = $query->row();
                if($result) {
                    $recipients = [
                        'phone' =>  $result->phone,
                        'parents_phone' =>  $result->parents_phone,
                    ];

                    $message = get_sms_template_content(1);
                    $z = 0;
                    $sms_pre_content = 'Hi ' . $result->firstname . ' ' . $result->lastname . '\r\n';
                    foreach($recipients as $recipient) {
                        if($z==1) {
                            $sms_pre_content = 'Hi ' . $result->salutation . ' ' . $result->parent_first_name . ' ' . $result->parent_last_name . '\r\n';
                        }
                        send_sms($recipient, $sms_pre_content . $message, 1, $class_code);
                    $z++;}
                }
            }
            $this->db->insert(DB_ATTENDANCE, $data);
            $this->db->trans_complete();
        }


        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/attendance/create');
        } else {
            $data = [
                'class_code'    =>  $_POST['class_code'],
                'class_month'   =>  date('F', strtotime($_POST['attendance_date'])),
            ];
            $this->session->set_flashdata('summary_content', $data);
            $this->session->set_flashdata('success', ATTENDANCE . ' ' . MSG_CREATED);
            return redirect('admin/attendance');
        }
    }

    public function get_attendance_summary() {
        $class_code = $_GET['class_code'];
        $class_month = $_GET['class_month'];


            $this->db->select('*');
            $this->db->from(DB_CLASSES);
            $this->db->join('student_to_class', 'class.class_id = student_to_class.class_id');
            $this->db->join(DB_STUDENT, 'student.student_id = student_to_class.student_id');
            $this->db->where(['class.class_code' => $class_code, 'student.is_active'   =>  1, 'student.is_archive' =>  0]);
            $this->db->where_in('student_to_class.status', [3, 5]);
            $query1 = $this->db->get();
            $result1 = $query1->result();

            $date_collection = [];
            $query = "select * from create_attendance where class_code= ? and DATE_FORMAT(attendance_date, '%Y-%M') = ?";
            $query = $this->db->query($query, [$class_code, date('Y').'-'.$class_month]);
            $result = $query->result();

            foreach($result as $row) {
                $date_collection[] = $row->attendance_date;
            }
            ?>
            <thead>
                <th><?php echo STUDENT ?> NRIC</th>
                <th><?php echo STUDENT ?> Name</th>
                <?php
                if(count($date_collection)) {
                foreach($date_collection as $dates) {
                ?>
                <th class="no-sort " ><span class="attendance" data-date="<?php echo $dates; ?>" style="cursor: pointer;"><?php echo date('d M', strtotime($dates)); ?></span> <i class="fa fa-trash text-danger raw_delete"  style="cursor: pointer;" aria-hidden="true" data-value="<?php echo $dates; ?>"></i></th>
                <?php
                }}
                ?>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if(count($result1)) {
                foreach($result1 as $result) {
                ?>
                <tr>
                    <td><?php echo $result->nric; ?></td>
                    <td><?php echo get_student_by_student_id($result->student_id); ?></td>
                    <?php
                    if(count($date_collection)) {
                    for($i=0;$i<count($date_collection);$i++) {
                        $this->db->select('*');
                        $this->db->from('attendance');
                        $this->db->where(['class_code' => $class_code]);
                        $this->db->where(['student_id' => $result->student_id]);
                        $this->db->where(['date(attendance_date)' => $date_collection[$i]]);
                        $this->db->order_by('id', 'ASC');
                        $query2 = $this->db->get();
                        $result2 = $query2->result();
                        $result2 = $result2[0];
                    ?>
                    <td><?php if($result2) {if($date_collection[$i]==date('Y-m-d', strtotime($result2->attendance_date))) {echo get_attendance_status($result2->status);} else {echo '-';}} else {echo '-';} ?></td>
                    <?php
                    }}
                    ?>
                </tr>
                <?php
                $i++;}}
                ?>
            </tbody>
            <?php
    }

    public function transfer_student() {

        $student_id = $_GET['student_id'];
        $class_code = $_GET['class_code'];
        $old_class_code = $_GET['old_class_code'];
        $old_class_id = get_class_id_by_class_code($old_class_code);
        $class_id = get_class_id_by_class_code($class_code);
        $student_exist_array = [];
        $this->db->trans_start();
        foreach($student_id as $id) {
            $query = $this->db->get_where('student_to_class', ['class_id' => $class_id, 'student_id'    =>  $id]);
            if($query->num_rows()>0) {
                $student_exist_array[] = get_student_name_by_student_id($id);
            }
        }
        if(count($student_exist_array)>0)
        {
            $student_names = implode(',', $student_exist_array);
            $this->session->set_flashdata('error', $student_names . ' already exist in class ' . $class_code);
            return 'admin/students';
        }

        foreach($student_id as $id) {
            send_class_transfer_invoice($id, $old_class_id, $class_id);

            $data = [
                'student_id'    =>  $id,
                'class_id' =>   $class_id,
                'status'    =>  3,
                'created_at'    =>  $this->date,
                'updated_at'    =>  $this->date,
            ];
            $data1 = [
                'student_id'    =>  $id,
                'class_id' =>   $class_id,
                'updated_at'    =>  $this->date,
            ];
            $this->db->where('student_id', $id);
            $this->db->where('class_id', $old_class_id);
            $this->db->update('student_to_class', ['status' =>  5]);

            $query = $this->db->get_where('student_to_class', ['class_id' => $class_id, 'student_id'    =>  $id, 'status'   =>  3]);
            if($query->num_rows()>0) {
                //return print_r($this->db->last_query());
                $this->db->where('student_id', $id);
                $this->db->where('class_id', $class_id);
                $this->db->update('student_to_class', ['status' =>  3]);
            }
            else {
                $this->db->insert('student_to_class', $data);
            }

            $this->db->where('student_id', $id);
            $this->db->where('class_id', $old_class_id);
            $this->db->update('student_enrollment', $data1);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return 'admin/attendance';
        } else {
            $this->session->set_flashdata('success', STUDENT . ' ' . MSG_TRANSFERRED);
            return 'admin/attendance';
        }
    }

    public function update()
    {
        for ($i = 0; $i < count($_POST['student_id']); $i++) {
            $data = array(
                'class_code'      => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
                'student_id'      => !empty($_POST['student_id'][$i]) ? $_POST['student_id'][$i] : null,
                'status'          => !empty($_POST['attendance_value' . ($i+1)]) ? json_encode($_POST['attendance_value' . ($i+1)]) : null,
                'remark'          => !empty($_POST['attendance_remark'][$i]) ? $_POST['attendance_remark'][$i] : null,
                'updated_at'      => $this->date,
            );

            $this->db->trans_start();
            $query = $this->db->get_where(DB_ATTENDANCE, ['class_code'  =>  $_POST['class_code'], 'student_id'  =>  $_POST['student_id'][$i], 'attendance_date' =>  $_POST['attendance_date']]);
            if($query->num_rows()>0)
            {
                $this->db->where(['class_code'  =>  $_POST['class_code'], 'student_id'  =>  $_POST['student_id'][$i], 'attendance_date' =>  $_POST['attendance_date']]);
                $this->db->update(DB_ATTENDANCE, $data);
            }
            else
            {
                $data = array(
                    'class_code'      => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
                    'student_id'      => !empty($_POST['student_id'][$i]) ? $_POST['student_id'][$i] : null,
                    'attendance_date' => !empty($_POST['attendance_date']) ? $_POST['attendance_date'] : null,
                    'status'          => !empty($_POST['attendance_value' . ($i+1)]) ? json_encode($_POST['attendance_value' . ($i+1)]) : null,
                    'remark'          => !empty($_POST['attendance_remark'][$i]) ? $_POST['attendance_remark'][$i] : null,
                    'created_at'      => $this->date,
                    'updated_at'      => $this->date,
                );
                $missed_class = $_POST['attendance_value' . ($i+1)][1];
                $class_code = $_POST['class_code'];
                $this->db->trans_start();
                if($missed_class==1) {
                    $query = $this->db->get_where(DB_STUDENT, ['student_id'  =>  $_POST['student_id'][$i]]);
                    $result = $query->row();
                    if($result) {
                        $recipients = [
                            'phone' =>  $result->phone,
                            'parents_phone' =>  $result->parents_phone,
                        ];

                        $message = get_sms_template_content(1);
                        $z = 0;
                        $sms_pre_content = 'Hi ' . $result->firstname . ' ' . $result->lastname . '\r\n';
                        foreach($recipients as $recipient) {
                            if($z==1) {
                                $sms_pre_content = 'Hi ' . $result->salutation . ' ' . $result->parent_first_name . ' ' . $result->parent_last_name . '\r\n';
                            }
                            send_sms($recipient, $sms_pre_content . $message, 1, $class_code);
                        $z++;}
                    }
                }
                $this->db->insert(DB_ATTENDANCE, $data);
                $this->db->trans_complete();
            }

            $this->db->trans_complete();
        }


        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/attendance/create');
        } else {
            $data = [
                'class_code'    =>  $_POST['class_code'],
                'class_month'   =>  date('F', strtotime($_POST['attendance_date'])),
            ];
            $this->session->set_flashdata('summary_content', $data);
            $this->session->set_flashdata('success', ATTENDANCE . ' ' . MSG_UPDATED);
            return redirect('admin/attendance');
        }
    }

    public function schedule_store()
    {
        $attendance_date = $_POST['attendance_date'];
        $class_code = $_POST['class_code'];
		
		$query = $this->db->get_where('create_attendance', ['attendance_date' =>  $attendance_date, 'class_code'   =>  $class_code]);
		if($query->num_rows()>0) {
			$this->session->set_flashdata('error', $attendance_date .' dates already exist within system.');
			return redirect('admin/attendance/create');
		}

        $this->db->trans_start();
		$data = [
			'class_code'    =>  $class_code,
			'attendance_date'   =>  $attendance_date,
			'created_at'    =>  $this->date,
			'updated_at'    =>  $this->date,
		];
		$this->db->insert('create_attendance', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/attendance/create');
        } else {
            $this->session->set_flashdata('success', ATTENDANCE . ' ' . MSG_CREATED);
            return redirect('admin/attendance/create-edit/'.get_class_id_by_class_code($class_code).'/'.$attendance_date);
        }
    }

    public function raw_delete()
    {
        $class_code = $_GET['class_code'];
        $class_month = $_GET['class_month'];
        $class_date = $_GET['class_date'];

        $this->db->where(['class_code'  => $class_code, 'attendance_date'    =>  $class_date]);
        $this->db->delete('attendance');
        echo "success";
    }
}
