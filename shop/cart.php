<?php 
    session_start();
    $user_id = $_SESSION['user_id'];
    include '../db_connection.php';
      if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] != true || empty($_SESSION)) {
        echo "<script>
            alert('You need to login first');
            location.href='login.php'
        </script>";
    } 
    mysqli_select_db($con, 'user');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $jsonData = $_POST['item-data'];
        $data = json_decode($jsonData, true);
        $productsToDelete = implode(', ', array_map(fn($id) => "'$id'", $data));
        echo $productsToDelete;

        // $id = $_POST['prodid'];
        $removeCartItem = "DELETE FROM cart WHERE Product_ID in ($productsToDelete)";
        if(mysqli_query($con, $removeCartItem)){
            echo "<script>
                alert('Successfully Removed!')
                location.href='cart.php'
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Cart</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700&family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- global styles/css -->
    <link rel="stylesheet" href="../styles/global.css?v=2" />

    <!-- cart page styles/css -->
    <link rel="stylesheet" href="../styles/cart.css?v=8" />

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
                    ?> </a>
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
                            <p id="user">My Account</p>
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

    <section class="">
        <div class="">
            <?php
                $checkCart = "Select Product_ID, Product_name, Category ,Color, Image, Price, Quantity, User_id, Stock from product.products a join user.cart b on a.ID = b.Product_ID WHERE b.User_id = '$user_id'";
                $res = mysqli_query($con, $checkCart);
            ?>
            <?php if(mysqli_num_rows($res) === 0){
                echo " <div class='no-items'>
                            <h2 class='dark-text'>Shopping Cart</h2>
                            <div class='cart-card'>
                            <p>No Item(s) in your shopping cart yet.</p>
                        </div>
                        </div>";
            } else { ?>
            <div class="cart-container">
                <div class="cart-products">
                    <div class="cart-actions">
                        <div class="selectAll">
                            <input type="checkbox" id="header-checkbox">
                            <p class="selectAllP">Select All Products</p>
                        </div>
                        <div>
                            <form action="cart.php" id="delete-item" method="POST">
                                <input type="hidden" id="item-data" name="item-data" value="">
                            </form>
                            <button class="deleteCart" onclick="deleteProducts()">Delete</button>

                        </div>
                    </div>
                    <form action="checkout.php" method="POST" id="checkoutItems">
                        <input type="hidden" id="data-field" name="data" value="">

                        <?php while ($row = mysqli_fetch_array($res)) { ?>
                        <div class="product cart-items">
                            <div class="card-item">
                                <input type="checkbox" class="data-checkbox"
                                    data-id="<?php echo $row['Product_ID']; ?>">

                                <!-- The div with the class remove-cart is removed -->

                                <div class="card-image">
                                    <?php
                                        $product_image = $row['Image'];
                                        $categ = $row['Category'];
                                                
                                        if ($categ === 'Contact Lenses') {
                                            echo "<img src='../public/images/products/Contactlens.jpeg' alt='Contact Lens' height='150'/>";
                                        } else {
                                            echo "<img src='../public/images/$product_image' height='150px'></img>";
                                        }
                                    ?>
                                </div>
                                <div class="cart-detail">
                                    <h2 class="dark-text"><?php echo $row['Product_name']; ?></h2>
                                    <input type="text" id="idCart" value="<?php echo $row['Product_ID']; ?>" hidden>
                                    <div>
                                        <p class="detail-gray">Color:</p>
                                        <div class="row-item">
                                            <p class="detail-black"><?php echo $row['Color']; ?></p>
                                            <p class="detail-black initial-price"><?php echo "₱" . $row['Price']; ?></p>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="detail-gray">Quantity:</p>

                                        <div class="row-item">
                                            <div class="quantity-counter">
                                                <span style="cursor: pointer" id="minus-button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="#3f61ad"
                                                        height="20px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M18 12H6" />
                                                    </svg>
                                                </span>
                                                <input type="number" class="quantity-input" id="quantity"
                                                    name="quantity" value="<?php echo $row['Quantity']; ?>"
                                                    max="<?php echo $row['Stock']; ?>" onkeydown="disableEnterNumber()">
                                                <span style="cursor: pointer" id="add-button">
                                                    <svg xmlns=" http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="#3f61ad"
                                                        height="20px">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v12m6-6H6" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div>
                                                <p class="detail-gray" id="grand-total"> Grand Total:
                                                    <span
                                                        class="detail-black grand-total"><?php echo "₱" . $row['Price']; ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="divider"></div>

                    </form>
                </div>
                <?php if(mysqli_num_rows($res) != 0){ ?>

                <div class="summary">
                    <h2 class="dark-text">Cart Summary</h2>
                    <div class="total">
                        <p class="detail-gray">Grand Total</p>
                        <p class="detail-black" id="allTotal">₱000.00</p>
                    </div>
                    <div class="cart-button">
                        <button onclick="checkoutProducts()">Checkout</button>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php }?>
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

    <script src="../javascript/cart.js?v=32"></script>
    <script src="../javascript/global.js?v=2"></script>



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