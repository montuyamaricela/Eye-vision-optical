<?php 
    session_start();
    include '../db_connection.php';

    if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        $user_id = $_SESSION['user_id'];
        $loggedIn = true;
    } else {
        $loggedIn = false;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        $prodid = $_POST['id'];
        $prodname = $_POST['product_name']; 
        
        mysqli_select_db($con, 'user');

        // Check if the product already exists in the cart
        $checkProductQuery = "SELECT * FROM wishlist WHERE Product_ID = '$prodid' AND User_id = '$user_id'";
        $checkProductResult = mysqli_query($con, $checkProductQuery);

        if (mysqli_num_rows($checkProductResult) === 0) {
            $addWishlist = "INSERT INTO wishlist (Product_ID, Product_name, User_id)
                VALUES ('$prodid', '$prodname','$user_id')";
            mysqli_query($con, $addWishlist);
        } else {
                echo "<script>
                alert('Product is already in your wishlist');
                location.href='wishlist.php'
            </script>";
        }

            echo "<script>
            alert('successfully added to your wishlist!');
            location.href='wishlist.php'
        </script>";  
    } else {
        echo "<script>
            history.back();
        </script>";
    }
    
    
?>