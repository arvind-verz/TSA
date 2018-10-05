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
        $data = array(
            'class_id'     => $this->uniq_id,
            'class_name'   => !empty($_POST['class_name']) ? $_POST['class_name'] : null,
            'tutor_id'     => !empty($_POST['tutor_id']) ? $_POST['tutor_id'] : null,
            'level'        => !empty($_POST['level']) ? $_POST['level'] : null,
            'subject'      => !empty($_POST['subject']) ? $_POST['subject'] : null,
            'class_code'   => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
            'frequency'    => !empty($_POST['frequency']) ? $_POST['frequency'] : null,
            'class_time'   => !empty($_POST['class_time']) ? $_POST['class_time'] : null,
            'class_day'    => !empty($_POST['class_day']) ? $_POST['class_day'] : null,
            'class_month'  => !empty($_POST['class_month']) ? $_POST['class_month'] : null,
            'monthly_fees' => !empty($_POST['monthly_fees']) ? $_POST['monthly_fees'] : null,
            'deposit_fees' => !empty($_POST['deposit_fees']) ? $_POST['deposit_fees'] : null,
            'class_size'   => !empty($_POST['class_size']) ? $_POST['class_size'] : null,
            'remark'       => !empty($_POST['remark']) ? $_POST['remark'] : null,
            'created_at'   => $this->date,
            'updated_at'   => $this->date
        );

        $this->db->trans_start();
        $this->db->insert(CLASSES, $data);
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
        //die(print_r($_POST));
        $data = array(
            'class_name'   => !empty($_POST['class_name']) ? $_POST['class_name'] : null,
            'tutor_id'     => !empty($_POST['tutor_id']) ? $_POST['tutor_id'] : null,
            'level'        => !empty($_POST['level']) ? $_POST['level'] : null,
            'subject'      => !empty($_POST['subject']) ? $_POST['subject'] : null,
            'class_code'   => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
            'frequency'    => !empty($_POST['frequency']) ? $_POST['frequency'] : null,
            'class_time'   => !empty($_POST['class_time']) ? $_POST['class_time'] : null,
            'class_day'    => !empty($_POST['class_day']) ? $_POST['class_day'] : null,
            'class_month'  => !empty($_POST['class_month']) ? $_POST['class_month'] : null,
            'monthly_fees' => !empty($_POST['monthly_fees']) ? $_POST['monthly_fees'] : null,
            'deposit_fees' => !empty($_POST['deposit_fees']) ? $_POST['deposit_fees'] : null,
            'class_size'   => !empty($_POST['class_size']) ? $_POST['class_size'] : null,
            'remark'       => !empty($_POST['remark']) ? $_POST['remark'] : null,
            'updated_at'   => $this->date,
        );

        $this->db->trans_start();
        $this->db->where('class_id', $id);
        $this->db->update(CLASSES, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/classes/update');
        } else {
            $this->session->set_flashdata('success', CLASSES . ' ' . MSG_UPDATED);
            return redirect('admin/classes');
        }
    }

    public function delete($id)
    {
        $this->db->trans_start();
        $this->db->where('class_id', $id);
        $this->db->update(CLASSES, ['is_archive' => 1, 'archive_at' => $this->date]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/classes/update');
        } else {
            $this->session->set_flashdata('success', CLASSES . ' ' . MSG_ARCHIVED);
            return redirect('admin/classes');
        }
    }

}
