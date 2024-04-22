<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config file and establish database connection
include '/opt/lampp/htdocs/vizzie_system/web/config.php';

// Fetch the user's ID from the session
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$user_id = $_SESSION['user_id'];

// Fetch current money from the deposits table for the current user
$query_current_money = "SELECT total_deposit AS current_money FROM user_deposit_total WHERE user_id = ?";
$stmt_current_money = $conn->prepare($query_current_money);
$stmt_current_money->bind_param("i", $user_id);
$stmt_current_money->execute();
$result_current_money = $stmt_current_money->get_result();
$row_current_money = $result_current_money->fetch_assoc();
$current_money = $row_current_money['current_money'];

// Fetch number of deposits from the deposits table for the current user
$query_deposits = "SELECT COUNT(*) AS total_deposits FROM deposits WHERE user_id = ?";
$stmt_deposits = $conn->prepare($query_deposits);
$stmt_deposits->bind_param("i", $user_id);
$stmt_deposits->execute();
$result_deposits = $stmt_deposits->get_result();
$row_deposits = $result_deposits->fetch_assoc();
$total_deposits = $row_deposits['total_deposits'];

// Fetch number of withdrawals from the withdrawals table for the current user
$query_withdrawals = "SELECT COUNT(*) AS total_withdrawals FROM withdrawals WHERE user_id = ?";
$stmt_withdrawals = $conn->prepare($query_withdrawals);
$stmt_withdrawals->bind_param("i", $user_id);
$stmt_withdrawals->execute();
$result_withdrawals = $stmt_withdrawals->get_result();
$row_withdrawals = $result_withdrawals->fetch_assoc();
$total_withdrawals = $row_withdrawals['total_withdrawals'];

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
            <div class="dashboard-finance">
                <div class="container-fluid dashboard-content">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h3 class="mb-2"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard </h3>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Current Money</h5>
                                <div class="card-body">
                                    <div class="metric-value d-inline-block">
                                    <h1 class="mb-1"><?php echo 'ksh ' . (!empty($current_money) ? $current_money : '0.00'); ?></h1>

                                    </div>
                                </div>
                                <div class="card-footer text-center bg-white">
                                    <a href="#" class="card-link">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Number of Deposits</h5>
                                <div class="card-body">
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1"><?php echo $total_deposits; ?></h1>
                                    </div>
                                </div>
                                <div class="card-footer text-center bg-white">
                                    <a href="#" class="card-link">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Number of Withdrawals</h5>
                                <div class="card-body">
                                    <div class="metric-value d-inline-block">
                                        <h1 class="mb-1"><?php echo $total_withdrawals; ?></h1>
                                    </div>
                                </div>
                                <div class="card-footer text-center bg-white">
                                    <a href="#" class="card-link">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    
<?php include 'includes/footer.php' ?>
</body>
</html>
