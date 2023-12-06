<?php
    include '../db_connection.php';
    mysqli_select_db($con, 'cms');
    
    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        $imageID = $_POST['id'];

        $deleteImage = "DELETE FROM slideshow WHERE id = '$imageID'";
        mysqli_query($con, $deleteImage);
            echo "<script>
                location.href='modify-customer-page.php'
        </script>";
        
       
    }

?>