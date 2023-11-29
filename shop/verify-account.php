<?php 
    $userEmail = $_GET['userEmail'];
    if(isset($userEmail)){
        include '../db_connection.php';
        mysqli_select_db($con, 'User');
        $sql = "UPDATE Accounts SET Status = 'Verified' WHERE Email = '$userEmail'";
        mysqli_query($con, $sql);
        mysqli_close($con);
        echo "<script>window.location.href='http://localhost/optical/shop/index.php'</script>";
    }
?>