<?php
    session_start();
    $user_id = $_SESSION['user_id'];
    include '../db_connection.php';
    date_default_timezone_set("Asia/Manila");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ids = $_POST['ids'];
        $quantities = $_POST['quantities'];
        $totalPrices = $_POST['totalPrices'];
        $userEmail = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['message'];

        $date = date("Y-m-d h:i:s");
        $min = 1000000000; // 10-digit number
        $max = 9999999999; // 10-digit number
        $orderID = random_int($min, $max);

        $numItems = count($ids);
        for ($i = 0; $i < $numItems; $i++) {
            $productId = $ids[$i];
            $quantity = $quantities[$i];
            $totalPrice = $totalPrices[$i];
            echo $productId . $quantity . $totalPrice;

            mysqli_select_db($con, 'product');
            // get the product name to the products table
            $getName = "SELECT Name, Stock FROM products WHERE ID = '$productId'";
            $result = mysqli_query($con, $getName);
            $productName;
            $stock;
            while ($row = mysqli_fetch_array($result)){
                $productName = $row['Name'];
                $stock = $row['Stock'];
                
            }

            
            mysqli_select_db($con, 'user');

            // Insert data into the 'orders' table
            $addOrder = "INSERT INTO orders (OrderID, Product_ID, Product_name ,Quantity, Price, User_id, User_email, User_name, Phone, Address, Note, Status) 
                VALUES ('$orderID', '$productId', '$productName', '$quantity', '$totalPrice', '$user_id', '$userEmail', '$name', '$phone', '$address', '$note', 'Order Pending')";
            if(mysqli_query($con, $addOrder)){
                echo "<script>
                    location.href='order-track.php?order-id=$orderID'
                </script>";

                mysqli_select_db($con, 'product');
                $updatedStock = $stock - 1;
                $updateStock = "UPDATE products SET Stock = $updatedStock WHERE ID = '$productId'";
                mysqli_query($con, $updateStock);
            }

            // remove the checked out item to the cart
            mysqli_select_db($con, 'user');

            $deleteItemFromCart = "DELETE FROM cart WHERE Product_ID = '$productId'";
            mysqli_query($con, $deleteItemFromCart);
    }
        
    }
?>