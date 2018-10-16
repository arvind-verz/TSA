<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sms extends CI_Model
{

    public function __construct()
    {
        $this->uniq_id = uniqid();
        $this->date    = date('Y-m-d H:i:s');
    }

    public function sms_template_store()
    {
        $query = $this->db->get_where('sms_template', ['reason' => $_POST['assign_condition']]);
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('warning', SMS_TEMPLATE . ' ' . MSG_EXIST);
            return redirect('admin/sms_template/sms_template_create');
        }
        $data = array(
            'reason'        => !empty($_POST['assign_condition']) ? $_POST['assign_condition'] : null,
            'template_name' => !empty($_POST['template_name']) ? $_POST['template_name'] : null,
            'message'       => !empty($_POST['message']) ? $_POST['message'] : null,
            'created_at'    => $this->date,
            'updated_at'    => $this->date,
        );

        $this->db->trans_start();
        $this->db->insert('sms_template', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/sms_template/sms_template_create');
        } else {
            $this->session->set_flashdata('success', SMS_TEMPLATE . ' ' . MSG_CREATED);
            return redirect('admin/sms_template');
        }
    }

    public function sms_template_update($id)
    {
        //die(print_r($_POST));
        $query = $this->db->get_where('sms_template', ['reason' => $_POST['assign_condition'], 'id !=' => $id]);
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('warning', SMS_TEMPLATE . ' ' . MSG_EXIST);
            return redirect('admin/sms_template/sms_template_edit/' . $id);
        }
        $data = array(
            'reason'        => !empty($_POST['assign_condition']) ? $_POST['assign_condition'] : null,
            'template_name' => !empty($_POST['template_name']) ? $_POST['template_name'] : null,
            'message'       => !empty($_POST['message']) ? $_POST['message'] : null,
            'updated_at'    => $this->date,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('sms_template', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/sms_template/sms_template_update' . $id);
        } else {
            $this->session->set_flashdata('success', SMS_TEMPLATE . ' ' . MSG_UPDATED);
            return redirect('admin/sms_template');
        }
    }
}
