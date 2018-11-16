<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronController extends CI_Controller
{

    public function index()
    {
        send_cron_invoice();
        fee_reminder();
        late_fee_reminder();
    }
}
