<?php
    include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Contact page styles/css -->
    <link rel="stylesheet" href="styles/contactUs.css?v=2" />

    <!-- global styles/css -->
    <link rel="stylesheet" href="styles/global.css?v=2" />
</head>

<body onload="userHandler()">
    <section id="navigation-bar">
        <div class="navbar">
            <div>
                <a href="index.php" class="logo">
                    <?php
                        mysqli_select_db($con, 'cms');
                        $getLogo = "SELECT * FROM logo WHERE id = '1'";
                        $logo = mysqli_query($con, $getLogo);
                        while ($row = mysqli_fetch_array($logo)){
                            $image = $row['Image'];
                            echo "<img src='public/images/$image' alt='Logo' height='85px'>";
                        }
                    ?>
                </a>
            </div>
            <div class="nav-items">
                <a href="shop/index.php">Shop</a>
                <a href="about.php">about</a>
                <div class="dropdown">
                    <a>Contact</a>
                    <div class="dropdown-content">
                        <a href="shop/appointment.php">Book an appointment</a>
                        <a href="contact.php">Ask a question</a>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="dark" class="bg-dark" style="display:flex"></section>
    <section id="sent" class="sent" style="display:flex">
        <div class="content">
            <div>
                <img src="public/images/icons/mail.png" alt="mail">
            </div>
            <p class="popupMessage">A confirmation email has been sent to you. <br /> Thank you for
                trusting Eye Vision for your eye care & treatment needs.</p>
            <div class="closebtn-appointment" onClick="hidePopupMessage()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </section>


    <section class="container">
        <div class="book-appointment">
            <div class="">
                <h2 class="dark-text section-title">Set An Appointment</h2>
                <div class="contact-box">
                    <p>We will confirm your appointment schedule via email within 1-3 business days.</p>
                    <p>Thank you for trusting Eye Vision for your eye care & treatment needs.</p>
                </div>
            </div>
            <div>
                <form name="appointmentForm" action="appointment.php" method="POST">
                    <div class="two-column-input">
                        <div class="form-input">
                            <label for="name">First Name <span class="required">*</span></label>
                            <input type="text" id="firstName" name="firstName" required />
                        </div>
                        <div class="form-input">
                            <label for="name">Last Name <span class="required">*</span></label>
                            <input type="text" id="lastName" name="lastName" required />
                        </div>
                    </div>
                    <div class="two-column-input">
                        <div class="form-input">
                            <label for="name">Birthday <span class="required">*</span></label>
                            <input type="date" id="birthday" name="birthday" max="3000-01-01"
                                onfocus="this.max=new Date().toISOString().split('T')[0]" required />
                        </div>
                        <div class="form-input">
                            <label for="name">Gender <span class="required">*</span></label>
                            <select name="gender" id="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="two-column-input">
                        <div class="form-input">
                            <label for="name">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" required />
                        </div>
                        <div class="form-input">
                            <label for="name">Phone <span class="required">*</span></label>
                            <input type="number" id="phone" name="phone" required />
                        </div>
                    </div>
                    <div class="form-input">
                        <label for="name">Purpose of Visit <span class="required">*</span></label>
                        <select name="purposeOfVisit" id="purposeOfVisit" required>
                            <option value="General Eye Check Up">General Eye Check Up</option>
                            <option value="Lasik Screening">Lasik Screening</option>
                            <option value="Optical and Contact Lens Services">Optical and Contact Lens Services</option>
                            <option value="Other">Other</option>

                        </select>
                    </div>
                    <div class="form-input">
                        <label for="name">Other</label>
                        <input type="text" id="other" name="other" />
                    </div>
                    <p class="text">Indicate preferred schedules <span class="required">*</span></p>
                    <div class="two-column-input">
                        <div class="form-input">
                            <label for="name">Option 1 <span class="required">*</span></label>
                            <input type="date" id="schedule1" name="schedule1" min="2050-01-01"
                                onfocus="this.min=new Date().toISOString().split('T')[0]" required />
                        </div>
                        <div class="form-input">
                            <label for="name">Option 2:</label>
                            <input type="date" id="schedule2" name="schedule2" min="2050-01-01"
                                onfocus="this.min=new Date().toISOString().split('T')[0]" />
                        </div>
                    </div>

                    <div class="form-input">
                        <label for="name">Message:</label>
                        <textarea name="message" rows="15" cols="50" id="message" name="message"></textarea>
                    </div>

                    <button class="submit">Submit</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div>
                    <h3 class="dark-text">Products</h3>
                    <div class="footer-item">
                        <a href="">Eyeglasses</a>
                        <a href="">Contact Lens & solutions </a>
                        <a href="">Sunglasses</a>
                    </div>
                </div>
                <div>
                    <h3 class="dark-text">Help</h3>
                    <div class="footer-item">
                        <a href="shop/appointment.php">Book an appointment</a>
                        <a href="about.php">About us </a>
                        <a href="contact.php">contact us</a>
                        <a href="about.php#faq">FAQ</a>
                    </div>
                </div>
                <div class="two-column">
                    <div>
                        <h3 class="dark-text">Terms & Conditions</h3>
                        <div class="footer-item">
                            <a href="">Terms & Conditions</a>
                        </div>
                    </div>
                    <div>
                        <h3 class="dark-text">Privacy Policy</h3>
                        <div class="footer-item">
                            <a href="">Privacy Policy</a>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="dark-text">Social</h3>
                    <div class="footer-item">
                        <a href="">Facebook</a>
                        <a href="">Instagram</a>
                        <a href="">Twiter</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-bottom">
        <div class="footer-container">
            <p>© 2022. Kinemberly Eklavush. All right reserved.</p>
        </div>
    </div>
    <script src="javascript/global.js"></script>

