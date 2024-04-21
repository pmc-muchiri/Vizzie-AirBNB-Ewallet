<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '/opt/lampp/htdocs/vizzie_system/web/config.php';
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if(isset($_POST['submit'])) {
        // Retrieve the updated values from the form
        $new_fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $new_sname = mysqli_real_escape_string($conn, $_POST['sname']);
        $new_email = mysqli_real_escape_string($conn, $_POST['email']);
        $new_contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $new_name = mysqli_real_escape_string($conn, $_POST['name']);
        // $new_password = mysqli_real_escape_string($conn, $_POST['password']); // Note: Uncomment this line if you want to update the password too

        // Update the user's profile in the database
        $update_query = "UPDATE user_form SET fname = '$new_fname', sname = '$new_sname', email = '$new_email', contact = '$new_contact', name = '$new_name' WHERE id = $user_id";
        $result = mysqli_query($conn, $update_query);

        if($result) {
            // Redirect the user back to the profile page after successful update
            header('Location: profile.php');
            exit;
        } else {
            // Handle update failure
            echo "Error updating profile: " . mysqli_error($conn);
        }
    } else {
        // Handle form submission failure
        echo "Form submission failed.";
    }
} else {
    // Handle user authentication failure
    header('Location: login.php');
    exit;
}
?>
