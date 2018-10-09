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
                'rest_week'    => $_POST['rest_week'][$i],
            ];
        }
        $data = array(
            'billing'                 => json_encode($billing),
            'invoice_generation_date' => !empty($_POST['invoice_generation_date']) ? $_POST['invoice_generation_date'] : null,
            'created_at'              => $this->date,
            'updated_at'              => $this->date,
        );
        $this->db->trans_start();
        $this->db->insert(BILLING, $data);
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
        $billing = [];
        for ($i = 0; $i < count($_POST['billing_name']); $i++) {
            $billing[] = [
                'billing_name' => $_POST['billing_name'][$i],
                'date_range'   => $_POST['date_range'][$i],
                'rest_week'    => $_POST['rest_week'][$i],
            ];
        }
        $data = array(
            'billing'                 => json_encode($billing),
            'invoice_generation_date' => !empty($_POST['invoice_generation_date']) ? $_POST['invoice_generation_date'] : null,
            'updated_at'              => $this->date,
        );
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update(BILLING, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/billing/update' . $id);
        } else {
            $this->session->set_flashdata('success', BILLING . ' ' . MSG_UPDATED);
            return redirect('admin/billing');
        }
    }
}
