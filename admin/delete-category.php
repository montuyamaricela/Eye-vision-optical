<?php 
    session_start();
    
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false || empty($_SESSION) || empty($_SESSION['adminLoggedin'])) {
        echo "<script>
            location.href='login.php'
        </script>";
    }
    $ID = $_POST['delete'];
    $password = $_POST['adminPassword'];
    $adminPassword = "";
    
    include '../db_connection.php';
    $getAdminInfo = "SELECT * FROM user.admin WHERE ID = 1";
    $admin = mysqli_query($con, $getAdminInfo);
    if ($row = mysqli_fetch_array($admin)){        
        $adminPassword = $row['Password'];
    }

    if ($password === $adminPassword){
        $sqlDeleteCategory = "DELETE FROM product.category WHERE ID=$ID";
        mysqli_query($con, $sqlDeleteCategory);
        echo "<script>
            location.href='success-add-category.php';
        </script>";
    } else {
        echo "<script>
            alert('incorrect Password');
            location.href='products-category.php';
        </script>";    
    }
    
    mysqli_close($con);
?>