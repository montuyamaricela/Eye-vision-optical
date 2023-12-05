<?php 
    session_start();
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false || empty($_SESSION) || empty($_SESSION['adminLoggedin'])) {
        echo "<script>
            location.href='login.php'
        </script>";
    }
    $ID = $_GET['id'];

    include '../db_connection.php';
    mysqli_select_db($con, 'User');
    
    $sqlDeleteAccount = "DELETE FROM accounts WHERE id=$ID";
    $sqlDeleteAccountInfo = "DELETE FROM user_info WHERE id=$ID";

    mysqli_query($con, $sqlDeleteAccount);
    mysqli_query($con, $sqlDeleteAccountInfo);
    echo "<script>
            location.href='success.php';
        </script>";
    mysqli_close($con);
?>