<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include config file and establish database conn
include '/opt/lampp/htdocs/vizzie_system/web/config.php';

// Fetch withdrawal transactions data from the database
$query_withdrawals = "SELECT * FROM withdrawals";
$result_withdrawals = mysqli_query($conn, $query_withdrawals);
?>

<!doctype html>
<html lang="en">
<?php include 'includes/header.php' ?>
<body>
    <!-- Main wrapper -->
    <div class="dashboard-main-wrapper">
        <?php include 'includes/navbar.php' ?>
        <?php include 'includes/sidebar.php' ?>
        
        <!-- Wrapper -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- Page header -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"><i class="fa fa-fw fa-piggy-bank"></i> Withdrawal Transactions </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Withdraw</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page header -->
                
                <div class="row">
                    <!-- Basic table -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">List of Withdraw Transactions</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Transaction Code</th>
                                                <th>Member</th>
                                                <th>Amount</th>
                                                <th>Charge</th>
                                                <th>To Receive</th>
                                                <th>Date/Time</th>
                                                <th>Method</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result_withdrawals)) { ?>
                                                <tr>
                                                    <td><?php echo $row['transaction_code']; ?></td>
                                                    <td><?php echo $row['member']; ?></td>
                                                    <td><?php echo $row['amount']; ?></td>
                                                    <td><?php echo $row['charge']; ?></td>
                                                    <td><?php echo $row['to_receive']; ?></td>
                                                    <td><?php echo $row['datetime']; ?></td>
                                                    <td><img src="<?php echo $row['method_image']; ?>" width="70" alt="<?php echo $row['method']; ?>"></td>
                                                    <td><span class="badge bg-success text-white"><?php echo $row['status']; ?></span></td>
                                                    <td><?php echo $row['remarks']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End basic table -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
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
