<?php
// require ReCaptcha class
// require('recaptcha-master/src/autoload.php');

require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/Exception.php');

// configure
// an email address that will receive the email with the output of the form
$sendToEmail= 'lucille@lucilleablett.co.uk';
$sendToName= 'Lucille';
// an email address that will be in the From field of the email.
$fromEmail = $_POST['email'];
$fromName = $_POST['name'];

// an email address that will receive the email with the output of the form
// subject of the email
$subject = $_POST['subject'];

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'subject' => 'Subject', 'email' => 'Email', 'message' => 'Message');

// message that will be displayed when everything is OK :)
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!  Apologies that you are seeing this page, the contact form is a work in progress.';

// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(-1);

try {
    if (!empty($_POST)) {

        $emailTextHtml = "<h1>You have a new message from your contact form</h1><hr>";
        $emailTextHtml .= "<table>";

        foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email
        if (isset($fields[$key])) {
            $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
          }
        }

        $emailTextHtml .= "</table><hr>";
        $emailTextHtml .= "<p>Have a nice day!</p>";

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsMAIL();

        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($sendToEmail, $sendToName); // you can add more addresses by simply adding another line with $mail->addAddress();
        $mail->addReplyTo($fromEmail, $fromName);

        $mail->isHTML(true);
        // $mail->Subject('message from contact form');
        $mail->msgHTML($emailTextHtml); // this will also create a plain-text version of the HTML email, very handy

        if($mail->Send()) {
          // echo "success";
        } else {
          throw new \Exception('I could not send the email.' . $mail->ErrorInfo);
          exit;
        }

        $responseArray = array('type' => 'success', 'message' => $okMessage);
        echo "response array";
      }

    } catch (\Exception $e) {
        $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
      }

// if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//     $encoded = json_encode($responseArray);
//
//     header('Content-Type: application/json');
//
//     echo $encoded;
// } else {
//     echo $responseArray['message'];
// }
