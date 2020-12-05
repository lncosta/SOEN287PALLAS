<?php
/**
 * PHP Template for using PHPMailer to send emails.
 * Before sending emails using the Gmail's SMTP Server, you must make some of the security and permission level     
 * settings under your Google Account Security Settings. Please create a dummy account as you will have to put in 
 * username and password
 * Make sure that 2-Step-Verification is disabled. Follow the link https://myaccount.google.com/security
 * Turn ON the "Less Secure App" access at https://myaccount.google.com/u/0/lesssecureapps 
 */

//Import the PHPMailer class into the global namespace
//You don't have to modify these lines. 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start();

$type = $_SESSION['type'];
$price = $_SESSION['price'];
$location = $_SESSION['location'];
$first_name = $_SESSION['fname'];
$last_name = $_SESSION['lname'];
$card_type = $_SESSION['card_type'];
$ticket_quantity = $_SESSION['ticket_quantity'];
$email = $_SESSION['email'];
$cardholder_name = $_SESSION['cardholder_name'];
$street_address = $_SESSION['street_address'];
$expiration_date = $_SESSION['expiration_date'];
$CVV = $_SESSION['CVV'];
$city = $_SESSION['city'];
$postal_code = $_SESSION['postal_code'];
$subject = "Ticket Order Confirmation";

$message = 
"
<body style = font-size: 20px;>
<h2>Hello ".$first_name." ". $last_name.",</h2>
Thank you for your recent ticket purchase on PALLAS Entertainment.<br><br>".
"<table border = '1'>
<caption style = 'font-size: 15px; float: left;'>Your Event</caption>".
"<tr><td style = 'border-width: 0px'>Performance: ".$type."</td></tr>
<tr><td style = 'border-width: 0px'>Location: ".$location.
"</td></tr>
<tr><td style = 'border-width: 0px'>Ticket Quantity: ".$ticket_quantity.
"</td></tr>
<tr><td style = 'border-width: 0px'>Total: ".$price.
"</td></tr>
</table>
<table style = font-size: 20px; border = '1'>
<caption style = 'font-size: 15px; float: left;'>Billing Address</caption>
<tr>
<td style = 'border-width: 0px'>
Carholder Name: ".$cardholder_name." 
</td>
</tr>
<br>
<tr>
<td style = 'border-width: 0px'>
Address: ".$street_address."
</td>
</tr>
<br>
<tr>
<td style = 'border-width: 0px'>
City: ".$city."
</tr>
</table>
<br>
</body>"
;

//ADD CARD TYPE

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server (We will be using GMAIL)
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 587;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication
$mail->Username = 'mailer.php25@gmail.com';
//Password to use for SMTP authentication
$mail->Password = 'PHPMailer25';
//Set who the message is to be sent from
$mail->setFrom('mailer.php25@gmail.com', 'Joseph Mezzacappa');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to email and name
$mail->addAddress($email, 'Jose Mezza');
//Name is optional
//$mail->addAddress('recepientid@domain.com');

//You may add CC and BCC
//$mail->addCC("recepient2id@domain.com");
//$mail->addBCC("recepient3id@domain.com");

$mail->isHTML(true);

//You can add attachments. Provide file path and name of the attachments
//$mail->addAttachment("file.txt", "File.txt");        
//Filename is optional
//$mail->addAttachment("images/profile.png"); 



//Set the subject line
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->Body = $message;
//You may add plain text version using AltBody
//$mail->AltBody = "This is the plain text version of the email content";
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message was sent Successfully!';
}

?>