<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Include database connection
include '/opt/lampp/htdocs/vizzie_system/web/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO bnb_details (title, description, price, image_path, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $title, $description, $price, $imagePath, $location);

    // Set parameters
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location =  $_POST['location'];

    // Check if file is uploaded successfully
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Generate a unique filename to prevent collisions
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $imagePath = '../admin/upload_images/' . $fileName;

        // Create the upload_images directory if it doesn't exist
        if (!file_exists('../admin/upload_images')) {
            mkdir('../admin/upload_images', 0777, true);
        }

        // Move uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            // Execute the prepared statement
            if ($stmt->execute()) {
                $_SESSION['update-bnb'] = "New Airbnb option added successfully.";
            } else {
                $_SESSION['update-bnb'] = "Error: " . $stmt->error;
            }
        } else {
            $_SESSION['update-bnb'] = "Error moving uploaded file.";
        }
    } else {
        $_SESSION['update-bnb'] = "Error uploading file: " . $_FILES['image']['error'];
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
}
if (isset($_SESSION['update-bnb'])) {
    $message = array($_SESSION['update-bnb']);
    // Unset the session variable
    unset($_SESSION['update-bnb']);
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
                          <h2 class="pageheader-title"><i class="fa fa-fw fa-sync"></i> Add new Airbnb </h2>
                            <div class="page-breadcrumb">
                            <div class="page-breadcrumb">
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Dashboard</a></li>
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
                    <!-- ============================================================== -->
                    <!-- Add Airbnb Option Form -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add Airbnb Option</h5>
                                <form action="update-bnb.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required placeholder="Goshen AirBNB">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" required placeholder="Nairobi Kenya">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" id="price" name="price" required placeholder="4500">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end Add Airbnb Option Form -->
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
