<?php
/*
Name: 			Contact Form
Author: 		HVSH
*/
session_cache_limiter('nocache');
header('Content-type: application/json');
	/* uncomment below line if using SMTP and set it to your timezone */
	//date_default_timezone_set('Etc/UTC');

	require_once('phpmailer/PHPMailerAutoload.php');

	/* Create a new PHPMailer instance */
    $mail = new PHPMailer;	

    /* Uncomment below lines if using SMTP */
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
	//$mail->isSMTP();                                      // Set mailer to use SMTP
	//$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	//$mail->SMTPAuth = true;                               // Enable SMTP authentication
	//$mail->Username = '';                 // SMTP username
	//$mail->Password = '';                           // SMTP password
	//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	//$mail->Port = 587;                                    // TCP port to connect to

	/* Set the email address to receive emails.
	Send the message to yourself, or whoever should receive contact for submissions */
	$to = 'YOUREMAIL@DOMAIN.COM';
	$toname = 'YOUR NAME';
    /* Use a fixed address in your own domain as the from address
     **DO NOT** use the submitter's address here as it will be forgery
       and will cause your messages to fail SPF checks */
	$from = 'YOUREMAIL2@DOMAIN.COM';


	/* form fields */
	$sendername = isset( $_POST['name'] ) ? $_POST['name'] : '';
	$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
	$tel = isset( $_POST['phone'] ) ? $_POST['phone'] : '';
	$subject = isset( $_POST['subject'] ) ? $_POST['subject'] : '';
	$message = isset( $_POST['message'] ) ? $_POST['message'] : '';


	$mail->setFrom( $from , $sendername );
	$mail->addReplyTo( $email , $sendername );
	$mail->addAddress($to, $toname);
	$mail->Subject = $subject;
	$mail->isHTML(true);
	$mail->CharSet = 'UTF-8';
    $mail->Body = <<<EOT
Name: {$_POST['name']}<br/><br/>
Email: {$_POST['email']}<br/><br/>
Tel: {$_POST['phone']}<br/><br/>
Message: {$_POST['message']}
EOT;


if(!$mail->Send()) {
	$mailresponse = array ('msg'=>'error');
} else {
	$mailresponse = array ('msg'=>'success');
}

echo json_encode($mailresponse);

?>