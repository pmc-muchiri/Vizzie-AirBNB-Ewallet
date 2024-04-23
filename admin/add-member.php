<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '/opt/lampp/htdocs/vizzie_system/web/config.php';

if (isset($_POST['add_user'])) {
    $new_name = mysqli_real_escape_string($conn, $_POST['fname']);
    $new_sname = mysqli_real_escape_string($conn, $_POST['sname']);
    $new_email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $new_username = mysqli_real_escape_string($conn, $_POST['name']);
    $new_password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password using bcrypt
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $insert_query = mysqli_query($conn, "INSERT INTO `user_form` (fname, sname, email, contact, name, password) VALUES ('$new_name', '$new_sname', '$new_email', '$new_contact', '$new_username', '$hashed_password')");

    if ($insert_query) {
        $message[] = 'New user added successfully!';
    } else {
        $message[] = 'Failed to add new user. Please try again later.';
    }
}
?>

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
                            <h2 class="pageheader-title"><i class="fa fa-fw fa-user-plus"></i> Add Member </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="member.php" class="breadcrumb-link">Member</a></li>
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
                                            <div id="messageContainer" class="text-center">
                                                <?php
                                                if (isset($message)) {
                                                    foreach ($message as $msg) {
                                                        echo '<div class="alert alert-info" role="alert">' . $msg . '</div>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        <form class="needs-validation" action="" method="post" novalidate>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="firstName">First name</label>
                                                <input type="text" class="form-control" placeholder="" name="fname" required="">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="lastName">Last name</label>
                                                <input type="text" class="form-control" placeholder="" name="sname" required="">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" placeholder="" name="email" required="">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="contact">Contact</label>
                                                <input type="text" class="form-control" placeholder="" name="contact" required="">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" placeholder="" name="name" required="">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" placeholder="" name="password" required="">
                                            </div>
                                        </div>


                                            <div class="form-group row text-right">
                                                <div class="col col-sm-10 col-lg-12 offset-lg-0">
                                                    <button type="submit" class="btn btn-space btn-primary" name="add_user">Add User</button>
                                                    <button class="btn btn-space btn-secondary">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
            
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="../assets/vendor/multi-select/js/jquery.multi-select.js"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    
</body>
 
</html>
