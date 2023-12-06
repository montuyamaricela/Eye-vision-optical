<?php 
    session_start();
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === FALSE || empty($_SESSION)) {
        echo "<script>
            location.href='index.php'
        </script>";
    } 
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        $user_id = $_SESSION['user_id'];
    } 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Account</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- account styles/css -->
    <link rel="stylesheet" href="../styles/account.css?v=27" />

    <!-- global styles/css -->
    <link rel="stylesheet" href="../styles/global.css?v=6" />
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

    <section style="padding: 40px;" class="container">
        <h2 class="title">My Account</h2>
        <form action="my-account.php" enctype="multipart/form-data" method="POST">
            <div class="profile">
                <div class="profileCard">
                    <h3 class="header">USER INFORMATION</h3>
                    <div>
                        <div action="" class="profileForm">
                            <div class="profilepic">
                                <!-- kapag walang laman or image eto dapat lalabas -->
                                <div class="svg-circle" id="profileIcon">
                                    <svg width="100" height="100" viewBox="0 0 24 24" fill="white"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                            stroke="none" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>
                                        <path
                                            d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                            stroke="none" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>
                                    </svg>
                                    <!-- <input type="file" name="image"> -->
                                </div>

                                <!-- kapag may image, ito na dapat lalabas -->
                                <div class="circle" id="profileImage">
                                    <img src="#" alt="Profile Picture" title="profile" class="profilePhoto" width="100"
                                        height="100">
                                </div>
                                <input type="file" name="image">

                            </div>
                            <div class="form-input">
                                <label> Full Name </label>
                                <input type="text" placeholder="name" name="fullName" id="name" />
                            </div>

                            <div class="form-input">
                                <label>Phone</label>
                                <input type="text" id="phoneNumber" name="phone" required />
                            </div>

                            <div class="form-input">
                                <label>Address</label>
                                <input type="text" id="address" name="address" required />
                            </div>
                            <div class="form-input">
                                <label for="status">Status</label>
                                <input type="text" id="status" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profileCard">
                    <h3 class="header">Forgot password</h3>
                    <div>
                        <div action="" class="profileForm">
                            <div class="form-input">
                                <label>Email Address</label>
                                <input type="email" placeholder="Email" id="emailAddress" name="emailAddress"
                                    disabled />
                            </div>
                            <div class="form-input">
                                <p class="error" id="errorOldPassword">Old password does not match with the old password
                                </p>

                                <label>Old Password</label>
                                <input type="password" name="oldPassword" minlength="8" placeholder="password"
                                    id="oldPassword" />
                            </div>

                            <div class="form-input">

                                <label>New Password</label>
                                <input type="password" placeholder="New Password" minlength="8" name="newPassword"
                                    id="newPassword" />
                            </div>

                            <div class="form-input">
                                <p class="error" id="error">Password does not match. Please Try Again</p>

                                <label>Confirm Password</label>
                                <input type="password" placeholder="Confirm Password" minlength="8" id="confirmPassword"
                                    name="confirmPassword" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="save">Save</button>

        </form>

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

    <script src="../javascript/profile.js"></script>
</body>

</html>

<?php 
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        // $email = $_SESSION['email'];
        $ID = $_SESSION['user_id'];
        include '../db_connection.php';
        mysqli_select_db($con, 'User');
        $sql = "SELECT a.ID, a.Name, a.Email, a.Phone, a.Address, a.Avatar, b.Password, b.Status
                    FROM user_info a
                    JOIN accounts b ON a.ID = b.ID
                    WHERE a.ID = '$ID'";
        $result = mysqli_query($con, $sql);
        
        
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $name = $row['Name'];
            $email = $row['Email'];
            $phone = $row['Phone'];
            $address = $row['Address'];
            $status = $row['Status'];
            $oldPassword = $row['Password'];
            $Profile = $row['Avatar'];
            echo "<script>
                document.getElementById('name').value = '$name'
                document.getElementById('emailAddress').value = '$email'
                document.getElementById('phoneNumber').value = '$phone'
                document.getElementById('address').value = '$address'
                document.getElementById('status').value = '$status'
            </script>";
            if (!$row['Avatar']){
                $first_character = substr($name, 0, 1);

                echo "<script>
                    document.getElementById('profileIcon').style.display='block';
                    document.getElementById('profileImage').style.display='none';
                    document.getElementById('iconSvg').style.display='none';
                    document.getElementById('userName').innerHTML = '$first_character';
                    document.getElementById('userName').style.display='block';
                    document.getElementById('navImage').style.display='block';
                    </script>";
            } else {
                echo "<script>
                    document.getElementById('profileIcon').style.display='none';
                    document.getElementById('profileImage').style.display='block';
                    const image = document.getElementById('profileImage').querySelector('img');
                    image.src = '../public/images/$Profile'
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

            if ($_SERVER["REQUEST_METHOD"] == 'POST'){
                $name = $_POST['fullName'];
                $phoneNumber = $_POST['phone'];
                $address = $_POST['address'];
                $oldPass = $_POST['oldPassword'];
                $newPassword = $_POST['newPassword'];
                $confirmPassword = $_POST['confirmPassword'];
		        $imageName = $_FILES['image']['name'];
		        $tmp_name=$_FILES['image']['tmp_name'];

                if($imageName){
			        $location = "userProfile/$imageName";
			        $destination = "../public/images/$location";
			        move_uploaded_file($tmp_name,$destination);
			        $query = mysqli_query($con, "UPDATE user_info set Avatar='$location' where Email='$email'");
                } 
                
                $updateInfo = "UPDATE user_info set Name = '$name', Phone = '$phoneNumber', Address = '$address' Where Email = '$email'";
                $queryInfo = mysqli_query($con, $updateInfo);
                
                $updateInfo_2 = "UPDATE accounts set Name = '$name'";
                $queryInfo_2 = mysqli_query($con,  $updateInfo_2);
                
                if ($oldPass != '' || $newPassword != '' || $confirmPassword != ''){
                    if ($oldPass === $oldPassword){
                        if ($newPassword === $confirmPassword){
                            $updatePassword = "UPDATE accounts set Password='$newPassword' where Email='$email'";
                            $query = mysqli_query($con, $updatePassword);
                            echo "<script>
                                location.href='my-account.php';
                                alert('Successfully changed Information!')
                            </script>";

                        } else {
                        echo "<script>
                            document.getElementById('oldPassword').value='$oldPass'
                            document.getElementById('newPassword').value='$newPassword'
                            document.getElementById('confirmPassword').value='$confirmPassword'
                            document.getElementById('error').style.display='block'
                            document.getElementById('errorOldPassword').style.display='none'

                        </script>";
                        }
                    } else {
                        echo "<script>
                         
                            document.getElementById('errorOldPassword').style.display='block'
                        </script>";
                    }
                } else {
                    echo "<script>
                        location.href='my-account.php';
                        alert('Successfully changed Information!')
                    </script>";
                }

                mysqli_close($con);
            }
            
        } else {
            echo "No account exist";
        }
    } 
        
    
?>