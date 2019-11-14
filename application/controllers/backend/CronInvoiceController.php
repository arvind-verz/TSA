<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronInvoiceController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('input');
	}

	public function index()
	{
		//send_cron_invoice();
		$query = $this->db->query("select * from billing where DATE_FORMAT(invoice_generation_date, '%d-%m-%Y %H:%i')  =  DATE_FORMAT(NOW(), '%d-%m-%Y %H:%i')");
		$result = $query->row();
		if (!empty($result))
		{
			send_cron_invoice();
		}
		else {
			echo "date not match";
		}
	}
}
