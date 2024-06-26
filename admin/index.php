<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '/opt/lampp/htdocs/vizzie_system/web/config.php';
// Fetch available rooms
$query_rooms = "SELECT COUNT(*) AS total_rooms FROM bnb_details";
$result_rooms = mysqli_query($conn, $query_rooms);
$row_rooms = mysqli_fetch_assoc($result_rooms);
$total_rooms = $row_rooms['total_rooms'];

// Fetch number of members from the database
$query_members = "SELECT COUNT(*) AS total_members FROM user_form";
$result_members = mysqli_query($conn, $query_members);
$row_members = mysqli_fetch_assoc($result_members);
$total_members = $row_members['total_members'];

// Fetch number of daily transactions from the database
$query_transactions = "SELECT COUNT(*) AS total_transactions FROM withdrawals WHERE DATE(created_at) = CURDATE()";
$result_transactions = mysqli_query($conn, $query_transactions);
$row_transactions = mysqli_fetch_assoc($result_transactions);
$total_transactions = $row_transactions['total_transactions'];

// Fetch number of daily transactions from the database
$query_transactions = "SELECT COUNT(*) AS total_deposit FROM deposits WHERE DATE(created_at) = CURDATE()";
$result_transactions = mysqli_query($conn, $query_transactions);
$row_transactions = mysqli_fetch_assoc($result_transactions);
$total_deposit = $row_transactions['total_deposit'];
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
                                <h3 class="mb-2">Dashboard </h3>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
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
                        <div class="offset-xl-10 col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
                            <form>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="daterange" value="01/01/2024 - 01/15/20182024" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
	                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
	                            <div class="card">
	                                <div class="card-body">
	                                    <div class="d-inline-block">
	                                        <h5 class="text-muted">Available BNBs</h5>
	                                        <h2 class="mb-0"><?php echo $total_rooms?></h2> 
	                                    </div>
	                                    <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                                            <i class="fas fa-home fa-fw fa-sm text-info"></i>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <a href="member.php">
	                            <div class="card">
	                                <div class="card-body">
	                                    <div class="d-inline-block">
	                                        <h5 class="text-muted">Number of Members</h5>
	                                        <h2 class="mb-0"><?php echo $total_members; ?></h2>
	                                    </div>
	                                    <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary-light mt-1">
	                                        <i class="fa fa-users fa-fw fa-sm text-secondary"></i>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <a href="withdraw.php">
	                            <div class="card">
	                                <div class="card-body">
	                                    <div class="d-inline-block">
	                                        <h5 class="text-muted">Number of Daily Withdrawals</h5>
	                                        <h2 class="mb-0"><?php echo $total_transactions; ?></h2>
	                                    </div>
	                                    <div class="float-right icon-circle-medium  icon-box-lg  bg-success-light mt-1">
	                                        <i class="fa fa-chart-line fa-fw fa-sm text-success"></i>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                            <a href="deposit.php">
	                            <div class="card">
	                                <div class="card-body">
	                                    <div class="d-inline-block">
	                                        <h5 class="text-muted">Number of Daily Deposits</h5>
	                                        <h2 class="mb-0"><?php echo $total_deposit; ?></h2>
	                                    </div>
	                                    <div class="float-right icon-circle-medium  icon-box-lg  bg-success-light mt-1">
	                                        <i class="fa fa-chart-line fa-fw fa-sm text-success"></i>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
                    </div>
                    <div class="row">
                        
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
