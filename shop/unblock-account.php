<?php 
    $userEmail = $_GET['userEmail'];
    if(isset($userEmail)){
        include '../db_connection.php';
        mysqli_select_db($con, 'User');
        $sqlStatus = "UPDATE Accounts SET Status = 'Verified' WHERE Email = '$userEmail'";
        $sqlLoginAttempt = "UPDATE Accounts SET LoginAttempt = 0 WHERE Email = '$userEmail'";
        mysqli_query($con, $sqlStatus);
        mysqli_query($con, $sqlLoginAttempt);

        mysqli_close($con);
        echo "<script>window.location.href='http://localhost/optical/shop/index.php'</script>";
    }
?>