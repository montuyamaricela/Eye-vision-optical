<?php 
    session_start(); 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\Exception.php';
    require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\PHPMailer.php';
    require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\SMTP.php';

    $mail = new PHPMailer(true);

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
    <title>Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- account page styles/css -->
    <link rel="stylesheet" href="../styles/account.css?v=3" />

    <!-- global styles/css -->
    <link rel="stylesheet" href="../styles/global.css" />
</head>

<body>
    <section id="navigation-bar">
        <div class="navbar">
            <div>
                <a href="index.php" class="logo">
                    <img src="../public/images/logo/logo-no-bg.png" alt="" height="85px">
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
                <a href="virtual-try-on.php">Virtual Try On</a>
                <a href="appointment.php">Book an Appointment</a>

                <div class="svg-items">

                    <a href="cart.php" class="dropbtn cart">
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
                        <?php
                            if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true){
                                mysqli_select_db($con, 'user');
                        
                                $sql = "SELECT COUNT(*) AS totalItems FROM cart WHERE User_id = '$user_id'";
                                $res = mysqli_query($con, $sql);
                                if ($res) {
                                // Fetch the result as an associative array
                                    $row = mysqli_fetch_assoc($res);

                                // Access the totalItems value
                                    $totalItems = $row['totalItems'];
                                    if ($totalItems != 0){
                                        // Output the total number of items
                                        echo "<span class='item-number'>$totalItems</span>" ;
                                    }
                                    
                                } 
                            }
                
                        ?>
                    </a>
                    <a href="wishlist.php" class="dropbtn wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="#5775B7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        <?php
                            if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true){
                                mysqli_select_db($con, 'user');
                        
                                $sql = "SELECT COUNT(*) AS totalItems FROM wishlist WHERE User_id = '$user_id'";
                                $res = mysqli_query($con, $sql);
                                if ($res) {
                                // Fetch the result as an associative array
                                    $row = mysqli_fetch_assoc($res);

                                // Access the totalItems value
                                    $totalItems = $row['totalItems'];
                                    if ($totalItems != 0){
                                        // Output the total number of items
                                        echo "<span class='item-number'>$totalItems</span>" ;
                                    }
                                    
                                } 
                            }
                
                        ?>
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
                                <a href="orders.php">My orders</a>
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


    <section class="container">
        <h2 class="title">Login</h2>
        <div class="card">
            <form name="login-form" action="login.php" method="POST">
                <div class="form-input">
                    <label id="error" class="error">
                        The email and password you've entered is incorrect.
                    </label>
                    <input type="email" placeholder="E-mail" name="email" id="email" />
                </div>
                <div class="form-input">
                    <label id="passwordError" class="error">
                        The password you’ve entered is incorrect.
                    </label>
                    <input type="password" placeholder="Password" name="password" id="password" />
                    <a href="forgot-password-enter-email.php" class="forgot">
                        Forgot Password?
                    </a>
                </div>

                <button>Login</button>
                <div class="divider"></div>
                <p class="span">
                    Don't have an account?
                    <span>
                        <a href="register.php" class="signup">Sign up</a>
                    </span>
                </p>
            </form>
        </div>
    </section>
    <div class="bg-dark" id="dark"></div>
    <section class="container success" id="blocked">
        <div class="">
            <a href="login.php" class="closeBlocked" id="closeIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            <img src="../public/images/icons/warning.png" alt="warning">
            <h2 class="title">Your Account has been Blocked</h2>
            <h3 class="">You attempted to login multiple times.</h3>
            <p>We have sent an email to you.</p>
            <a href="https://www.gmail.com" target="_blank">Check Here</a>
        </div>
    </section>
    <section class="container success" id="notverified">
        <div class="">
            <a href="login.php" class="closeBlocked" id="closeIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            <img src="../public/images/icons/warning.png" alt="warning">
            <h2 class="title">Account Not Verified</h2>
            <h3 class="">You attempted to login an account that <br /> is not verified</h3>
            <p>Please check your email to verify your account</p>
            <a href="https://www.gmail.com" target="_blank">Check Here</a>
        </div>
    </section>
    <section class="container success" id="forgotpassword">
        <div class="">
            <a href="login.php" class="closeBlocked" id="closeIcon">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            <img src="../public/images/icons/warning.png" alt="warning">
            <h2 class="title">Trouble signing in?</h2>
            <h3 class="">Resetting your password is easy!</h3>
            <p>Click the link below to reset your password</p>
            <a href="forgot-password-enter-email.php" target="_blank">Forgot Password</a>
        </div>
    </section>
    <footer>
        <div class="container">

            <div class="footer-content">
                <div class="footer-logo">
                    <a href="index.php">
                        <img src="../public/images/logo/logo-no-bg.png" alt="" width="150">
                    </a>
                </div>
                <div class="two-column">
                    <div>
                        <h3>Products</h3>
                        <div class="footer-item">
                            <a href="shop.php">Shop</a>
                        </div>
                    </div>
                    <div>
                        <h3>About</h3>
                        <div class="footer-item">
                            <a href="../about.php">About Us</a>
                        </div>
                    </div>
                </div>
                <div>
                    <h3>Help</h3>
                    <div class="footer-item">
                        <a href="../appointment.php">Book an appointment</a>
                        <a href="../contact.php">Ask a question</a>
                    </div>
                </div>
                <div class="two-column">
                    <div>
                        <h3>Terms & Conditions</h3>
                        <div class="footer-item">
                            <a href="">Terms & Conditions</a>
                        </div>
                    </div>
                    <div>
                        <h3>Privacy Policy</h3>
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

