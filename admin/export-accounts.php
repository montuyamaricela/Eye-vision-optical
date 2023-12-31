<?php 

    session_start();
    
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false || empty($_SESSION) || empty($_SESSION['adminLoggedin'])) {
        echo "<script>
            location.href='login.php'
        </script>";
    }
    // connect chuchu eklavush, palitan niyo nalang 'to hehe
    include '../db_connection.php';
    mysqli_select_db($con, 'user');

    $sql = "SELECT ID, Name, Email, Status, LoginAttempt, DateCreated FROM accounts";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="users-account.csv');

        $output = fopen('php://output', 'w');
        // replace niyo re mga ID chuchu don sa column name sa db niyo
        $header = array("ID", "Name", "Email", "Status", "Login Attempt", "Date Created"); // Replace with your actual column names
        fputcsv($output, $header);

        while ($row = mysqli_fetch_assoc($result)) {
            $row['DateCreated'] = '"' . $row['DateCreated'] . '"'; 

            fputcsv($output, $row);
        }

        fclose($output);
    }
    mysqli_close($con);
?>