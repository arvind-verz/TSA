<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronFeeReminderController extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        //$this->load->library('input');
    }

    public function index()
    {
        $query = $this->db->query("select * from sms_reminder where DATE_FORMAT(late_fee_reminder, '%d-%m-%Y %H:%i')  =  DATE_FORMAT(NOW(), '%d-%m-%Y %H:%i')");
		$result = $query->row();
		if (!empty($result))
		{
			late_fee_reminder();
		}
		else {
			echo "late fee reminder date not match";
        }

        $query = $this->db->query("select * from sms_reminder where DATE_FORMAT(fee_reminder, '%d-%m-%Y %H:%i')  =  DATE_FORMAT(NOW(), '%d-%m-%Y %H:%i')");
		$result = $query->row();
		if (!empty($result))
		{
			fee_reminder();
		}
		else {
			echo "fee reminder date not match";
        }
    }
}
