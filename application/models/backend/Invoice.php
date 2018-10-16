<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Model
{

    public function __construct()
    {
        $this->uniq_id = uniqid();
        $this->date    = date('Y-m-d H:i:s');
    }

    public function payment_status_update()
    {
    	//die(print_r($_GET));
        $status         = isset($_GET['status']) ? $_GET['status'] : 0;
        $payment_method = isset($_GET['payment_method']) ? $_GET['payment_method'] : 0;
        $invoice_id     = isset($_GET['invoice_id']) ? $_GET['invoice_id'] : null;

        $data = [];
        if(!empty($status)) {
        	array_push($data, ['status' => $status]);
        }
        if(!empty($payment_method)) {
        	array_push($data, ['payment_method' => $payment_method]);
        }
        array_push($data, ['updated_at' => $this->date]);

        if(count($data)>2) {
        	$data = array_merge($data[0], $data[1], $data[2]);
        }
        else {
        	$data = array_merge($data[0], $data[1]);
        }
        
        $this->db->trans_start();
        if (count($invoice_id)) {
            foreach ($invoice_id as $id) {
                $this->db->where('invoice_id', $id);
                $this->db->update(DB_INVOICE, $data);
            }
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return site_url('admin/invoice');
        } else {
            $this->session->set_flashdata('success', INVOICE . ' ' . MSG_CREATED);
            return site_url('admin/invoice');
        }
    }
}
