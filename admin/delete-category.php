<?php 
    session_start();
    
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false) {
        echo "<script>
            location.href='login.php'
        </script>";
    } 
    $ID = $_GET['id'];

    include '../db_connection.php';
    mysqli_select_db($con, 'product');
    
    $checkCategory = "SELECT * FROM category WHERE ID = '$ID'";
    $result = mysqli_query($con, $checkCategory);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $sqlDeleteCategory = "DELETE FROM category WHERE ID=$ID";
        mysqli_query($con, $sqlDeleteCategory);
        $categoryName = $row['Category_name'];
        // echo $categoryName;
    }
    // $sqlDeleteAccountInfo = "DELETE FROM user_info WHERE id=$ID";

    echo "<script>
            location.href='success-add-category.php';
        </script>";
    mysqli_close($con);
?>