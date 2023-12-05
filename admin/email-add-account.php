<?php
    session_start();
    
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false || empty($_SESSION) || empty($_SESSION['adminLoggedin'])) {
        echo "<script>
            location.href='login.php'
        </script>";
    }
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\Exception.php';
    require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\PHPMailer.php';
    require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\SMTP.php';

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                     
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'optical.eyevisionclinic@gmail.com';                   
        $mail->Password   = 'xucc ryyd kxso fhwl';                               
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;         
                                        
        $mail->setFrom($customerEmail, 'Eye Vision');
        $mail->addAddress($customerEmail, $customerName);    

        $mail->isHTML(true);                                 
        $mail->Subject = 'Account Verification';
        $mail->Body    = "<h1>Verify your email address</h1>
                <h3>Hey $customerName,</h3>
                Thanks for getting started with Eye Vision! We need a little more information to complete your registration, including confirmation of your email address. 
                <br/> Click below to confirm your email address:<br/>
                <a href='http://localhost/optical/shop/verify-account.php?userEmail=$customerEmail'>Verify Account</a> 
                <br/><br/>
                Thanks, <br/> Eye Vision, your trusted eye clinic.";      
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }               
            

?>