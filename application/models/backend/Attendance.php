<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends CI_Model
{

    public function __construct()
    {
        $this->uniq_id = uniqid();
        $this->date    = date('Y-m-d H:i:s');
    }
}