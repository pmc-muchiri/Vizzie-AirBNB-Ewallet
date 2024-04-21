<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include '/opt/lampp/htdocs/vizzie_system/web/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch deposit transactions from the deposits table
$deposit_query = "SELECT * FROM deposits";
$deposit_result = mysqli_query($conn, $deposit_query);

// Handle payment update
if (isset($_POST['update_payment'])) {
    $transaction_code = $_POST['transaction_code'];
    // Update the payment status in the database
    $update_query = "UPDATE deposits SET status = 'Completed' WHERE transaction_code = '$transaction_code'";
    mysqli_query($conn, $update_query);
    // Redirect to the same page to avoid form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!doctype html>
<html lang="en">
    <?php include 'includes/header.php' ?>

<body>
    <!-- main wrapper -->
    <div class="dashboard-main-wrapper">
        
    <?php include 'includes/navbar.php' ?>
    <?php include 'includes/sidebar.php' ?>
        
        <!-- wrapper -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- pageheader -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"><i class="fa fa-fw fa-credit-card"></i> Deposit Transactions </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Deposit</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end pageheader -->
                <div class="row">
                    <!-- basic table -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">List of Deposit Transactions </h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Transaction Code</th>
                                                <th>Email</th>
                                                <th>Deposit Amount</th>
                                                <th>Currency</th>
                                                <th>Date/Time</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($deposit_result)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['transaction_code'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                                echo "<td>" . $row['deposit_amount'] . "</td>";
                                                echo "<td>" . $row['currency'] . "</td>";
                                                echo "<td>" . $row['created_at'] . "</td>";
                                                echo "<td><img src='../assets/images/{$row['payment_gateway']}.png' width='70'/></td>";
                                                echo "<td><span class='badge bg-success text-white'>{$row['status']}</span></td>";
                                                echo "<td>{$row['remarks']}</td>";
                                                echo "<td>";
                                                if ($row['status'] != 'Completed') {
                                                    echo "<form method='post'>";
                                                    echo "<input type='hidden' name='transaction_code' value='" . $row['transaction_code'] . "'/>";
                                                    echo "<button type='submit' name='update_payment' class='btn btn-primary'>Mark as Completed</button>";
                                                    echo "</form>";
                                                }
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Transaction Code</th>
                                                <th>Email</th>
                                                <th>Deposit Amount</th>
                                                <th>Currency</th>
                                                <th>Date/Time</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main wrapper -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- Include other scripts -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="../assets/vendor/multi-select/js/jquery.multi-select.js"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    
</body>
 
</html>
