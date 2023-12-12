<?php
    include '../db_connection.php'; // Include the database connection script


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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customerName = $_POST['fullName'];
        $customerEmail = $_POST['email'];
        $customerPhone = $_POST['phone'];
        $customerPurposeOfVisit = $_POST['purposeOfVisit'];
        $customerOtherReason = $_POST['other'];
        $appointmentDate = $_POST['appointmentDate'];
        $appointmentTime = $_POST['appointmentTime'];
        if (
            empty($customerName) ||
            empty($customerEmail) ||
            empty($customerPhone) ||
            empty($customerPurposeOfVisit) ||
            empty($appointmentDate) ||
            empty($appointmentTime)
        ) {
            echo "<script>alert('All fields are required. Please fill out the form completely.')</script>";
        } else {
            $appointment = "INSERT INTO contact.appointments (`FullName`, `EmailAddress`, `Phone`, `PurposeOfVisit`, `Other`, `Schedule`, `Time`, `Status`)
            VALUES ('$customerName', '$customerEmail', '$customerPhone', '$customerPurposeOfVisit', '$customerOtherReason', '$appointmentDate', '$appointmentTime', 'Pending')";            
            if (mysqli_query($con, $appointment)) {                
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
                $mail->addAddress($customerEmail, $customerName);    

                $mail->isHTML(true);                                 
                $mail->Subject = 'Appointment Confirmation';
                $mail->Body    = "Hi $customerName, <br/>
                                See below for the full details. <br/> 
                                <h2>Appointment Details</h2>
                                <b>Appointment: </b> $customerPurposeOfVisit <br/>
                                <b>Schedule: </b> $appointmentDate at $appointmentTime <br/> <br/>

                                To confirm your appointment, click this link for confirmation. <br/>
                                <b>Confirmation Link: <b/> http://localhost/optical/confirmAppointment.php?userEmail=$customerEmail <b/> <br/> <br/>

                                To cancel your appointment, click this link for cancellation. <br/>
                                <b>Cancellation Link: <b/> http://localhost/optical/cancelAppointment.php?userEmail=$customerEmail <b/> <br/> <br/>
                                
                                We look forward to seeing you soon, <br/> Eye Vision.";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo "<script>
                    alert('A confirmation email has been sent to you. ')
                    location.href='appointment.php'
                </script>";                
                echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                } 
            } 

         mysqli_close($con);
        }
    }
?>