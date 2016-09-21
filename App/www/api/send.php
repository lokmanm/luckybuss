<?php 
header('content-type: application/json; charset=utf-8');

if (isset($_GET["email"])) {
	
	$email = strip_tags($_GET['email']);
	
	$message = strip_tags($_GET['message']);
	$header = "From: ". $email . " <" . $message . ">rn"; 

	$ip = $_SERVER['REMOTE_ADDR']; 
	$httpref = $_SERVER['HTTP_REFERER']; 
	$httpagent = $_SERVER['HTTP_USER_AGENT']; 
	$today = date("F j, Y, g:i a");    
	
	$recipient = 'arlindmusliu90@gmail.com';
	$subject = 'Contact Form';
	$mailbody = "
Email: $email 
Message: $message

IP: $ip
Browser info: $httpagent
Referral: $httpref
Sent: $today
";
	$result = 'success';

	if (mail($recipient, $subject, $mailbody, $header)) {
		echo json_encode($result);
	}
}
?>