<?php
$to = 'nicckk3@gmail.com';
$message = 'This is second the message.';
$subject = 'Insert Subject Here';
$headers = 'From: nicckk3@gmail.com' . "\r\n" .
           'Reply-To: nicckk.verz@gmail.com';

@mail($to, $subject, $message, $headers); 
?>