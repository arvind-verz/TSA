<?php 
require_once 'application/config/config.php';

$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if($_POST)
{	
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

	

	$sql_email_temp = 'select * from '.TBL_EMAIL_TEMP.' where id = 8';
	$result_temp = $conn->query($sql_email_temp);
	$transaction_temp = mysqli_fetch_array($result_temp,MYSQLI_ASSOC);	

        $body 			  = $transaction_temp["body"];
		$body			  = str_replace("{NAME}", $event_registration_info['first_name'], $body);
		$body			  = str_replace("{SITE_LOGO}", '<img src="https://www.svca.org.sg/assets/upload/logo/original/1489584079logo.jpg" border="0"/>', $body);		
		$body			  = str_replace("{SITE_NAME}", 'SVCA', $body);
		$body			  = str_replace("{EVENT_NAME}", $transaction_e['title'], $body);
		$body			  = str_replace("{DATE}", date("F d, Y", strtotime($transaction_e['start_date'])), $body);
		$body			  = str_replace("{TIME}", $transaction_e['event_time'], $body);
		$body			  = str_replace("{VENUE}", $transaction_e['venue'], $body);
		

		//mail($event_registration_info['email'],'Paypal Confirmation',$body,$headers);
		$subject='Confirmation for your registration';
		$from_name="Singapore Venture Capital & Private Equity Association";
		//mail_attachment($event_registration_info['invoice'], $event_registration_info['email'], "info@svca.org.sg", $from_name, $subject, 'test');
	
	
$fileatt     = $event_registration_info['invoice'];
$fileatttype = "application/pdf";
$fileattname = "invoice.pdf";
$headers = "From: info@svca.org.sg";

// File
$file = fopen($fileatt, 'rb');
$data = fread($file, filesize($fileatt));
fclose($file);

// This attaches the file
$semi_rand     = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $body . "\n\n"; 

$data = chunk_split(base64_encode($data));
$message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatttype};\n" .
" name=\"{$fileattname}\"\n" .
"Content-Disposition: attachment;\n" .
" filename=\"{$fileattname}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
"-{$mime_boundary}-\n";

// Send the email
if(mail($event_registration_info['email'], $subject, $message, $headers)) {

    echo "The email was sent.";

}
else {

    echo "There was an error sending the mail.";

}
	
	
	
	
	
	
	
	
	
	$conn->close();
	
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