<?php 
    session_start(); 
    include '../db_connection.php';
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === FALSE || empty($_SESSION)) {
        echo "<script>
            alert('You must logged in before accessing the page!');
            location.href='login.php'
        </script>";
    } else if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        $user_id = $_SESSION['user_id'];
    } 
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
    <link rel="stylesheet" href="../styles/contactUs.css?v=2" />

    <!-- global styles/css -->
    <link rel="stylesheet" href="../styles/global.css?v=2" />
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


    <section id="dark" class="bg-dark"></section>
    <section id="sent" class="sent">
        <div class="content">
            <div>
                <img src="public/images/icons/mail.png" alt="mail">
            </div>
            <!-- <p>Thanks for contacting us! We will get in touch with you shortly.</p> -->
            <p id="message" class="popupMessage"></p>
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
                <h2 class="section-title">Set An Appointment</h2>
                <div class="contact-box">
                    <p>We will confirm your appointment schedule via email within 1-3 business days.</p>
                    <p>Thank you for trusting Eye Vision for your eye care & treatment needs.</p>
                </div>
            </div>
            <div>
                <form name="appointmentForm" action="sendAppointment.php" method="POST">
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
                <div class="footer-logo">
                    <a href="index.php">
                        <img src="../public/images/logo/logo-no-bg.png" alt="" width="150">
                    </a>
                </div>
                <div class="two-column">
                    <div>
                        <h3>Products</h3>
                        <div class="footer-item">
                            <a href="index.php">Shop</a>
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
                        <a href="appointment.php">Book an appointment</a>
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
    <script src="javascript/global.js"></script>

</body>

</html>

<?php 
    
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        $user_id = $_SESSION['user_id'];
        echo $user_id;
        mysqli_select_db($con, 'user');
        $sql = "SELECT a.ID, a.Name, a.Email, a.Phone, a.Address, a.Avatar,b.Password, b.Status
			FROM user_info a, accounts b
			WHERE a.ID & b.ID = '$user_id'" ;
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $Profile = $row['Avatar'];
            $name = $row['Name'];
            if (!$row['Avatar']){
                $first_character = substr($name, 0, 1);
                echo "<script>
                    document.getElementById('iconSvg').style.display='none';
                    document.getElementById('userName').innerHTML = '$first_character';
                    document.getElementById('userName').style.display='block';
                    document.getElementById('navImage').style.display='block';
                </script>";
            } else {
                echo "<script>
                    document.getElementById('iconSvg').style.display='none';
                    document.getElementById('userName').style.display='none';
                    document.getElementById('navbarProfile').style.display='block';
                    const navProfile = document.getElementById('navImage').querySelector('img');
                    document.getElementById('navImage').style.display='block';
                    navProfile.src = '../public/images/$Profile'
                </script>";
            }
            echo "<script>
                document.getElementById('user').innerHTML = '$name';
                document.getElementById('op1').style.display='none';
                document.getElementById('op2').style.display='block';
            </script>";
        }
 
    }


?>