<?php
    session_start();
    include '../db_connection.php';
    date_default_timezone_set("Asia/Manila");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $min = 1000000000; // 10-digit number
        $max = 9999999999; // 10-digit number
        $orderID = random_int($min, $max);
        if (isset($_POST['data'])) {
            $jsonData = $_POST['data'];
            $data = json_decode($jsonData, true);
            // echo $jsonData;
            if ($data != null) {
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
                // $idsToAdd = implode(', ', array_map(fn($id) => "'$id'", $productIds));
                // echo $idsToAdd;
                $numItems = count($productIds);
            for ($i = 0; $i < $numItems; $i++) {
                $productId = $productIds[$i];
                $quantity = $quantities[$i];
                $price;
                // echo $quantity;
                mysqli_select_db($con, 'product');
                // get the product name to the products table
                $getName = "SELECT Name, Stock, Price FROM products WHERE ID = '$productId'";
                $result = mysqli_query($con, $getName);
                $productName;
                $stock;
                while ($row = mysqli_fetch_array($result)){
                    $productName = $row['Name'];
                    $stock = $row['Stock'];
                    $price = $row['Price'];
                }
                $totalPrice = $price * $quantity;
                
                
            
                mysqli_select_db($con, 'user');

                // Insert data into the 'orders' table
                $addOrder = "INSERT INTO orders (OrderID, Product_ID, Product_name ,Quantity, Price, User_id, User_email, User_name, Phone, Address, Note, Status) 
                    VALUES ('$orderID', '$productId', '$productName', '$quantity', '$totalPrice', '-', '-', 'Walk-in-customer', '-', '-', '-', 'Order Pending')";
                if(mysqli_query($con, $addOrder)){
                    echo "<script>
                        alert('Receipt printed!');
                        location.href='point-of-sales.php';
                    </script>";

                    mysqli_select_db($con, 'product');
                    $updatedStock = $stock - 1;
                    $updateStock = "UPDATE products SET Stock = $updatedStock WHERE ID = '$productId'";
                    mysqli_query($con, $updateStock);
                }


        }
            } else {
                echo "Invalid JSON format";
            }
        }
    }

?>