<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include database connection
    include '/opt/lampp/htdocs/vizzie_system/web/config.php';

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO bnb_details (title, description, price, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $title, $description, $price, $imagePath);

    // Set parameters
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Check if file is uploaded successfully
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Generate a unique filename to prevent collisions
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $imagePath = '/opt/lampp/htdocs/vizzie_system/web/assets/images/' . $fileName;

        // Move uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "New Airbnb option added successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        echo "Error uploading file: " . $_FILES['image']['error'];
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
}
?>
