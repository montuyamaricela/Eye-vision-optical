<?php
session_start();
include '../db_connection.php';
mysqli_select_db($con, 'product');

if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    $user_id = $_SESSION['user_id'];
} 

// else {
//     echo "<script>
//         alert('You must logged in before accessing the page!');
//         location.href='login.php'
//     </script>";
// }



$filter_category = isset($_GET['category']) ? $_GET['category'] : '';
$limit = 6;

if (isset($_GET['page'])) {
    $page_number = $_GET['page'];
} else {
    $page_number = 1;
}

$initial_page = ($page_number - 1) * $limit;

$sql = "SELECT * FROM products";

// Add condition to filter by category if specified in the URL
if (!empty($filter_category) && $filter_category !== 'Accessories') {
    $sql .= " WHERE Category = '$filter_category'";
} elseif ($filter_category === '') {
    // Exclude products with 'Accessories' category
    $sql .= " WHERE Category != 'Accessories'";
}

$sql .= " LIMIT $initial_page, $limit";


$result = mysqli_query($con, $sql);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Virtual Try On</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- global styles/css -->
    <link rel="stylesheet" href="../styles/global.css?v=4" />

    <!-- product styles/css -->
    <link rel="stylesheet" href="../styles/virtual-try-on.css?v=8" />
</head>

<body>
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
                            echo "<img src='../public/images/$image' alt='Logo' height='85px' width='85px'>";
                        }
                    ?>
                </a>
            </div>
            <div class="nav-items">
                <div class="dropdown">
                    <a>Products</a>
                    <div class=" dropdown-content">
                        <?php
                            mysqli_select_db($con, 'product');
                            $sql = "SELECT * FROM Category";
                            $res = mysqli_query($con, $sql);
                
                            while ($row = mysqli_fetch_array($res)){
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
                        <span id="cartnumber" style="display:none" class="item-number"></span>
                    </a>
                    <a href="wishlist.php" class="dropbtn wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="#5775B7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        <span id="wishlistnumber" style="display:none" class="item-number"></span>
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
                                <a href='orders.php'>My Orders</a>

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

    <section class="virtual-try-on-container">
        <h2 class="dark-text">Virtual Try On</h2>

        <div class="try-on-container">

            <!-- image -->
            <div>
                <div class="left-side">
                    <div id="user-camera" class="user-camera">
                        <video id="videoCam"></video>
                    </div>
                    <div class="user-image" id="user-image">
                        <img src="../public/images/upload-image.jpg" id="try-on-image" alt="Image">
                    </div>
                    <div class="dragmeDiv">
                        <div class="resizable">
                            <img src="#" id="try-item" class="dragme" alt="item">
                        </div>
                    </div>
                    <div class="use-camera" onclick="openCam()">
                        <svg xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#172B4D" width="24">
                            <path stroke-linecap=" round" stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                        </svg>
                    </div>
                    <div class="upload-image" id="upload-image" onclick="displayImage()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="#172B4D" width="24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        <input type="file" class="upload" name="image" accept="image/png, image/gif, image/jpeg">
                    </div>
                </div>
            </div>
            <div class="right-side">
                <div class="filters">
                    <?php
                        if ($filter_category === ''){
                            echo "<a href='virtual-try-on.php' class='filter-item-active'>All</a>";
                        } else {
                            echo "<a href='virtual-try-on.php'>All</a>";

                        }
                    ?>
                    <?php
                        $sql = "SELECT * FROM Category";
                        $res = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($res)){
                                if ($row['Category_name'] != 'Accessories') {
                                    $category = $row['Category_name'];
                                    if ($filter_category === $category){
                                        echo "<a class='filter-item-active' data-category='$category'>$category</a>";
                                    } else {
                                        echo "<a class='filter-item' data-category='$category'>$category</a>";

                                    }

                                }
                            }
                        ?>
                </div>
                <div class="item-container">
                    <div class="items">
                        <?php if (mysqli_num_rows($result) == 0){
                            echo "<h2 class='dark-text'>No Products Available</h2>";
                        }
                        ?>
                        <?php while ($row = mysqli_fetch_array($result)){ ?>
                        <div class="item" onclick="getImageSrc(this)">
                            <div class=" product-image">
                                <img id="product-image" src="../public/images/<?php echo $row['Image']?>"
                                    alt="<?php echo $row['Name']?>" height="120" width="120"/>
                            </div>
                            <div>
                                <h3 class="dark-text"><?php echo $row['Name']?></h3>
                            </div>
                        </div>
                        <?php } ?>
                    </div>


                </div>


            </div>

        </div>

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

    <script src="../javascript/virtual-try-on.js?v=5"></script>
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

    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        include '../db_connection.php';
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
                    navProfile.src = '../public/images/$Profile';
                    document.getElementById('try-on-image').src = '../public/images/$Profile'
                </script>";
            }
            echo "<script>
                document.getElementById('user').innerHTML = '$name';
                document.getElementById('op1').style.display='none';
                document.getElementById('op2').style.display='block';
            </script>";
        }
        $cart = "SELECT COUNT(*) AS totalItems FROM cart WHERE User_id = '$user_id'";
        $cartResult = mysqli_query($con, $cart);
        if ($cartResult) {
            // Fetch the result as an associative array
            $row = mysqli_fetch_assoc($cartResult);
            // Access the totalItems value
            $totalItems = $row['totalItems'];
            if ($totalItems != 0){
                // Output the total number of items
                echo "<script>
                    document.getElementById('cartnumber').style.display = 'block';
                    document.getElementById('cartnumber').innerHTML = $totalItems;
                </script>" ;
            }               
        }
        $wishlist = "SELECT COUNT(*) AS totalItems FROM wishlist WHERE User_id = '$user_id'";
        $wishlistResult = mysqli_query($con, $wishlist);
        if ($wishlistResult) {
            // Fetch the result as an associative array
            $row = mysqli_fetch_assoc($wishlistResult);
            // Access the totalItems value
            $totalItems = $row['totalItems'];
            if ($totalItems != 0){
                // Output the total number of items
                echo "<script>
                    document.getElementById('wishlistnumber').style.display = 'block';
                    document.getElementById('wishlistnumber').innerHTML = $totalItems;
                </script>" ;
            }               
        }
 
    } else {
        echo "<script>
            document.getElementById('wishlistnumber').style.display='none';
            document.getElementById('cartnumber').style.display='none';
        </script>" ;
    }


?>