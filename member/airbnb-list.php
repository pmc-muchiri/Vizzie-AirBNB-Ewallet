<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config file and establish database connection
include '/opt/lampp/htdocs/vizzie_system/web/config.php';

// Check if the Pay Now button is clicked
if (isset($_POST['pay_now'])) {
    // Get the user ID and amount from the form (you may need to adjust this based on your form structure)
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    
    // Sanitize input data
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $amount = mysqli_real_escape_string($conn, $amount);
    
    // Start a transaction
    mysqli_begin_transaction($conn);

    // Fetch the user's email from the deposit table
    $query_get_user_email = "SELECT email FROM user_form WHERE id = $user_id";
    $result_get_user_email = mysqli_query($conn, $query_get_user_email);

    if ($result_get_user_email) {
        $row = mysqli_fetch_assoc($result_get_user_email);
        $email = $row['email'];

        // Fetch the current total deposit amount of the user
        $query_get_total_deposit = "SELECT current_deposit AS total_deposits FROM user_deposit_total WHERE user_id = $user_id";
        $result_get_total_deposit = mysqli_query($conn, $query_get_total_deposit);

        if ($result_get_total_deposit) {
            $row = mysqli_fetch_assoc($result_get_total_deposit);
            $current_total_deposit = $row['total_deposits'];

            // Check if the user has sufficient balance
            if ($current_total_deposit !== null && $current_total_deposit >= $amount) {
                // Deduct the amount from the user's total deposit
                $new_total_deposit = $current_total_deposit - $amount;
                $query_update_deposit = "UPDATE user_deposit_total SET current_deposit = $new_total_deposit WHERE user_id = $user_id";
                $result_update_deposit = mysqli_query($conn, $query_update_deposit);

                if ($result_update_deposit) {
                    // Default status
                    $default_status = "paid";
                
                    // Insert the withdrawal record into the withdrawals table
                    $query_insert_withdrawal = "INSERT INTO withdrawals (user_id, total_withdrawal, email, status) VALUES ('$user_id', '$amount', '$email', '$default_status')";
                    $result_insert_withdrawal = mysqli_query($conn, $query_insert_withdrawal);
                    if ($result_insert_withdrawal) {
                        // Commit the transaction
                        mysqli_commit($conn);

                        // Payment successful
                        $_SESSION['payment_message']  = "Your payment has been successfully processed! Have a wonderful stay and feel free to reach out if you need anything.";
                        
                    } else {
                        // Rollback the transaction due to error inserting withdrawal record
                        mysqli_rollback($conn);
                        // Error inserting withdrawal record
                        echo "Error inserting withdrawal record: " . mysqli_error($conn);
                    }
                } else {
                    // Rollback the transaction due to error updating deposit amount
                    mysqli_rollback($conn);
                    // Error updating deposit amount
                    echo "Error updating deposit amount: " . mysqli_error($conn);
                }
            } else {
                // Insufficient balance
                $_SESSION['payment_message'] = 'Insufficient balance. Please add funds to your account.';
                // echo "Insufficient balance. Please add funds to your account.";
                // header("Location: index.php");
            }
        } else {
            // Error fetching total deposit amount
            echo "Error fetching total deposit amount: " . mysqli_error($conn);
        }
    } else {
        // Error fetching user's email
        echo "Error fetching user's email: " . mysqli_error($conn);
    }

    if (isset($_SESSION['payment_message'])) {
        $message = array($_SESSION['payment_message']);
        // Unset the session variable
        unset($_SESSION['payment_message']);
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
                    
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <img class="card-img-top" src="../assets/images/bnb/image3.png" alt="Airbnb Option 1">
                            <div class="card-body">
                                <h5 class="card-title">Wales Airbnb</h5>
                                <p class="card-text">Enjoy your stay in this cozy beachfront bungalow, just steps away from the ocean. Perfect for a romantic getaway or a relaxing vacation.</p>
                                <p class="card-text">Price: ksh. 10,500 per night</p>
                                <!-- Add the HTML form for payment -->
                                <form id="paymentForm1" action="" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="amount" value="10500"> <!-- Adjust the amount dynamically based on the Airbnb price -->
                                <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <img class="card-img-top" src="../assets/images/bnb/dining-room-3108037_1920.jpg" alt="Airbnb Option 1">
                            <div class="card-body">
                                <h5 class="card-title">Wales Airbnb</h5>
                                <p class="card-text">Enjoy your stay in this cozy beachfront bungalow, just steps away from the ocean. Perfect for a romantic getaway or a relaxing vacation.</p>
                                <p class="card-text">Price: ksh. 8,500 per night</p>
                                <!-- Add the HTML form for payment -->
                                <form id="paymentForm1" action="" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" name="amount" value="8500"> <!-- Adjust the amount dynamically based on the Airbnb price -->
                                    <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <img class="card-img-top" src="../assets/images/bnb/kitchen-1336160.jpg" alt="Airbnb Option 1">
                            <div class="card-body">
                                <h5 class="card-title">Wales Airbnb</h5>
                                <p class="card-text">Enjoy your stay in this cozy beachfront bungalow, just steps away from the ocean. Perfect for a romantic getaway or a relaxing vacation.</p>
                                <p class="card-text">Price: ksh. 15,500 per night</p>
                                <!-- Add the HTML form for payment -->
                                <form id="paymentForm1" action="" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" name="amount" value="15500"> <!-- Adjust the amount dynamically based on the Airbnb price -->
                                    <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <img class="card-img-top" src="../assets/images/bnb/kitchen-1687121_1280.jpg" alt="Airbnb Option 1">
                            <div class="card-body">
                                <h5 class="card-title">Wales Airbnb</h5>
                                <p class="card-text">Enjoy your stay in this cozy beachfront bungalow, just steps away from the ocean. Perfect for a romantic getaway or a relaxing vacation.</p>
                                <p class="card-text">Price: ksh. 12,500 per night</p>
                                <!-- Add the HTML form for payment -->
                                <form id="paymentForm1" action="" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" name="amount" value="12500"> <!-- Adjust the amount dynamically based on the Airbnb price -->
                                    <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <img class="card-img-top" src="../assets/images/bnb/apartment-3612030.jpg" alt="Airbnb Option 1">
                            <div class="card-body">
                                <h5 class="card-title">Wales Airbnb</h5>
                                <p class="card-text">Enjoy your stay in this cozy beachfront bungalow, just steps away from the ocean. Perfect for a romantic getaway or a relaxing vacation.</p>
                                <p class="card-text">Price: ksh. 3,500 per night</p>
                                <!-- Add the HTML form for payment -->
                                <form id="paymentForm1" action="" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" name="amount" value="3500"> <!-- Adjust the amount dynamically based on the Airbnb price -->
                                    <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <img class="card-img-top" src="../assets/images/bnb/beach-house-1505461.jpg" alt="Airbnb Option 1">
                            <div class="card-body">
                                <h5 class="card-title">Wales Airbnb</h5>
                                <p class="card-text">Enjoy your stay in this cozy beachfront bungalow, just steps away from the ocean. Perfect for a romantic getaway or a relaxing vacation.</p>
                                <p class="card-text">Price: ksh. 5,500 per night</p>
                                <!-- Add the HTML form for payment -->
                                <form id="paymentForm1" action="" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" name="amount" value="5500"> <!-- Adjust the amount dynamically based on the Airbnb price -->
                                    <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <img class="card-img-top" src="../assets/images/bnb/bnb.png" alt="Airbnb Option 1">
                            <div class="card-body">
                                <h5 class="card-title">Wales Airbnb</h5>
                                <p class="card-text">Enjoy your stay in this cozy beachfront bungalow, just steps away from the ocean. Perfect for a romantic getaway or a relaxing vacation.</p>
                                <p class="card-text">Price: ksh. 7,300 per night</p>
                                <!-- Add the HTML form for payment -->
                                <form id="paymentForm1" action="" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" name="amount" value="7300"> <!-- Adjust the amount dynamically based on the Airbnb price -->
                                    <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                                </form>
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

    <!-- JavaScript to capture user_id and amount -->
    <script>
        $(document).ready(function() {
            // Handle payment form submission
            $('#paymentForm1').submit(function(event) {
                // Get user_id dynamically
                var user_id = <?php echo $user_id; ?>;
                // Get amount dynamically
                var amount = 4500; // Adjust this dynamically based on the Airbnb price
                // Set user_id and amount in hidden input fields
                $(this).find('input[name="user_id"]').val(user_id);
                $(this).find('input[name="amount"]').val(amount);
            });
        });

        setTimeout(function() {
            var messageContainer = document.getElementById('messageContainer');
            if (messageContainer) {
                messageContainer.style.display = 'none';
            }
        }, 3000); // 3 seconds
    </script>
</body>

</html>
