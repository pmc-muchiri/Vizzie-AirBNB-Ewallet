<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../web/config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['update_profile'])) {
    $update_name = mysqli_real_escape_string($conn, $_POST['fname']);
    $update_sname = mysqli_real_escape_string($conn, $_POST['sname']);
    $update_email = mysqli_real_escape_string($conn, $_POST['email']);
    $update_contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $update_username = mysqli_real_escape_string($conn, $_POST['name']);
    $update_password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password using bcrypt
    $hashed_password = password_hash($update_password, PASSWORD_DEFAULT);

    $update_query = mysqli_query($conn, "UPDATE `user_form` SET fname = '$update_name', sname = '$update_sname', email = '$update_email', contact = '$update_contact', name = '$update_username', password = '$hashed_password' WHERE id = '$user_id'");

    if ($update_query) {
        $message[] = 'Profile updated successfully!';
    } else {
        $message[] = 'Failed to update profile. Please try again later.';
    }
}

$select_query = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($select_query);
?>

<!doctype html>
<html lang="en">

<?php include 'includes/header.php' ?>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- Include navbar and sidebar -->
        <?php include 'includes/navbar.php' ?>
        <?php include 'includes/sidebar.php' ?>

        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"><i class="fa fa-fw fa-user"></i> My Profile</h2>
                            <!-- Breadcrumb -->
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Profile</a></li>
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
                                        <h4 class="mb-0">Profile Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        if (isset($message)) {
                                            foreach ($message as $msg) {
                                                echo '<div class="alert alert-info" role="alert">' . $msg . '</div>';
                                            }
                                        }
                                        ?>
                                        <form class="needs-validation" action="" method="post" novalidate>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="firstName">First name</label>
                                                    <input type="text" class="form-control" placeholder="" value="<?php echo $user['fname']; ?>" name="fname" required="">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="lastName">Last name</label>
                                                    <input type="text" class="form-control" placeholder="" value="<?php echo $user['sname']; ?>" name="sname" required="">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" placeholder="" value="<?php echo $user['email']; ?>" name="email" required="">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="contact">Contact</label>
                                                    <input type="text" class="form-control" placeholder="" value="<?php echo $user['contact']; ?>" name="contact" required="">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" placeholder="" value="<?php echo $user['name']; ?>" name="name" required="">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" placeholder="" value="<?php echo $user['name']; ?>" name="password" required="">
                                                </div>
                                            </div>

                                            <div class="form-group row text-right">
                                                <div class="col col-sm-10 col-lg-12 offset-lg-0">
                                                    <button type="submit" class="btn btn-space btn-primary" name="update_profile">Update</button>
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
