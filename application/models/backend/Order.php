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

        $data = array(
            'order_date' => $this->date,
            'class_code' => !empty($_POST['class_code']) ? $_POST['class_code'] : null,
            'subject'    => !empty($_POST['subject']) ? json_encode($_POST['subject']) : null,
            'book_id'    => !empty($_POST['book_id']) ? $_POST['book_id'] : null,
            'created_at' => $this->date,
            'updated_at' => $this->date,
        );

        $this->db->trans_start();
        $this->db->insert(DB_ORDER . 's', $data);

        $order_id = $this->db->insert_id();
        if($_POST['student'][0]=='all')
        {
            $_POST['student'] = [];
            $this->db->select('*, student.id as student_id');
            $this->db->from(DB_STUDENT);
            $this->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
            $this->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
            $this->db->where(DB_CLASSES . '.class_code', $_POST['class_code']);
            $this->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1]);
            $query  = $this->db->get();
            $result = $query->result();
            if($result){
                foreach($result as $row)
                {
                    $_POST['student'][] = $row->student_id;
                }
            }
        }
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

    public function update_order_status() {
        $status = $_GET['status'];
        $student_id = $_GET['student_id'];
        $order_id = $_GET['order_id'];

        $this->db->trans_start();
        if($status==3) {
            foreach($student_id as $id) {
                $this->db->delete('order_details', ['student_id'    =>  $id]);
            }
        }
        else {
            foreach($student_id as $id) {
                $data = array(
                    'status'    =>  $status,
                );

                $this->db->where(['order_id' => $order_id, 'student_id' => $id]);
                $this->db->update('order_details', $data);
            }
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return 'admin/order';
        } else {
            $this->session->set_flashdata('success', ORDER . ' status ' . MSG_UPDATED);
            return 'admin/order';
        }
    }

    public function archive()
    {
        $order_id = isset($_POST['order_ids']) ? $_POST['order_ids'] : '';
        if ($order_id) {
            $this->db->trans_start();
            foreach ($order_id as $id) {

                $this->db->where('order_id', $id);
                $this->db->update(DB_ORDER . 's', ['is_archive' => 1, 'updated_at' => $this->date]);
            }
            $this->db->trans_complete();

            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata('error', MSG_ERROR);
                return redirect('admin/order');
            } else {
                $this->session->set_flashdata('success', DB_ORDER . 's' . ' ' . MSG_ARCHIVED);
                return redirect('admin/order');
            }
        }
        $this->session->set_flashdata('error', MSG_ERROR);
        return false;
    }

    public function moveto_active_list($id)
    {
        $this->db->trans_start();
		$this->db->where('order_id', $id);
		$this->db->update(DB_ORDER.'s', array('is_archive' => 0, 'updated_at' => $this->date));
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/order/archived');
		} else {
			$this->session->set_flashdata('success', DB_ORDER.'s' . ' ' . MSG_MOVED);
			return redirect('admin/order');
		}
    }

    public function delete_archive($order_id)
    {
    	$this->db->trans_start();
        $this->db->delete('orders', ['order_id' =>  $order_id]);
        $this->db->delete('order_details', ['order_id' =>  $order_id]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
        	$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/order/archived');
        }
        else {
        	$this->session->set_flashdata('success', 'Order ' . MSG_DELETED);
        	return redirect('admin/order/archived');
        }
    }
}
