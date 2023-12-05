<?php
session_start();

// Check if the admin is logged in
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === true) {
        // Unset or destroy the session variables
        $_SESSION['adminLoggedin'] = false;
        session_unset();
        echo "<script>
            location.href='index.php'
        </script>";
        // Redirect to a logged-out page or homepage
        exit();
    }
?>