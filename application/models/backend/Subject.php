<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject extends CI_Model
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
            'subject_id'    =>  $this->uniq_id,
            'subject_name'   => !empty($_POST['subject_name']) ? $_POST['subject_name'] : null,
            'subject_code'   => !empty($_POST['subject_code']) ? $_POST['subject_code'] : null,
            'created_at'   => $this->date,
            'updated_at'   => $this->date,
        );

        $this->db->trans_start();
        $this->db->insert(SUBJECT, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/subject/create');
        } else {
            $this->session->set_flashdata('success', SUBJECT . ' ' . MSG_CREATED);
            return redirect('admin/subject');
        }
    }

    public function update($id)
    {
        //die(print_r($_POST));
        $data = array(
            'subject_name'   => !empty($_POST['subject_name']) ? $_POST['subject_name'] : null,
            'subject_code'   => !empty($_POST['subject_code']) ? $_POST['subject_code'] : null,
            'updated_at'   => $this->date,
        );

        $this->db->trans_start();
        $this->db->where('subject_id', $id);
        $this->db->update(SUBJECT, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/subject/update');
        } else {
            $this->session->set_flashdata('success', SUBJECT . ' ' . MSG_UPDATED);
            return redirect('admin/subject');
        }
    }

    public function delete($id)
    {
        $this->db->trans_start();
        $this->db->where('subject_id', $id);
        $this->db->update(SUBJECT, ['is_archive' => 1, 'archive_at' => $this->date]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/subject/update');
        } else {
            $this->session->set_flashdata('success', SUBJECT . ' ' . MSG_ARCHIVED);
            return redirect('admin/subject');
        }
    }
}