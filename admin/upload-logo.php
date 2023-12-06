<?php
    include '../db_connection.php';
    mysqli_select_db($con, 'cms');
    
    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        $imageName = $_FILES['LogoImage']['name'];
		$tmp_name=$_FILES['LogoImage']['tmp_name'];
        echo $imageName;

        if($imageName){
            $location = "logo/$imageName";
			$destination = "../public/images/$location";
			move_uploaded_file($tmp_name,$destination);
            $updateLogo = "UPDATE logo SET Image = '$location'";
            mysqli_query($con, $updateLogo);
                echo "<script>
                    location.href='modify-customer-page.php'
            </script>";
        } 
       
    }

?>