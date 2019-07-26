<?php

use GO\Scheduler;

include_once 'vendor/autoload.php';
$scheduler = new Scheduler();

$scheduler->php('/usr/bin/curl -s http://verz1.com/verz1.com/tsa/admin/studentcron')->everyMinute();
$scheduler->run();