<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Billing extends CI_Model
{

    public function __construct()
    {
        $this->uniq_id = uniqid();
        $this->date    = date('Y-m-d H:i:s');
    }

    public function store()
    {
        $billing = [];
        for ($i = 0; $i < count($_POST['billing_name']); $i++) {
            $billing[] = [
                'billing_name' => $_POST['billing_name'][$i],
                'date_range'   => $_POST['date_range'][$i],
                'rest_week'    => isset($_POST['rest_week'][$i]) ? $_POST['rest_week'][$i] : null,
                'working_week'    => isset($_POST['working_week'][$i]) ? $_POST['working_week'][$i] : null,
            ];
        }
        $data = array(
            'billing_title' => !empty($_POST['billing_title']) ? $_POST['billing_title'] : null,
            'billing'                 => json_encode($billing),
            'invoice_generation_date' => !empty($_POST['invoice_generation_date']) ? $_POST['invoice_generation_date'] : null,
            'created_at'              => $this->date,
            'updated_at'              => $this->date,
        );
        $this->db->trans_start();
        $this->db->insert(DB_BILLING, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/billing/create');
        } else {
            $this->session->set_flashdata('success', BILLING . ' ' . MSG_CREATED);
            return redirect('admin/billing');
        }
    }

    public function update($id)
    {
        //die(print_r($_POST));
        $billing = [];
        for ($i = 0; $i < count($_POST['billing_name']); $i++) {
            $billing[] = [
                'billing_name' => $_POST['billing_name'][$i],
                'date_range'   => $_POST['date_range'][$i],
                'rest_week'    => isset($_POST['rest_week'][$i]) ? $_POST['rest_week'][$i] : null,
                'working_week'    => isset($_POST['working_week'][$i]) ? $_POST['working_week'][$i] : null,
            ];
        }
        $data = array(
            'billing_title' => !empty($_POST['billing_title']) ? $_POST['billing_title'] : null,
            'billing'                 => json_encode($billing),
            'invoice_generation_date' => !empty($_POST['invoice_generation_date']) ? $_POST['invoice_generation_date'] : null,
            'updated_at'              => $this->date,
        );
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update(DB_BILLING, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/billing/update' . $id);
        } else {
            $this->session->set_flashdata('success', BILLING . ' ' . MSG_UPDATED);
            return redirect('admin/billing');
        }
    }

    public function moveto_active_list($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update(DB_BILLING, ['is_archive' => 0, 'updated_at' => $this->date]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/billing/archived');
        } else {
            $this->session->set_flashdata('success', BILLING . ' ' . MSG_MOVED);
            return redirect('admin/billing');
        }
    }

    public function delete_archive($billing_id)
    {
        $this->db->delete(DB_BILLING, ['id' =>  $billing_id]);
        $this->session->set_flashdata('success', BILLING . ' ' . MSG_DELETED);
        return redirect('admin/billing/archived');
    }

    public function archive()
    {
        $billing_id = isset($_POST['billing_id']) ? $_POST['billing_id'] : '';
        if ($billing_id) {
            $this->db->trans_start();
            foreach ($billing_id as $id) {

                $this->db->where('id', $id);
                $this->db->update(DB_BILLING, ['is_archive' => 1, 'updated_at' => $this->date]);
            }
            $this->db->trans_complete();

            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata('error', MSG_ERROR);
                return redirect('admin/billing');
            } else {
                $this->session->set_flashdata('success', BILLING . ' ' . MSG_ARCHIVED);
                return redirect('admin/billing');
            }
        }
        $this->session->set_flashdata('error', MSG_ERROR);
        return false;
    }
}
