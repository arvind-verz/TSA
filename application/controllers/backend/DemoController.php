<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DemoController extends CI_Controller
{

    public function index()
    {
        send_first_month_invoice('5bd91348e6cb7');
    }
}
