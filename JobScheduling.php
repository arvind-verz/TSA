<?php

use GO\Scheduler;

include_once 'vendor/autoload.php';
$scheduler = new Scheduler();

$scheduler->php('/home/verzcom2/public_html/verz1.com/tsa/application/controllers/backend/DemoController.php/index')->everyMinute();
$scheduler->run();