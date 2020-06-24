<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST["email"])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];


    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = 2;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.ionos.fr';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'noreply@api.iamscott.fr';                     // SMTP username
            $mail->Password   = 'fudta1-tocrYf-pevryq';                               // SMTP password
            $mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('noreply@api.iamscott.fr', 'Adjecif');
            $mail->addAddress(trim($email), $firstname);
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Contact';
            $mail->Body    = "<ul><li>$firstname</li><li>$lastname</li><li>$email</li><li>$phone</li></ul>";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // $mail->send();
            // header("location:index.php?success");

            if ($mail->send()) {
                $status = "success";
                $response = "Email is sent!";
            } else {
                $status = "failed";
                $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
            }

            exit(json_encode(array("status" => $status, "response" => $response)));
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
