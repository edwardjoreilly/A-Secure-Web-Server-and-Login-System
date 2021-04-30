<?php
session_start();
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer(TRUE);
try {
    
   //$mail->setFrom('justin.kingston.414@my.csun.edu', 'JEAM');
   //$mail->addAddress('justin.kingston.414@my.csun.edu', "Justin");
   $mail->setFrom('justin.kingston.414@my.csun.edu', 'JEAM');
   $mail->addAddress($_SESSION["EMAIL"], $_SESSION["username"]);
   $mail->Subject = $_SESSION["SUBJECT"];
   $mail->Body = $_SESSION["Body"];
   /* SMTP parameters. */
   
   /* Tells PHPMailer to use SMTP. */
   $mail->isSMTP();
   
   /* SMTP server address. */
   $mail->Host = 'email-smtp.us-east-2.amazonaws.com';

   /* Use SMTP authentication. */
   $mail->SMTPAuth = TRUE;
   
   /* Set the encryption system. */
   $mail->SMTPSecure = 'tls';
   
   /* SMTP authentication username. */
   $mail->Username = 'AKIAS54ROZLD2WPQGKHJ';
   
   /* SMTP authentication password. */
   $mail->Password = 'BJ+haT0SRPO8u1H+xh5bxzDi+tJk3UUCK6bQfQPOAgV8';
   
   /* Set the SMTP port. */
   $mail->Port = 587;
   
   /* Send the mail. */
   $mail->send();

   /* If mail is successfully sent, send to where it needs to go.*/
   //header("location: http://10.0.2.15/sentMail.php");
   header($_SESSION["redirect"]);
}
catch (Exception $e)
{
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   echo $e->getMessage();
}
?>