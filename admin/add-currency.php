<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '/opt/lampp/htdocs/vizzie_system/web/config.php';

// Check if form is submitted and data is received
if (isset($_POST['add_currency'])) {
    // Check if all required fields are filled
    if (!empty($_POST['currency_name']) && !empty($_POST['currency_symbol']) && !empty($_POST['usd_equivalent'])) {
        $new_curreny_name = mysqli_real_escape_string($conn, $_POST['currency_name']);
        $new_curreny_symbol = mysqli_real_escape_string($conn, $_POST['currency_symbol']);
        $new_usd_equivalent = mysqli_real_escape_string($conn, $_POST['usd_equivalent']);

        // Perform the insertion
        $insert_query = mysqli_query($conn, "INSERT INTO `currency` (currency_name, currency_symbol, usd_equivalent, status) VALUES ('$new_curreny_name', '$new_curreny_symbol', '$new_usd_equivalent', 'Active')");

        // Check if insertion was successful
        if ($insert_query) {
            $message[] = 'New currency added successfully!';
        } else {
            // Output MySQL error if any
            $message[] = 'Failed to add new currency. Error: ' . mysqli_error($conn);
        }
    } else {
        $message[] = 'All fields are required!';
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
                            <h2 class="pageheader-title"><i class="fa fa-fw fa-dollar-sign"></i> Add Currency </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="currency.php" class="breadcrumb-link">Currency</a></li>
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
                                <h5 class="card-header">Currency Information </h5>
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
                                    <form id="validationform" data-parsley-validate="" novalidate="" action="add-currency.php" method="post">
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Currency Name</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="text" required="" class="form-control" placeholder="" name="currency_name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Currency Symbol</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="text" required="" data-parsley-minlength="100" class="form-control" placeholder="" name="currency_symbol">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">USD Equivalent</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="text" required="" data-parsley-minlength="100" class="form-control" placeholder="" name="usd_equivalent">
                                            </div>
                                        </div>
                                        <div class="form-group row text-right">
                                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                <button type="submit" class="btn btn-space btn-primary" name="add_currency">Submit</button>
                                                <button class="btn btn-space btn-secondary">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
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
    
</body>
 
</html>