<?php
session_start();
include '../db_connection.php';
mysqli_select_db($con, 'product');

if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        $user_id = $_SESSION['user_id'];
} 


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
if (!empty($filter_category)) {
    $sql .= " WHERE Category = '$filter_category'";
}

// Add conditions to filter by price range
if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
    $min_price = $_GET['min_price'];
    $max_price = $_GET['max_price'];

    // Check if a WHERE clause is already present, if not, add WHERE, otherwise add AND
    $sql .= (!empty($filter_category)) ? " AND" : " WHERE";
    $sql .= " Price BETWEEN $min_price AND $max_price";
}  else if (isset($_GET['min_price']) && !isset($_GET['max_price'])){
    $min_price = $_GET['min_price'];
    $sql .= (!empty($filter_category)) ? " AND" : " WHERE";
    $sql .= " Price >= $min_price";
}


// Add condition to filter by color if specified in the URL
if (isset($_GET['color'])) {
    $color = $_GET['color'];

    // Check if a WHERE clause is already present, if not, add WHERE, otherwise add AND
    $sql .= (!empty($filter_category) || isset($_GET['min_price'])) ? " AND" : " WHERE";
    $sql .= " Color = '$color'";
}

$sql .= " LIMIT $initial_page, $limit";

$result = mysqli_query($con, $sql);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products</title>
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
    <link rel="stylesheet" href="../styles/product.css?v=5" />
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
                            <p id="user">My Account</p>
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

    <section class="product-container">
        <div class="product-content">
            <div class="sidebar">

                <div class="sidebar-item">
                    <div onclick="filterHandler(this)" class="category">
                        <h2 class="dark-text">Price range</h2>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" fill="currentColor"
                                stroke-width="1.5">
                                <path fill-rule="evenodd"
                                    d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="category-items" id="category-items">
                        <a href="products.php?category=<?php echo $filter_category; ?>">Reset</a>
                        <a href="products.php?min_price=0&max_price=500&category=<?php echo $filter_category; ?>">₱0 -
                            ₱500</a>
                        <a href="products.php?min_price=501&max_price=1000&category=<?php echo $filter_category; ?>">₱501
                            - ₱1000</a>
                        <a href="products.php?min_price=1001&max_price=2000&category=<?php echo $filter_category; ?>">₱1,001
                            - ₱2,000</a>
                        <a href="products.php?min_price=2001&category=<?php echo $filter_category; ?>">₱2,001 and
                            above</a>
                    </div>
                </div>
                <div class="sidebar-item">
                    <div onclick="filterHandler(this)" class="category">
                        <h2 class="dark-text">Color</h2>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" fill="currentColor"
                                stroke-width="1.5">
                                <path fill-rule="evenodd"
                                    d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="category-items-long" id="category-items">
                        <a href="products.php?category=<?php echo $filter_category; ?>">All</a>
                        <a href="products.php?color=Black&category=<?php echo $filter_category; ?>">Black</a>
                        <a href="products.php?color=Silver&category=<?php echo $filter_category; ?>">Silver</a>
                        <a href="products.php?color=Pink&category=<?php echo $filter_category; ?>">Pink</a>
                        <a href="products.php?color=Gold&category=<?php echo $filter_category; ?>">Gold</a>
                        <a href="products.php?color=Brown&category=<?php echo $filter_category; ?>">Brown</a>
                        <a href="products.php?color=Green&category=<?php echo $filter_category; ?>">Green</a>
                        <a href="products.php?color=Red&category=<?php echo $filter_category; ?>">Red</a>
                        <a href="products.php?color=Orange&category=<?php echo $filter_category; ?>">Orange</a>
                        <a href="products.php?color=Clear/white&category=<?php echo $filter_category; ?>">
                            Clear/white
                        </a>

                        <!-- Add more color options as needed -->
                    </div>
                </div>

            </div>

            <div class="products">
                <div class="product-items-container">
                    <div class="product-items">
                        <?php if (mysqli_num_rows($result) == 0){
                            echo "<h2 class='dark-text'>Products Not Found/unavailable</h2>";
                        }
                        ?>
                        <?php while ($row = mysqli_fetch_array($result)){ 
                            $categ = $row['Category']
                            ?>
                        <!-- <a href="<products.php" class="product-item"> -->
                        
                        <a href="item.php?product-id=<?php echo $row['ID']?>" class="product-item">
                            <div class=" product-image">
                                <?php
                                    if ($categ === 'Contact Lenses') {
                                        echo "<img src='../public/images/products/Contactlens.jpeg' alt='Contact Lens' height='220'/>";
                                    } else { ?>
                                        <img src="../public/images/<?php echo $row['Image']?>" alt="<?php echo $row['Name']?>"
                                        height="220" />
                                    <?php } ?>
                            </div>
                            <div class="product-details">
                                <h3 class="dark-text"><?php echo $row['Name']?></h3>
                                <p>₱<?php echo $row['Price']?></p>
                            </div>
                        </a>
                        <?php } ?>

                    </div>
                </div>

                <div class="pagination">
                    <div>
                        <?php
                            $getQuery = "SELECT COUNT(*) FROM products WHERE Category = '$filter_category'";
                            $result = mysqli_query($con, $getQuery);
                            $row = mysqli_fetch_row($result);
                            $total_rows = $row[0];
                            echo '<br>';
                            // get the required number of pages
                            $total_pages = ceil($total_rows / $limit);
                            $pageURL = '';
            
                            if ($page_number >= 2) {
                                echo "<a href='products.php?category=$filter_category&page=" . ($page_number - 1) . "'> Prev </a>";
                            }

                            for ($curpage = 1; $curpage <= $total_pages; $curpage++) {
                                if ($curpage == $page_number) {
                                    $pageURL .= "<a class='active' href='products.php?category=$filter_category&page=" . $curpage . "'>" . $curpage . ' </a>';
                                } else {
                                    $pageURL .= "<a href='products.php?category=$filter_category&page=" . $curpage . "'>" . $curpage . ' </a>';
                                }
                            }

                            echo $pageURL;

                            if ($page_number < $total_pages) {
                                echo "<a href='products.php?category=$filter_category&page=" . ($page_number + 1) . "'> Next </a>";
                            }
                        ?>
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

    <script src="../javascript/displayContent.js"></script>
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
                    navProfile.src = '../public/images/$Profile'
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