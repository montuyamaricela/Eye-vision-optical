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
    mysqli_select_db($con, 'User');
    $getAdminInfo = "SELECT * FROM user.admin WHERE ID = 1";
    $admin = mysqli_query($con, $getAdminInfo);
    if ($row = mysqli_fetch_array($admin)){        
        $adminPassword = $row['Password'];
    }

    if ($password === $adminPassword){
        $sqlDeleteAccount = "DELETE FROM accounts WHERE id=$ID";
        $sqlDeleteAccountInfo = "DELETE FROM user_info WHERE id=$ID";

        mysqli_query($con, $sqlDeleteAccount);
        mysqli_query($con, $sqlDeleteAccountInfo);
        echo "<script>
                location.href='success.php';
            </script>";        
    } else {
        echo "<script>
            alert('incorrect Password');
            location.href='users-account.php';
            
        </script>";    
    }

    mysqli_close($con);
?>