<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Include database connection
    include '/opt/lampp/htdocs/vizzie_system/web/config.php';

    // Check if the user ID is provided in the URL query string
    if (isset($_GET['id'])) {
        // Sanitize the user ID
        $user_id = mysqli_real_escape_string($conn, $_GET['id']);

        // Construct the DELETE query
        $sql = "DELETE FROM user_form WHERE id = '$user_id'";

        // Execute the DELETE query
        if (mysqli_query($conn, $sql)) {
            // User deleted successfully, redirect to member list page
            header("Location: member.php");
            exit;
        } else {
            // Error occurred while deleting user
            echo "Error deleting user: " . mysqli_error($conn);
        }
    } else {
        // User ID not provided in the URL
        echo "User ID not specified.";
    }
?>
