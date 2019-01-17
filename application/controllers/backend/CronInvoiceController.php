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
        send_cron_invoice();
    }
}
