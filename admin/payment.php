<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include '/opt/lampp/htdocs/vizzie_system/web/config.php';

session_start();


// Fetch payment transactions from the payment table
$payment_query = "SELECT * FROM payment_gateway";
$payment_result = mysqli_query($conn, $payment_query);

// Check for errors
if (!$payment_result) {
    die("Error: " . mysqli_error($conn));
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
                            <h2 class="pageheader-title"><i class="fa fa-fw fa-money-bill-alt"></i> Payment Gateway </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Payment</a></li>
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
                    <!-- ============================================================== -->
                    <!-- basic table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">List of Payment Gateway </h5>
                            <div class="card-body"><a class="btn btn-sm btn-success" href="add-payment.php"><i class="fa fa-fw fa-plus"></i> add payment gateway</a><br><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>Gateway Name</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while ($row = mysqli_fetch_assoc($payment_result)) {
                                                echo "<tr>";
                                                        echo "<td>" . $row['payment_gateway'] . "</td>";
                                                        echo "<td>";
                                                            if ($row['type'] == 'Manual') {
                                                                echo "<span class='badge bg-primary text-white'>Manual</span>";
                                                            } elseif ($row['type'] == 'Automatic') {
                                                                echo "<span class='badge bg-warning text-white'>Automatic</span>";
                                                            } else {
                                                                // Handle other statuses here if needed
                                                                echo "<span class='badge bg-secondary text-white'>" . $row['type'] . "</span>";
                                                            }
                                                        echo "</td>";
                                                        echo "<td>";
                                                            if ($row['status'] == 'Inactive') {
                                                                echo "<span class='badge bg-warning text-white'>Inactive</span>";
                                                            } elseif ($row['status'] == 'Active') {
                                                                echo "<span class='badge bg-success text-white'>active</span>";
                                                            } else {
                                                                // Handle other statuses here if needed
                                                                echo "<span class='badge bg-secondary text-white'>" . $row['status'] . "</span>";
                                                            }
                                                        echo "</td>";
                                                        // echo "<td class='align-right'>";
                                                        // // echo "<a href='edit-payment.php?id=" . $row['id'] . "' class='text-primary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a> | ";
                                                        // // echo "<a href='delete-payment.php?id=" . $row['id'] . "' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Delete'><i class='fa fa-trash-alt'></i></a>";
                                                        // echo "</td>";
                                                        echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Gateway Name</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/vendor/datatables/js/data-table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    
</body>
 
</html>