</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerEmail = $_POST['email'];
    $customerPassword = $_POST['password'];    

    include '../db_connection.php';
    mysqli_select_db($con, 'User');
    $checkEmailQuery = "SELECT * FROM accounts WHERE Email = '$customerEmail'";
    $result = mysqli_query($con, $checkEmailQuery);
    // Check if the user is already logged in or blocked
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        echo "<script>
                alert('You are already logged in. Multiple logins are not allowed.');
                location.href='index.php';
            </script>";

    } else {
        if (empty($customerEmail) || empty($customerPassword)){
                echo "<script>
                    document.getElementById('error').style.display = 'flex';
                    document.getElementById('error').innerHTML = 'All fields are required. Please fill out the form completely.';
                </script>";        
        } else {
            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                if ($row['Status'] === 'Blocked' || $row['LoginAttempt'] >= 5){
                    $sql_block_account = "UPDATE accounts SET Status = 'Blocked' WHERE ID = " . $row['ID'];
                    mysqli_query($con, $sql_block_account);  
                    echo "<script>
                        document.getElementById('dark').style.display = 'flex';
                        document.getElementById('blocked').style.display = 'flex';
                    </script>";       
                } else if ($customerPassword === $row['Password']){
                    $_SESSION['user_id'] = $row['ID'];
                    $_SESSION['is_logged_in'] = true;
                    $resetLoginAttempt = "UPDATE accounts SET LoginAttempt = '0' WHERE ID = " . $row['ID'];
                    mysqli_query($con, $resetLoginAttempt);
                    echo "<script>
                        alert('Login Successfully!');
                        location.href='index.php';
                    </script>";   
                } else {
                    $login_attempts = $row['LoginAttempt'] + 1;
                    $sql_update_attempts = "UPDATE accounts SET LoginAttempt = $login_attempts WHERE ID = " . $row['ID'];
                    mysqli_query($con, $sql_update_attempts);   
                    echo "<script>
                        document.getElementById('email').value = '$customerEmail';
                        document.getElementById('password').value = '';
                        document.getElementById('error').style.display = 'none';
                        document.getElementById('passwordError').style.display = 'flex';
                        document.getElementById('passwordError').innerHTML = 'Incorrect Password. Please Try Again';
                    </script>"; 
                    if ($row['LoginAttempt'] >= 3){
                        echo "<script>
                            document.getElementById('dark').style.display = 'flex';
                            document.getElementById('forgotpassword').style.display = 'flex';
                        </script>"; 
                    } else if ($row['LoginAttempt'] >= 5){
                        $sql_block_account = "UPDATE accounts SET Status = 'Blocked' WHERE ID = " . $row['ID'];
                        mysqli_query($con, $sql_block_account);   
                        echo "<script>
                            document.getElementById('dark').style.display = 'flex';
                            document.getElementById('blocked').style.display = 'flex';
                            document.getElementById('email').value = '$customerEmail';
                            document.getElementById('password').value = '$customerPassword';
                            document.getElementById('error').style.display = 'flex';
                            document.getElementById('passwordError').style.display = 'none';
                            document.getElementById('error').innerHTML = 'Your account has been blocked.';
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
                            $customerName = $row['Name'];
                            $mail->setFrom($customerEmail, 'Eye Vision');
                            $mail->addAddress($customerEmail, $customerName);    
                            $mail->isHTML(true);                                 
                            $mail->Subject = 'Account temporarily blocked';
                            $mail->Body = "
                                    <h3>Hey $customerName,</h3>
                                    To protect your account from fraud, we have temporarily blocked it because we noticed some unusual activity. <br/>
                                    We know having your account blocked is frustrating, but we can help you get it back easily.<br/>
                                    <br/> To unblock your account click the link below<br/>
                                    <a href='http://localhost/optical/shop/unblock-account.php?userEmail=$customerEmail'>Unblock your account</a><br/>
                                    <br/> We take your account security seriously and need this step to help us prevent hackers from accessing your account.
                                    <br/><br/>
                                    Thanks, <br/> Eye Vision, your trusted eye clinic.";      
                            $mail->send();
                            echo 'Message has been sent';
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }               
                    }
                }
            } else {
                echo "<script>
                    document.getElementById('email').value = '$customerEmail';
                    document.getElementById('password').value = '$customerPassword';
                    document.getElementById('error').style.display = 'flex';
                    document.getElementById('error').innerHTML = 'User with this email does not exist';
                </script>";       
            }
        }
    }
}
?>