<?php
session_start();
if(isset($_POST['mail'])){
    // antiflood controle
    if (!empty($_SESSION['antiflood']))
    {
        $seconde = 20; // 20 seconds anti-flooding
        $tijd = time() - $_SESSION['antiflood'];
        if($tijd < $seconde)
            $antiflood = 1;
    }
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "arlindmusliu90@gmail.com";
    $email_subject = "LuckyBuss form!";      
 
    // validation expected data exists
    if(	!isset($_POST['mail']) ||
        !isset($_POST['bericht'])) {
		header("Location: ../index.html#error");
    }
 
    $email_from = $_POST['mail']; // required
    $comments = $_POST['bericht']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message = "error";
  }
   
  
  if(strlen($comments) < 2) {
    $error_message = "error";
  }
  if(strlen($error_message) > 0) {
    header("Location: ../index.html#error");
  }
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
	$datum = date('d/m/Y H:i:s');
 
	$email_message .= "Forma e derguar nga LuckyBuss " . $_SERVER['HTTP_HOST'] . "\n";
	$email_message .= "===================================================\n\n";
    $email_message .= "E-mail: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($comments)."\n\n";
    $email_message .= "Send on " . $datum . " from IP address " . $_SERVER['REMOTE_ADDR'] . "\n\n";
	$email_message .= "===================================================\n";
	$email_message .= "Tech support:\n";
	$email_message .= "===================================================\n\n";
	$email_message .= $_SERVER['HTTP_USER_AGENT'];
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
 if (($error_message == "") && ($antiflood == "")) 
  {
	$_SESSION['antiflood'] = time();
	  @mail($email_to, $email_subject, $email_message, $headers);
	  header("Location: ../index.html#succes");
  }
  else
  {
      header("Location: ../index.html#error");
  }  
} 
?>