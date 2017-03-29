<?php

include 'vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();

var_dump($argv);
exit();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.zoho.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->IsHTML(true);
$mail->Username = "kurniawan@herobimbel.id";
$mail->Password = "Neon()123";
$mail->setFrom('kurniawan@herobimbel.id', 'PT.PAL');
$mail->addAddress($argv[1], $argv[2]);
$mail->Subject  = $argv[3];
$mail->Body     = "HAI AGUNG";
if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}

?>