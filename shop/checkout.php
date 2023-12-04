<?php 
    session_start();
    $user_id = $_SESSION['user_id'];
    include '../db_connection.php';
    mysqli_select_db($con, 'user');
    $fetchInfo = "SELECT a.ID, a.Name, a.Email, a.Phone, a.Address, b.Status
        FROM user_info a
        JOIN accounts b ON a.ID = b.ID
        WHERE a.ID = '$user_id'";
    $userInfo = mysqli_query($con, $fetchInfo); 
    $userInfoStatus = mysqli_query($con, $fetchInfo);

    while ($row = mysqli_fetch_array($userInfoStatus)){
        if ($row['Status'] != "Verified"){
            echo "<script>
                alert('You need to verify your account first');
                location.href='index.php'
            </script>"; 
        }
    }
    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] != true) {
        echo "<script>
            alert('You need to login first');
            location.href='login.php'
        </script>";
    } else {
        if (isset($_POST['data'])) {
            $jsonData = $_POST['data'];
            $data = json_decode($jsonData, true);
            if ($data !== null) {
                // Initialize arrays for product IDs and quantities
                $productIds = [];
                $quantities = [];

                // Iterate through each item in the JSON data
                foreach ($data as $item) {
                    // Get product ID and quantity
                    $productId = $item['productId'];
                    $quantity = $item['quantity'];

                    // Store in respective arrays
                    $productIds[] = $productId;
                    $quantities[] = $quantity;
                }
                $idsToCheckout = implode(', ', array_map(fn($id) => "'$id'", $productIds));

                //$products = "SELECT * FROM cart WHERE Product_ID IN ($idsToCheckout)";
                $products = "Select Product_ID, Product_name,  Price, User_id, Stock from product.products a join user.cart b on a.ID = b.Product_ID WHERE b.User_id = '$user_id' AND Product_ID IN ($idsToCheckout)";
                $checkedoutItem = mysqli_query($con, $products);


            } else {
                echo "Invalid JSON format";
            }

        } else {
            echo "<script>
                history.back();
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>
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
    <link rel="stylesheet" href="../styles/cart.css?v=9" />

    <link rel="stylesheet" href="../styles/product.css?v=9" />

    <link rel="stylesheet" href="../styles/contactUs.css?v=2" />

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
        <div>
            <h2>Shopping Cart > Checkout</h2>
            <div class="checkout-container">
                <div class="shipping-address">
                    <h3>Shipping Address</h3>

                    <form action="">
                        <?php while ($row = mysqli_fetch_array($userInfo)) { ?>

                        <div class="two-column-input">
                            <div class="form-input">
                                <label for="name">Email Address </label>
                                <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>"
                                    required disabled />
                            </div>
                            <div class="form-input">
                                <label for="name">Phone </label>
                                <input type="number" id="phone" name="phone" value="<?php echo $row['Phone']; ?>"
                                    required />
                            </div>
                        </div>
                        <div class="form-input">
                            <label for="name">Full Name</label>
                            <input type="text" id="fullname" value="<?php echo $row['Name']; ?>" name="fullname"
                                required />
                        </div>

                        <div class="form-input">
                            <label for="name">Address</label>
                            <input type="text" id="Address" value="<?php echo $row['Address']; ?>" name="Address"
                                required />
                        </div>
                        <div class="form-input">
                            <label for="name">Add a note to your order:</label>
                            <textarea name="message" rows="7" id="message" name="message"></textarea>
                        </div>
                        <?php } ?>

                    </form>
                </div>
                <div class="summary-checkout">
                    <h2>Your Order</h2>
                    <div>
                        <table>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                            <?php 
                            $totalCheckout = 0; // Initialize totalCheckout variable

                            if(mysqli_num_rows($checkedoutItem) === 0){
                                echo " <div class='no-items'>
                                    <h2>Shopping Cart</h2>
                                    <div class='cart-card'>
                                        <p>No Item(s) in your shopping cart yet.</p>
                                    </div>
                                </div>";
                            } else { ?>
                            <?php while ($row = mysqli_fetch_array($checkedoutItem)){
                                $index = array_search($productId, $productIds);
                                $quantity = ($index !== false) ? $quantities[$index] : 0;
                                $totalPrice = $row['Price'] * $quantity;
                                $totalCheckout += $totalPrice;

                                ?>
                            <tr>
                                <td><?php echo $row['Product_name']?></td>
                                <td><?php echo $quantity ?></td>
                                <td><?php echo $totalPrice?></td>
                            </tr>
                            <?php }}
                            // Add the shipping fee
                            
                            ?>
                            <!-- <tr class="totalOrder">
                                <td colspan=2>Total</td>
                                <td><?php echo $totalCheckout?></td>
                            </tr> -->
                        </table>

                    </div>
                    <div class="divider-checkout"></div>

                    <div class="paymentoption">
                        <p class="detail-gray">Payment option:</p>
                        <button class="" disabled>Cash on delivery</button>
                    </div>
                    <div class="divider-checkout"></div>
                    <div class="price-checkout">
                        <div>
                            <p class="detail-gray">Shipping Fee:</p>
                            <p class="detail-black">₱200.00</p>
                        </div>
                        <div class="checkout-total">
                            <p class="detail-gray">Total:</p>
                            <p class="detail-black total-checkout">₱<?php echo $totalCheckout + 200?>
                            </p>
                        </div>
                    </div>

                    <div class=" checkout-button">
                        <!-- <form>
                            <input type='text' hidden name='id' id='id' value='$ID'>
                            <input type='text' hidden name='product_name' value='$ProdName'>

                            <input type='text' hidden name='quantity' id='quantityTotal'>
                            <input type='text' hidden name='grandTotal' id='grandTotal'>
                            <button>Place your order</button>

                        </form> -->
                        <button onclick="placeOrder()">Place your order</button>

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

    <script src="../javascript/checkout.js?v=2"></script>
    <script src=" ../javascript/global.js?v=2"></script>



</body>

</html>


<?php 
    
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