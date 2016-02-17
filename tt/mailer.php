<?php

header('Access-Control-Allow-Origin: *');

date_default_timezone_set('Etc/UTC');

require 'classes/phpmailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.mail.yahoo.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 25;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "aparnajoshi55@yahoo.com";

//Password to use for SMTP authentication
$mail->Password = "bloodbankmanagement55";

//Set who the message is to be sent from
$mail->setFrom('ar36nab@yahoo.com', 'Arnab Roy');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
if(isset($_REQUEST['to'])){
	//assume space sseparated
	$addrs=explode(' ',$_REQUEST['to']);
	foreach($addrs as $add)
		$mail->addAddress($add);
}
else //for testing
	$mail->addAddress('ellie@dispostable.com', 'ellie');

//Set the subject line
$mail->Subject = 'Time table alert';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
if (isset($_REQUEST['type']) && isset($_REQUEST['msg'])){
	$mail->msgHTML("<html>
<body>
  <div style='width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px'>
    <h1>{$_REQUEST['type']}</h1>
    <h4>
	".preg_replace("/\n/","<BR>",$_REQUEST['msg'])."
    </h4>
    <p></p>
    <p>Kindly note.</p>
  </div>
  <small style='text-align:right'>Time table tracker system</small>
</body>
</html>
");

	//Replace the plain text body with one created manually
	$mail->AltBody = "{$_REQUEST['type']} \n\n {$_REQUEST['msg']}\n\n\n\n --Time table tracker system";
}else {
	$mail->msgHTML("test");
	$mail->AltBody = 'test';
}


//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
