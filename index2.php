<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizzie e-Wallet System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/libs/css/styles.css">
</head>
<body>
<?php
       include ('inc/header.php');
       ?>
    <div class="content-home">
        <h1>Welcome to Vizzie Airbnb E-wallet System</h1>
        <p>Experience seamless and secure transactions with Vizzie's cutting-edge e-Wallet designed exclusively for Airbnb hosts and guests. Manage your finances effortlessly, whether it's receiving payments, making reservations, or accessing exclusive offers. Join the Vizzie community today and unlock a new level of convenience and peace of mind for your Airbnb experience.</p>
        <a href="index.php" class="welcome-btn">Get Started</a>
    </div>
    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>
        <?php
       include ('inc/login.php');
       ?>
       <?php
       include ('inc/register.php');
       ?>
    </div>
    <?php
    include ('inc/footer.php');
    ?>
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>