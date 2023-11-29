<?php
session_start();

// Check if the admin is logged in
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === true) {
        // Unset or destroy the session variables
        $_SESSION['adminLoggedin'] = false;
        echo "<script>
            location.href='index.php'
        </script>";
        // Redirect to a logged-out page or homepage
        exit();
    } else {
    // User not logged in, handle accordingly
        echo "Admin not logged in";
    }
?>