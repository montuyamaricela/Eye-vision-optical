<?php
    session_start();
    
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false) {
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

    $sql = "DELETE FROM products WHERE ID IN ($idsToDelete)";
    if(mysqli_query($con, $sql)){
        echo "<script>
            location.href='success-add-product.php';
        </script>";
    }
    mysqli_close($con);

}
?>