<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Model
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
            'order_date' => $this->date,
            'class_code' => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
            'subject'    => !empty($_POST['subject']) ? json_encode($_POST['subject']) : null,
            'book_id'    => !empty($_POST['book_id']) ? $_POST['book_id'] : null,
            'created_at' => $this->date,
            'updated_at' => $this->date,
        );

        $this->db->trans_start();
        $this->db->insert(ORDER . 's', $data);

        $order_id = $this->db->insert_id();
        foreach ($_POST['student'] as $student) {
            $data1 = array(
                'student_id' => $student,
                'order_id'   => $order_id,
                'status'     => 0,
            );
            $this->db->insert('order_details', $data1);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/order/create');
        } else {
            $this->session->set_flashdata('success', ORDER . ' ' . MSG_CREATED);
            return redirect('admin/order');
        }
    }
}
