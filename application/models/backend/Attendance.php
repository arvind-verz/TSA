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
        //die(print_r($_POST['attendance_value3']));
        $query = $this->db->get_where(DB_ATTENDANCE, ['class_code' => $_POST['class_code'], 'attendance_date' => $_POST['attendance_date']]);
        if($query->num_rows()>0) {
        	$this->session->set_flashdata('warning', ATTENDANCE . ' ' . MSG_EXIST);
            return redirect('admin/attendance/create');
        }
        for ($i = 0; $i < count($_POST['student_id']); $i++) {
            $data = array(
                'class_code'      => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
                'student_id'      => !empty($_POST['student_id'][$i]) ? $_POST['student_id'][$i] : null,
                'attendance_date' => !empty($_POST['attendance_date']) ? $_POST['attendance_date'] : null,
                'status'          => !empty($_POST['attendance_value' . ($i+1)]) ? json_encode($_POST['attendance_value' . ($i+1)]) : null,
                'remark'          => !empty($_POST['remark'][$i]) ? $_POST['remark'][$i] : null,
                'created_at'      => $this->date,
                'updated_at'      => $this->date,
            );
            $this->db->trans_start();
            $this->db->insert(DB_ATTENDANCE, $data);
            $this->db->trans_complete();
            $query = $this->db->get_where(DB_ATTENDANCE, ['student_id' => $_POST['student_id'][$i], 'class_code' => $_POST['class_code']]);
            if($query->num_rows<1) {
                send_first_month_invoice($_POST['student_id'][$i]);
            }
        }

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/attendance/create');
        } else {
            $this->session->set_flashdata('success', ATTENDANCE . ' ' . MSG_CREATED);
            return redirect('admin/attendance');
        }
    }

    public function get_attendance_summary() {
        $class_code = $_GET['class_code'];
        $class_month = $_GET['class_month'];

        $query = $this->db->get_where(DB_CLASSES, ['class_code' => $class_code]);
        $result = $query->row();
        if($result) {
            $this->db->select('*');
            $this->db->from('attendance');
            $this->db->where(['class_code' => $class_code]);
            $this->db->group_by('student_id');
            $query1 = $this->db->get();
            $result1 = $query1->result();
            $date_collection = get_weekdays_of_month($class_month, $result->class_day);
            ?>
            <thead>
                <th><?php echo STUDENT ?> ID</th>
                <th><?php echo STUDENT ?> Name</th>
                <?php
                if(count($date_collection)) {
                foreach($date_collection as $dates) {
                ?>
                <th><?php echo date('d M', strtotime($dates)); ?></th>
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
                    <td><?php echo $result->student_id; ?></td>
                    <td><?php echo get_student_by_student_id($result->student_id); ?></td>
                    <?php
                    if(count($date_collection)) {
                    foreach($date_collection as $dates) {
                    ?>
                    <td><?php if($dates==date('Y-m-d', strtotime($result->attendance_date))) {echo get_attendance_status($result->status);} else {echo '-';} ?></td>
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
        else {
            ?>
            <thead>
                <th>No Data found.</th>
            </thead>
            <?php
        }
    }

    public function transfer_student() {
        $student_id = $_GET['student_id'];
        $class_code = $_GET['class_code'];

        $query = $this->db->get_where(DB_CLASSES, ['class_code' => $class_code]);
        $result = $query->row();

        $this->db->trans_start();
        foreach($student_id as $id) {
            $data = [
                'class_id' =>   $result->id
            ];
            $this->db->where('student_id', $id);
            $this->db->update(STUDENT, $data);
            send_class_transfer_invoice($id);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return 'admin/attendance/create';
        } else {
            $this->session->set_flashdata('success', STUDENT . ' ' . MSG_TRANSFERRED);
            return 'admin/attendance';
        }
    }
}
