<?php
    include '../db_connection.php';
    mysqli_select_db($con, 'cms');
    
    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
       $dark = $_POST['dark'];
       $light = $_POST['light'];

        $updateColor = "UPDATE color SET darkColor = '$dark', lightColor = '$light'";
        mysqli_query($con, $updateColor);
            echo "<script>
                location.href='modify-customer-page.php';
        </script>";
        
       
    }

?>