<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DemoController extends CI_Controller
{

    public function index()
    {
        send_cron_invoice();
    }
}
