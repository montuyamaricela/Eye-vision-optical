<?php
    include '../db_connection.php';
    mysqli_select_db($con, 'cms');
    
    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        $imageName = $_FILES['backgroundImage']['name'];
		$tmp_name=$_FILES['backgroundImage']['tmp_name'];
        echo $imageName;

        if($imageName){
            $location = "backgrounds/$imageName";
			$destination = "../public/images/$location";
			move_uploaded_file($tmp_name,$destination);
            $updateBackground = "UPDATE background SET Image = '$location'";
            mysqli_query($con, $updateBackground);
                echo "<script>
                    location.href='modify-customer-page.php'
            </script>";
        } 
       
    }

?>