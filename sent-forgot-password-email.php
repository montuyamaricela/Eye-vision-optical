<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\SMTP.php';
//Load Composer's autoloader
//require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
              
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                     
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'optical.eyevisionclinic@gmail.com';                   
    $mail->Password   = 'xucc ryyd kxso fhwl';                               
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;         
                                        
              //Recipient
    $mail->setFrom($customerEmail, 'Eye Vision');
    $mail->addAddress($customerEmail, $customerFirstName);    

    $mail->isHTML(true);                                 
    $mail->Subject = 'Appointment Confirmation';
    $mail->Body    = "Hi $customerFirstName $customerLastName, <br/>
                    See below for the full details. <br/> 
                    <h2>Appointment Details</h2>
                    <b>Appointment: </b> $customerPurposeOfVisit <br/>
                    <b>Schedule: </b> $customerPreferredSchedule1 <br/> <br/>
                    <b>Note: <b/> $customerMessage <br/><br/>

                    To confirm your appointment, click this link for confirmation. <br/>
                    <b>Confirmation Link: <b/> http://localhost/optical/confirmAppointment.php?userEmail=$customerEmail <b/> <br/> <br/>

                    To cancel your appointment, click this link for cancellation. <br/>
                    <b>Cancellation Link: <b/> http://localhost/optical/cancelAppointment.php?userEmail=$customerEmail <b/> <br/> <br/>
                                
                    We look forward to seeing you soon, <br/> Eye Vision.";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>