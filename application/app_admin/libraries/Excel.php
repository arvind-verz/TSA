<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*  =======================================
*  Author     : Muhammad Surya Ikhsanudin
*  License    : Protected
*  Email      : mutofiyah@gmail.com
*  
*  Dilarang merubah, mengganti dan mendistribusikan
*  ulang tanpa sepengetahuan Author
*  =======================================
*/  
require_once APPPATH."/third_party/PHPExcel.php";
//require_once APPPATH."/third_party/PHPExcel/Writer/Excel2007.php";
 
//require_once APPPATH."/third_party/PHPExcel/Reader/Excel2007.php";
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}