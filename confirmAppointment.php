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
        echo "<script>console.log('hello!')</script>";
    } else {
        include 'db_connection.php'; // Include the database connection script
        echo "<script>console.log('$userEmail')</script>";
        mysqli_select_db($con, 'Contact');
        $sql = "UPDATE Appointments SET Status = 'Confirmed' WHERE EmailAddress = '$userEmail'";
        mysqli_query($con, $sql);
        if (mysqli_query($con, $sql)){
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

<head>
    <title>Confirmed Appointment</title>
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
                    <img src="public/images/logo/logo-no-bg.png" alt="" height="85px">
                </a>
            </div>
            <div class="nav-items">
                <a href="shop.php">Shop</a>
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


    <section id="dark" class="bg-dark" style="display:block"></section>
    <section id="sent" class="sent" style="display:block">
        <div class="confirmation">
            <h3 class="dark-text">Your Appointment has been Confirmed!</h3>
            <p>Thank you for trusting Eye Vision for your eye care & treatment needs. See you there!</p>
            <div class="confbutton">
                <a href="index.php" class=" close">Close</a>
            </div>
        </div>
    </section>


    <section class=" container">
        <div class="book-appointment">
            <div class="">
                <h2 class="section-title">Set An Appointment</h2>
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
                            <option value="Optical and Contact Lens Services">Optical and Contact Lens Services
                            </option>
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

?>