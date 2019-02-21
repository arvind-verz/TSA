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
		$to = "purohitarvind777@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: arvind.verz@gmail.com";

mail($to,$subject,$txt,$headers);
        //send_cron_invoice();
    }
}
