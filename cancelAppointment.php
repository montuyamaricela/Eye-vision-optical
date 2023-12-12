<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\Exception.php';
    require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\PHPMailer.php';
    require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\SMTP.php';

    $mail = new PHPMailer(true);

    $userEmail = $_GET['userEmail'];

    if (!isset($userEmail)) {
        echo "<script>console.log('test!')</script>";
    } else {
        include 'db_connection.php'; // Include the database connection script
   
        mysqli_select_db($con, 'Contact');
        $sql = "UPDATE Appointments SET Status = 'Cancelled' WHERE EmailAddress = '$userEmail'";
        mysqli_query($con, $sql);
        if (mysqli_query($con, $sql)){
            echo "<script>
                alert('Appointment cancelled!')
                location.href='shop/index.php'
            </script>";
            
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
                $mail->setFrom($userEmail, 'Eye Vision');
                $mail->addAddress($userEmail);    

                $mail->isHTML(true);                                 
                $mail->Subject = 'Appointment Cancellation';
                $mail->Body    = "Hello, <br/>
                                This message is to inform you that your appointment is canceled. <br/> <br/>
                                After cancelation, you can still book another appointment if you wish to. <br/>
                                To book an appointment, click the link below <br/>
                                http://localhost/optical/appointment.php";
       
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
            //   echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        mysqli_close($con);
    }
?>