<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include '/opt/lampp/htdocs/vizzie_system/web/config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$currency_query = "SELECT currency_symbol FROM currency ORDER BY currency_symbol ASC";
$currency_result = mysqli_query($conn, $currency_query);

// Check for errors
if (!$currency_result) {
    die("Error: " . mysqli_error($conn));
}



// Fetch email from user_form table based on user_id
$user_id = $_SESSION['user_id'];
$email_query = "SELECT email FROM user_form WHERE id = '$user_id'";
$email_result = mysqli_query($conn, $email_query);

if ($email_row = mysqli_fetch_assoc($email_result)) {
    $email = $email_row['email'];
} else {
    $email = ''; // Set default email value if user email is not found
}

function generateRandomChar() {
    return chr(mt_rand(65, 90)); // ASCII values for A-Z
}

// Generate a unique transaction code
$transaction_code = 'TRC' . mt_rand(1, 9) . '-' . generateRandomChar() . generateRandomChar() . generateRandomChar() . date('y');

if (isset($_POST['submit'])) {
    // Validate that deposit_amount is not empty
    if (!empty($_POST['deposit_amount'])) {
        // Retrieve form data
        $transaction_code = mysqli_real_escape_string($conn, $_POST['transaction_code']);
        $deposit_amount = mysqli_real_escape_string($conn, $_POST['deposit_amount']);
        $currency = mysqli_real_escape_string($conn, $_POST['currency']);
        $payment_gateway = mysqli_real_escape_string($conn, $_POST['payment_gateway']);
        $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

        // Insert data into the deposits table
        $insert_query = "INSERT INTO deposits (user_id, transaction_code, email, deposit_amount, currency, payment_gateway, remarks, datetime, status) 
                 VALUES ('$user_id', '$transaction_code', '$email', '$deposit_amount', '$currency', '$payment_gateway', '$remarks', NOW(), 'Paid')";

        if (mysqli_query($conn, $insert_query)) {
            // Calculate total deposit amount for the user
            $total_deposit_query = "SELECT SUM(deposit_amount) AS total_deposit FROM deposits WHERE user_id = '$user_id'";
            $total_deposit_result = mysqli_query($conn, $total_deposit_query);
            $total_deposit_row = mysqli_fetch_assoc($total_deposit_result);
            $total_deposit = $total_deposit_row['total_deposit'];

            // Fetch current deposit amount from user_deposit_total table
            $current_deposit_query = "SELECT current_deposit FROM user_deposit_total WHERE user_id = '$user_id'";
            $current_deposit_result = mysqli_query($conn, $current_deposit_query);
            $current_deposit_row = mysqli_fetch_assoc($current_deposit_result);
            $current_deposit = $current_deposit_row['current_deposit'];

            // Update current deposit amount
            $new_deposit = $current_deposit + $deposit_amount;

            // Check if the user's total deposit already exists in user_deposit_total table
            $check_total_deposit_query = "SELECT * FROM user_deposit_total WHERE user_id = '$user_id'";
            $check_total_deposit_result = mysqli_query($conn, $check_total_deposit_query);

            if (mysqli_num_rows($check_total_deposit_result) > 0) {
                // Update total deposit amount
                $update_total_deposit_query = "UPDATE user_deposit_total SET current_deposit = '$new_deposit', total_deposit = '$total_deposit' WHERE user_id = '$user_id'";
                mysqli_query($conn, $update_total_deposit_query);
            } else {
                // Insert new record
                $insert_total_deposit_query = "INSERT INTO user_deposit_total (user_id, current_deposit, total_deposit) VALUES ('$user_id', '$new_deposit', '$total_deposit')";
                mysqli_query($conn, $insert_total_deposit_query);
            }

            $message[] = 'Deposited successfully!';
        } else {
            $message[] = 'Failed to store deposit information. Please try again later.';
        }
    } else {
        $message[] = 'Deposit amount cannot be empty.';
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
                            <h2 class="pageheader-title"><i class="fa fa-fw fa-file"></i> Deposit Form </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Deposit</a></li>
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="mb-0">Deposit Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <form class="needs-validation" action="" method="post" novalidate="">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="firstName">Transaction Code</label>
                                                        <input type="text" class="form-control" name="transaction_code" value="<?php echo $transaction_code; ?>" required readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="lastName">Email</label>
                                                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="lastName">Deposit Amount</label>
                                                        <input type="text" class="form-control" name="deposit_amount" placeholder="5000" required="">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="firstName">Currency</label>
                                                        <select class="custom-select d-block w-100" name="currency" required="">
                                                            <option value="">Choose...</option>
                                                            <?php
                                                            // Fetch currency data from the database
                                                            // $currency_result = mysqli_query($conn, "SELECT currency_symbol FROM currency");
                                                            if ($currency_result) {
                                                                // Loop through the results and generate option tags
                                                                while ($row = mysqli_fetch_assoc($currency_result)) {
                                                                    echo '<option>' . $row['currency_symbol'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="lastName">Payment Gateway</label>
                                                        <select class="custom-select d-block w-100" name="payment_gateway" required="">
                                                            <option value="">Choose...</option>
                                                            <?php
                                                            //Fetch currency data from the database
                                                            $payment_result = mysqli_query($conn, "SELECT payment_gateway FROM payment_gateway");
                                                            if ($payment_result) {
                                                                // Loop through the results and generate option tags
                                                                while ($row = mysqli_fetch_assoc($payment_result)) {
                                                                    echo '<option>' . $row['payment_gateway'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="lastName">Remarks</label>
                                                        <input type="text" class="form-control" name="remarks" placeholder="Remarks" required="">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row text-right">
                                                    <div class="col col-sm-10 col-lg-12 offset-lg-0">
                                                        <button type="submit" name="submit" class="btn btn-space btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-space btn-secondary">Reset</button>
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
