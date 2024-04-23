<?php
    // Include database connection
    include '/opt/lampp/htdocs/vizzie_system/web/config.php';

    // Check if the user ID is provided in the URL query string
    if (isset($_GET['id'])) {
        // Sanitize the user ID
        $currency_id = mysqli_real_escape_string($conn, $_GET['id']);

        // Construct the DELETE query
        $sql = "DELETE FROM currency WHERE id = '$currency_id'";

        // Execute the DELETE query
        if (mysqli_query($conn, $sql)) {
            // User deleted successfully, redirect to member list page
            header("Location: currency.php");
            exit;
        } else {
            // Error occurred while deleting user
            echo "Error deleting currency: " . mysqli_error($conn);
        }
    } else {
        // User ID not provided in the URL
        echo "currency ID not specified.";
    }
?>