</body>

</html>

<?php


mysqli_select_db($con, 'cms');
$getColor = "SELECT * FROM color WHERE id = '1'";
$color = mysqli_query($con, $getColor);
while ($row = mysqli_fetch_array($color)){
    $darkColor = $row['darkColor'];
    $lightColor = $row['lightColor'];
}
echo "<script>
    let elementsWithDarkClass = document.getElementsByClassName('dark-text');
    for (var i = 0; i < elementsWithDarkClass.length; i++) {
        elementsWithDarkClass[i].style.color = '$darkColor';
    }

    let elementsWithLightClass = document.getElementsByClassName('light');
    for (var i = 0; i < elementsWithLightClass.length; i++) {
        elementsWithLightClass[i].style.color = '$lightColor';
    }
</script>";

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

$currentDate = date('y/m/d');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerFirstName = $_POST['firstName'];
    $customerLastName = $_POST['lastName'];
    $customerBirthday = $_POST['birthday'];
    $customerGender = $_POST['gender'];
    $customerEmail = $_POST['email'];
    $customerPhone = $_POST['phone'];
    $customerPurposeOfVisit = $_POST['purposeOfVisit'];
    $customerOtherReason = $_POST['other'];
    $customerPreferredSchedule1 = $_POST['schedule1'];
    $customerPreferredSchedule2 = $_POST['schedule2'];
    $customerMessage = $_POST['message'];
    if (
        empty($customerFirstName) ||
        empty($customerLastName) ||
        empty($customerBirthday) ||
        empty($customerGender) ||
        empty($customerEmail) ||
        empty($customerPhone) ||
        empty($customerPurposeOfVisit) ||
        empty($customerPreferredSchedule1)
    ) {
        echo "<script>alert('All fields are required. Please fill out the form completely.')</script>";
    } else {
        include 'db_connection.php'; // Include the database connection script
        mysqli_select_db($con, 'Contact');

        $sql = "INSERT INTO Appointments (FirstName, LastName, Birthday, Gender, EmailAddress, Phone, PurposeOfVisit, Other, PreferredSchedule1, PreferredSchedule2, Status ,Message, SubmissionDate) 
        VALUES ('$customerFirstName', '$customerLastName', '$customerBirthday', '$customerGender', 
        '$customerEmail', '$customerPhone', '$customerPurposeOfVisit', '$customerOtherReason', '$customerPreferredSchedule1', '$customerPreferredSchedule2', 'Pending' ,'$customerMessage', '$currentDate')";

        if (mysqli_query($con, $sql)) {
            echo "<script>
                document.getElementById('dark').style.display = 'flex';
                document.getElementById('sent').style.display = 'flex';
                document.getElementById('message').innerHTML = 'A confirmation email has been sent to you. <br/> Thank you for trusting Eye Vision for your eye care & treatment needs.';
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
        } else {
            echo "<script>
                document.getElementById('dark').style.display = 'flex';
                document.getElementById('sent').style.display = 'flex';
                document.getElementById('message').innerHTML = 'An error occurred while processing your request. Please try again later.';
            </script>";
        }

        mysqli_close($con);
    }
}
?>