<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classes extends CI_Model
{

    public function __construct()
    {
        $this->uniq_id = uniqid();
        $this->date    = date('Y-m-d H:i:s');
    }

    public function store()
    {
        //die(print_r($_POST));
        $query = $this->db->get_where(DB_CLASSES, ['class_code' => $_POST['class_code']]);
        if($query->num_rows()>0) {
            $this->session->set_flashdata('warning', CLASSES . ' Code ' . MSG_EXIST);
            return redirect('admin/classes/create');
        }
        $data = array(
            'class_id'     => $this->uniq_id,
            'class_name'   => !empty($_POST['class_name']) ? $_POST['class_name'] : null,
            'tutor_id'     => !empty($_POST['tutor_id']) ? $_POST['tutor_id'] : null,
            'level'        => !empty($_POST['level']) ? $_POST['level'] : null,
            'subject'      => !empty($_POST['subject']) ? json_encode($_POST['subject']) : null,
            'class_code'   => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
            'frequency'    => !empty($_POST['frequency']) ? $_POST['frequency'] : null,
            'class_time'   => !empty($_POST['class_time']) ? $_POST['class_time'] : null,
            'class_day'    => !empty($_POST['class_day']) ? $_POST['class_day'] : null,
            'class_month'  => !empty($_POST['class_month']) ? $_POST['class_month'].'-'.date('d') : null,
            'monthly_fees' => !empty($_POST['monthly_fees']) ? $_POST['monthly_fees'] : 0,
            'deposit_fees' => !empty($_POST['deposit_fees']) ? $_POST['deposit_fees'] : 0,
            'class_size'   => !empty($_POST['class_size']) ? $_POST['class_size'] : 0,
            'remark'       => !empty($_POST['remark']) ? $_POST['remark'] : null,
            'created_at'   => $this->date,
            'updated_at'   => $this->date
        );

        $this->db->trans_start();
        $this->db->insert(DB_CLASSES, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/classes/create');
        } else {
            $this->session->set_flashdata('success', CLASSES . ' ' . MSG_CREATED);
            return redirect('admin/classes');
        }
    }

    public function update($id)
    {
        $data = array(
            'class_name'   => !empty($_POST['class_name']) ? $_POST['class_name'] : null,
            'tutor_id'     => !empty($_POST['tutor_id']) ? $_POST['tutor_id'] : null,
            'level'        => !empty($_POST['level']) ? $_POST['level'] : null,
            'subject'      => !empty($_POST['subject']) ? json_encode($_POST['subject']) : null,
            'class_code'   => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
            'frequency'    => !empty($_POST['frequency']) ? $_POST['frequency'] : null,
            'class_time'   => !empty($_POST['class_time']) ? $_POST['class_time'] : null,
            'class_day'    => !empty($_POST['class_day']) ? $_POST['class_day'] : null,
            'class_month'  => !empty($_POST['class_month']) ? $_POST['class_month'].'-'.date('d') : null,
            'monthly_fees' => !empty($_POST['monthly_fees']) ? $_POST['monthly_fees'] : 0,
            'deposit_fees' => !empty($_POST['deposit_fees']) ? $_POST['deposit_fees'] : 0,
            'class_size'   => !empty($_POST['class_size']) ? $_POST['class_size'] : 0,
            'remark'       => !empty($_POST['remark']) ? $_POST['remark'] : null,
            'updated_at'   => $this->date,
        );

        $this->db->trans_start();
        $this->db->where('class_id', $id);
        $this->db->update(DB_CLASSES, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/classes/update' . $id);
        } else {
            $this->session->set_flashdata('success', CLASSES . ' ' . MSG_UPDATED);
            return redirect('admin/classes');
        }
    }

    public function delete($id)
    {
        $this->db->trans_start();
        $this->db->where('class_id', $id);
        $this->db->update(DB_CLASSES, ['is_archive' => 1, 'archive_at' => $this->date]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/classes');
        } else {
            $this->session->set_flashdata('success', CLASSES . ' ' . MSG_ARCHIVED);
            return redirect('admin/classes');
        }
    }

    public function moveto_active_list($id)
    {
        $this->db->trans_start();
        $this->db->where('class_id', $id);
        $this->db->update(DB_CLASSES, ['is_archive' => 0, 'updated_at' => $this->date]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/classes/archived');
        } else {
            $this->session->set_flashdata('success', CLASSES . ' ' . MSG_MOVED);
            return redirect('admin/classes');
        }
    }

    public function delete_archive($class_id)
    {
        $this->db->delete(DB_CLASSES, ['class_id' =>  $class_id]);
        $this->session->set_flashdata('success', CLASSES . ' ' . MSG_DELETED);
        return redirect('admin/classes');
    }

}
