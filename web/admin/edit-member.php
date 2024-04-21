<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include database connection
include '/opt/lampp/htdocs/vizzie_system/web/config.php';

// Check if the user ID is provided in the URL query string
if (isset($_GET['id'])) {
    // Sanitize the user ID
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $update_fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $update_sname = mysqli_real_escape_string($conn, $_POST['sname']);
        $update_email = mysqli_real_escape_string($conn, $_POST['email']);
        $update_contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $update_username = mysqli_real_escape_string($conn, $_POST['name']);
        $update_password = mysqli_real_escape_string($conn, $_POST['password']);

        // Construct the UPDATE query
        $sql = "UPDATE user_form SET fname = '$update_fname', sname = '$update_sname', email = '$update_email', contact = '$update_contact', name = '$update_username', password = '$update_password' WHERE id = '$user_id'";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Redirect the user back to the member.php page
            header("Location: member.php");
            exit;
        } else {
            // Display an error message if the update fails
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    // Construct the SELECT query to fetch user details
    $sql = "SELECT * FROM user_form WHERE id = '$user_id'";

    // Execute the SELECT query
    $result = mysqli_query($conn, $sql);

    // Check if a user with the provided ID exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch user details
        $user = mysqli_fetch_assoc($result);
        // Output HTML form with user details pre-filled
        // HTML form code...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<!doctype html>
<html lang="en">

<?php include 'includes/header.php' ?>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        
    <?php include 'includes/navbar.php' ?>
    <?php include 'includes/sidebar.php' ?>
        
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"><i class="fa fa-fw fa-user-plus"></i> Edit Member </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Currency</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="mb-0">Member Information</h4>
                                        </div>
                                        <div class="card-body">
    <form action="" class="needs-validation" method="post" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
        <label for="firstName">First name</label>
        <input type="text" class="form-control" placeholder="" name="fname"  required="" value="<?php echo $user['fname']; ?>"><br>
        </div>

        <div class="col-md-6 mb-3">
        <label for="firstName">Last Name</label>
        <input type="text" class="form-control" placeholder="" name="sname"  required="" value="<?php echo $user['sname']; ?>"><br>
        </div>

        <div class="col-md-6 mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="" name="email" required="" value="<?php echo $user['email']; ?>">
         </div>
         
         <div class="col-md-6 mb-3">
            <label for="contact">Contact</label>
            <input type="text" class="form-control" placeholder="" name="contact" required=""value="<?php echo $user['contact']; ?>"><br>
         </div>

         <div class="col-md-6 mb-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" placeholder="" name="name" required="" value="<?php echo $user['name']; ?>"><br>
         </div>

         <div class="col-md-6 mb-3">
             <label for="password">Password</label>
             <input type="password" class="form-control" placeholder="" name="password" required="" value="<?php echo $user['name']; ?>"><br>
        </div>

        <button type="submit" class="btn btn-space btn-primary" value="Submit">Submit</button>
    </form>
</body>
</html>

<?php
    } else {
        // No user found with the provided ID
        echo "User not found.";
    }
} else {
    // User ID not provided in the URL
    echo "User ID not specified.";
}
?>
