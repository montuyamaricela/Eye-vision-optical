<?php
    include '../db_connection.php';
    mysqli_select_db($con, 'cms');
    
    if ($_SERVER["REQUEST_METHOD"] == 'POST'){
        $imageName = $_FILES['slideshowImage']['name'];
		$tmp_name=$_FILES['slideshowImage']['tmp_name'];
        echo $imageName;

        if($imageName){
            $location = "slideshowImages/$imageName";
			$destination = "../public/images/$location";
			move_uploaded_file($tmp_name,$destination);
            $updateLogo = "INSERT INTO slideshow (Image) VALUES ('$location')";
            mysqli_query($con, $updateLogo);
                echo "<script>
                    location.href='modify-customer-page.php'
            </script>";
        } 
       
    }

?>