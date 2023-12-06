<?php
    session_start(); 
    include '../db_connection.php';
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        echo "<script>
            alert('You are already logged in!');
            location.href='index.php'
        </script>";
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- account page styles/css -->
    <link rel="stylesheet" href="../styles/account.css?v=" />

    <!-- global styles/css -->
    <link rel="stylesheet" href="../styles/global.css?v=2" />
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
                            echo "<img src='../public/images/$image' alt='Logo' height='85px'>";
                        }
                    ?>
                </a>
            </div>
            <div class="nav-items">
                <div class="dropdown">
                    <a>Products</a>
                    <div class=" dropdown-content">
                        <?php
                            include '../db_connection.php';
                            mysqli_select_db($con, 'product');
                            $sql = "SELECT * FROM Category";
                            $result = mysqli_query($con, $sql);
                
                            while ($row = mysqli_fetch_array($result)){
                                $category = $row['Category_name'];
                                echo "<a href='products.php?category=$category'>$category</a>";
                            }
                        
                        ?>
                    </div>
                </div>
                <!-- <a href="products.php">Products</a> -->
                <!-- <a href="../about.php">about</a> -->
                <a href="virtual-try-on.php">Virtual Try On</a>
                <a href="appointment.php">Book an Appointment</a>

                <div class="svg-items">
                    <a href="cart.php" class="dropbtn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 22C9.55228 22 10 21.5523 10 21C10 20.4477 9.55228 20 9 20C8.44772 20 8 20.4477 8 21C8 21.5523 8.44772 22 9 22Z"
                                stroke="#5775B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M20 22C20.5523 22 21 21.5523 21 21C21 20.4477 20.5523 20 20 20C19.4477 20 19 20.4477 19 21C19 21.5523 19.4477 22 20 22Z"
                                stroke="#5775B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6"
                                stroke="#5775B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <div class="dropdown">
                        <div class="dropbtn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" id="iconSvg"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                    stroke="#5775B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path
                                    d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                    stroke="#5775B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            <div class="navImage" id="navImage">
                                <img src="#" alt="" id="navbarProfile">
                                <p id="userName">Name</p>
                            </div>
                            <p id="user" ">My Account</p>
                        </div>
                        <div class=" dropdown-content">
                            <div id='op2'>
                                <a href='my-account.php'>My Account</a>
                                <a href="logout.php" class='logout'>Logout</a>
                            </div>
                            <div id='op1'>
                                <a href='login.php'>Login</a>
                                <a href='register.php'>Register</a>
                            </div>
                        </div>
                        <div class="dropdown-content" id="op2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="" style="padding: 40px">
        <h2 class="dark-text title">Register</h2>
        <div class="card">
            <form name="registration-form" action="register.php" method="POST">
                <div class="form-input">
                    <label id="error" class="errorSignup">
                        *Please Fill out all the input below
                    </label>
                    <label for="name" id="lblName">Name:</label>
                    <input id="name" name="name" type="text" required />
                </div>
                <div class="form-input">
                    <label for="name" id="lblEmail">E-mail:</label>
                    <input id="email" name="email" type="email" required />
                </div>
                <div class="form-input">
                    <label for="name" id="lblPass">Password:</label>
                    <input id="password" minlength="8" name="password" type="password" required />
                </div>
                <div class="form-input" id="lblConfirmPass">
                    <label for="name">Confirm Password:</label>
                    <input id="confirmPassword" minlength="8" type="password" name="confirmPassword" required />
                    <label id="signUpError" class="error">
                        Password Does Not Match. Please Try Again.
                    </label>
                </div>
                <div class="check">
                    <input type="checkbox" required />
                    <p class="span">
                        By ticking this box, you consent to the collection and processing
                        of your personal data, and you confirm that you have read and
                        understood our <a href="../privacy-notice.php" target="_blank" class="signup">Privacy Notice</a>
                    </p>
                </div>

                <button id="formButton">
                    Create Account
                </button>
                <div class="divider"></div>
                <p class="span">
                    Have an account?
                    <span>
                        <a href="login.php" class="signup" type="submit">Sign in</a>
                    </span>
                </p>
                <!-- <p id="messageDiv"></p> -->
            </form>
        </div>
    </section>

    <div class="bg-dark" id="dark"></div>
    <section class="container success" id="successSignUP">
        <div class="signupSuccess">
            <h2 class="dark-text title">Customer Sign-up</h2>
            <h3 class="dark-text">You have sign-up successfully as a customer</h3>
            <p>Please Check your email to verify your account</p>
            <a href="login.php">Login Here</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <a href="index.php">
                        <?php
                        mysqli_select_db($con, 'cms');
                        $getLogo = "SELECT * FROM logo WHERE id = '1'";
                        $logo = mysqli_query($con, $getLogo);
                        while ($row = mysqli_fetch_array($logo)){
                            $image = $row['Image'];
                            echo "<img src='../public/images/$image' alt='Logo' height='150'>";
                        }
                    ?> </a>
                </div>
                <div class="two-column">
                    <div>
                        <h3 class="dark-text">Products</h3>
                        <div class="footer-item">
                            <a href="index.php">Shop</a>
                        </div>
                    </div>
                    <div>
                        <h3 class="dark-text">About</h3>
                        <div class="footer-item">
                            <a href="../about.php">About Us</a>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="dark-text">Help</h3>
                    <div class="footer-item">
                        <a href="appointment.php">Book an appointment</a>
                        <a href="../contact.php">Ask a question</a>
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

            </div>
        </div>
    </footer>
    <div class="footer-bottom">
        <div class="footer-container">
            <p>© 2023. Eye Vision. All right reserved.</p>
        </div>
    </div>

    <script src="javascript/account.js"></script>
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

    $mail = new PHPMailer(true);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customerName = $_POST['name'];
        $customerEmail = $_POST['email'];
        $customerPassword = $_POST['password'];
        $customerConfirmPassword = $_POST['confirmPassword'];

        if (empty($customerName) || empty($customerEmail) || empty($customerPassword) || empty($customerConfirmPassword)) {
            echo "<script>
                    document.getElementById('error').style.display = 'flex';
                    document.getElementById('error').innerHTML = 'All fields are required. Please fill out the form completely.';
            </script>";
            //                     // document.getElementById('error').style.display = 'flex';
            // echo "<script>alert('All fields are required. Please fill out the form completely.')</script>";

        } else {
            include '../db_connection.php'; // Include the database connection script
            mysqli_select_db($con, 'User');

            $checkEmailQuery = "SELECT * FROM accounts WHERE Email = '$customerEmail'";
            $result = mysqli_query($con, $checkEmailQuery);
            if (mysqli_num_rows($result) > 0){
                echo "<script>
                    document.getElementById('name').value = '$customerName';
                    document.getElementById('email').value = '$customerEmail';
                    document.getElementById('password').value = '$customerPassword';
                    document.getElementById('confirmPassword').value = '$customerConfirmPassword';
                           
                    document.getElementById('error').style.display = 'flex';
                    document.getElementById('error').innerHTML = 'Email already exists. Please use a different email.';
                </script>";
            } else if ($customerPassword != $customerConfirmPassword){
                echo "<script>
                    document.getElementById('name').value = '$customerName';
                    document.getElementById('email').value = '$customerEmail';
                    document.getElementById('password').value = '$customerPassword';
                    document.getElementById('confirmPassword').value = '$customerConfirmPassword';
                    document.getElementById('error').style.display = 'none';
                    document.getElementById('signUpError').style.display = 'flex';
                </script>";
            } else if ($customerPassword === $customerConfirmPassword){
                echo "<script>
                    document.getElementById('error').style.display = 'none';
                </script>";
                $sql = "INSERT INTO accounts (Name, Email, Password, Status) 
                VALUES ('$customerName', '$customerEmail', '$customerPassword', 'Not Verified')";
                $sql2 = "INSERT INTO user_info (Name, Email) VALUES ('$customerName', '$customerEmail')";
                if (mysqli_query($con, $sql) && mysqli_query($con, $sql2)) {
                    echo "<script>
                        document.getElementById('dark').style.display = 'flex';
                        document.getElementById('successSignUP').style.display = 'flex';
                    </script>";     

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
                } else {
                    echo "Error in SQL query: " . mysqli_error($con);
                    }
                
            } else {
                echo "<script>
                    document.getElementById('name').value = '$customerName';
                    document.getElementById('email').value = '$customerEmail';
                    document.getElementById('password').value = '$customerPassword';
                    document.getElementById('confirmPassword').value = '$customerConfirmPassword';
                        
                    document.getElementById('signUpError').style.display = 'flex';
                </script>";
            }
            mysqli_close($con);
        }
    }
?>