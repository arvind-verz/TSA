<?php require_once 'application/config/config.php';

$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

} 

if($_GET){

	$reg_id = isset($_GET['reg_id'])?$_GET['reg_id']:$_REQUEST['reg_id'];

	$event_id = isset($_GET['event_id'])?$_GET['event_id']:$_REQUEST['event_id'];

	$payment_status   = isset($_POST['payment_status'])?$_POST['payment_status']:'';

	$payment_amount   = isset($_POST['mc_gross'])?$_POST['mc_gross']:'';

	$payment_currency = isset($_POST['mc_currency'])?$_POST['mc_currency']:'';

	$txn_id           = isset($_POST['txn_id'])?$_POST['txn_id']:'';

	$receiver_email   = isset($_POST['receiver_email'])?$_POST['receiver_email']:'';

	$payer_email      = isset($_POST['payer_email'])?$_POST['payer_email']:'';

	$payment_date	 = isset($_POST['payment_date'])?$_POST['payment_date']:'';

	$custom 		   = isset($_POST['custom'])?$_POST['custom']:'';

	$test_ipn		 = isset($_POST['test_ipn'])?$_POST['test_ipn']:'';

	

	

	$sqlorder = "UPDATE ".TBL_EVENT_REGISTRATION." SET `is_paid`='Paid', `modified_date`='".date('Y-m-d H:i:s')."' WHERE `id`='".$reg_id."'";

	$conn->query($sqlorder);

	

	$sqlpayment = "INSERT INTO ".TBL_PAYPAL_TRANSACTION." (event_reg_id, transaction_type, transaction_id, event_id, payment_status, payment_amount, payment_currency, receiver_email, payer_email, payment_date, test_ipn, create_date)

VALUES ('".$reg_id."', 'PayPal', '".$txn_id."', '".$event_id."', '".$payment_status."', '".$payment_amount."', '".$payment_currency."', '".$receiver_email."', '".$payer_email."', '".$payment_date."', '".$test_ipn."', '".date('Y-m-d H:i:s')."')";

	$conn->query($sqlpayment);

	

	$sql_order = 'select * from '.TBL_EVENT_REGISTRATION.' where id = "'.$reg_id.'"';

	$result_payment = $conn->query($sql_order);

	$event_registration_info = mysqli_fetch_array($result_payment,MYSQLI_ASSOC);

	

	$sql_transaction = 'select * from '.TBL_PAYPAL_TRANSACTION.' where event_reg_id = "'.$reg_id.'"';

	$result_transaction = $conn->query($sql_transaction);

	$transaction = mysqli_fetch_array($result_transaction,MYSQLI_ASSOC);
	
	$sql_event = 'select * from '.TBL_EVENTS.' where id = "'.$event_id.'"';

	$result_event = $conn->query($sql_event);

	$transaction_e = mysqli_fetch_array($result_event,MYSQLI_ASSOC);

	

	echo $sql_email_temp = 'select * from '.TBL_EMAIL_TEMP.' where id = 8';

	$result_temp = $conn->query($sql_email_temp);

	$transaction_temp = mysqli_fetch_array($result_temp,MYSQLI_ASSOC);	

        $body 			  = $transaction_temp["body"];
		$body			  = str_replace("{SITE_LOGO}", '<img src="'.base_url('assets/upload/logo/original/1489584079logo.jpg" border="0"/>', $body);		
		$body			  = str_replace("{SITE_NAME}", 'SVCA', $body);
		$body			  = str_replace("{EVENT_NAME}", $transaction_e['title'], $body);
		$body			  = str_replace("{DATE}", date("F d, Y", strtotime($transaction_e['start_date'])), $body);
		$body			  = str_replace("{TIME}", $transaction_e['event_time'], $body);
		$body			  = str_replace("{VENUE}", $transaction_e['venue'], $body);

	$conn->close();
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
    mail('jafir.verz@gmail.com','Paypal Confirmation',$body,$headers);
	$url = SITE_URL.'resgistration-email-paypal/'.$reg_id.'/'.$transaction['id'];

	$ch = curl_init();

	// set URL and other appropriate options

	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_HEADER, 0);	

	// grab URL and pass it to the browser

	curl_exec($ch);	

	// close cURL resource, and free up system resources

	curl_close($ch);

}



?>