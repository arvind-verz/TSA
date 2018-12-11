<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronReservationController extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        //$this->load->library('input');
    }

    public function index()
    {
        //HOURLY
        send_student_reservation_sms();
        send_student_confirmation_sms();
        fee_reminder();
        late_fee_reminder();
    }
}
