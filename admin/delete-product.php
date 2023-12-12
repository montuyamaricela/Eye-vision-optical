<?php
    session_start();
    
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false || empty($_SESSION) || empty($_SESSION['adminLoggedin'])) {
        echo "<script>
            location.href='login.php'
        </script>";
    }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../db_connection.php';
    mysqli_select_db($con, 'product');

    $jsonData = $_POST['data'];
    $ids = json_decode($jsonData, true);
 
    $idsToDelete = implode(', ', array_map(fn($id) => "'$id'", $ids));
    $password = $_POST['adminPassword'];
    $adminPassword = "";
    include '../db_connection.php';
    mysqli_select_db($con, 'User');
    $getAdminInfo = "SELECT * FROM user.admin WHERE ID = 1";
    $admin = mysqli_query($con, $getAdminInfo);
    if ($row = mysqli_fetch_array($admin)){        
        $adminPassword = $row['Password'];
    }

    if ($password === $adminPassword){
        $sql = "DELETE FROM product.products WHERE ID IN ($idsToDelete)";
        mysqli_query($con, $sql);
        echo "<script>
            location.href='success-add-product.php';
        </script>";
    } else {
        echo "<script>
            alert('incorrect Password');
            location.href='products.php';
        </script>";    
    }

    mysqli_close($con);

}
?>