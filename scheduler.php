<?php

use GO\Scheduler;

include_once 'vendor/autoload.php';
$scheduler = new Scheduler();

$scheduler->php('/usr/bin/php /home/verzcom2/public_html/tsa/index.php CronInvoiceController index')->everyMinute();
$scheduler->run();
