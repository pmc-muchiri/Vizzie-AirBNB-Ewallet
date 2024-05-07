<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config file and establish database connection
include '/opt/lampp/htdocs/vizzie_system/web/config.php';
// Fetch airbnb data from the database
$sql_get_bnb_detail = "SELECT * FROM bnb_details";
$result_get_bnb_detail = mysqli_query($conn, $sql_get_bnb_detail);
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
                            <h2 class="pageheader-title"><i class="fa fa-fw fa-home"></i> Available Airbnb </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Airbnb</a></li>
                                    </ol>
                                </nav>
                            </div></br>
                            <div id="messageContainer" class="text-center">
                                <?php
                                if (isset($message)) {
                                    foreach ($message as $msg) {
                                        echo '<div class="alert alert-info" role="alert">' . $msg . '</div>';
                                    }
                                }
                                ?>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <?php
                        while ($row = mysqli_fetch_assoc($result_get_bnb_detail)) {
                            ?>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <img class="card-img-top" src="<?php echo $row['image_path']; ?>" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                        
                                        <p class="card-text"><?php echo $row['description']; ?></p>
                                        <p class="card-text"><b>Price: ksh. <?php echo $row['price']; ?> per night</b></p>
                                        
                                        <form action="" method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <input type="hidden" name="amount" value="<?php echo $row['price']; ?>">
                                            <!-- <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        
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
    <script>
        setTimeout(function() {
            var messageContainer = document.getElementById('messageContainer');
            if (messageContainer) {
                messageContainer.style.display = 'none';
            }
        }, 3000); // 3 seconds
    </script>
</body>

</html>