<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronController extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        //$this->load->library('input');
    }

    public function index()
    {
//mail($to,$subject,$txt,$headers);
        //MINUTES
        send_cron_invoice();
    	/*if($this->input->is_cli_request()) {
	        send_cron_invoice();
	    }*/
        //
        //late_fee_reminder();
    }
}
