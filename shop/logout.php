<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    // Unset or destroy the session variables
    $_SESSION['is_logged_in'] = false;
    $_SESSION['user_id'] = null;
    session_unset();
    // or session_destroy(); // This will destroy the whole session, use with caution
    // session_destroy();
    echo "<script>
        location.href='index.php'
    </script>";
    // Redirect to a logged-out page or homepage
    exit();
} else {
    // User not logged in, handle accordingly
    echo "User not logged in";
}
?>