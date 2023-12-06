<?php 

    session_start();
    
    if (isset($_SESSION['adminLoggedin']) && $_SESSION['adminLoggedin'] === false || empty($_SESSION) || empty($_SESSION['adminLoggedin'])) {
        echo "<script>
            location.href='login.php'
        </script>";
    }
    // connect chuchu eklavush, palitan niyo nalang 'to hehe
    include '../db_connection.php';
    mysqli_select_db($con, 'Contact');

    $sql = "SELECT * FROM appointments";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="appointments.csv');

        $output = fopen('php://output', 'w');
        // replace niyo re mga ID chuchu don sa column name sa db niyo
        $header = array("ID", "FirstName", "LastName", "Birthday", "Gender", "EmailAddress", "Phone", "PurposeOfVisit", "Other", "PreferredSchedule1", "PreferredSchedule2", "Status", "Message", "SubmissionDate"); // Replace with your actual column names
        fputcsv($output, $header);

        while ($row = mysqli_fetch_assoc($result)) {

            // 'yung mga date at phone ko nilalagay ko lang sa loob ng double quote eme pwede naman wala 'to
            // nilagay ko lang re kasi puro #### napupunta sa csv na naeexport 
            // palitan niyo nalang column_name
            // $row['column_name'] = '"' . $row['column_name']  . '"'; 
            $row['Birthday'] = '"' . $row['Birthday'] . '"'; 
            $row['Phone'] = '"' . $row['Phone'] . '"';
            $row['PreferredSchedule1'] = '"' . $row['PreferredSchedule1'] . '"';
            $row['PreferredSchedule2'] = '"' . $row['PreferredSchedule2'] . '"';
            $row['SubmissionDate'] = '"' . $row['SubmissionDate'] . '"'; 

            fputcsv($output, $row);
        }

        fclose($output);
    }
    mysqli_close($con);
?>