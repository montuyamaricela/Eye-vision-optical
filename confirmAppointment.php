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
        $sql = "UPDATE Appointments SET Status = 'Confirmed' WHERE EmailAddress = '$userEmail'";
        mysqli_query($con, $sql);
        if (mysqli_query($con, $sql)){
            echo "<script>
                alert('Appointment confirmed!')
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
                $mail->Subject = 'Appointment Confirmation';
                $mail->Body    = "Hi, <br/>
                                This message is to inform you that your appointment is confirmed!. <br/> <br/>
                                Thank you for trusting Eye Vision! We look forward seeing you soon. <br/> <br/> <b>Eye Vision<b/>, your trusted eye clinic";
       
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

\