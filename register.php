<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

$message = []; // Initialize an empty array for messages

if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $sname = mysqli_real_escape_string($conn, $_POST['sname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // Password confirmation check
    if($password != $cpassword) {
        $message[] = 'Confirm password does not match!';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Use bcrypt for password hashing

        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageSize = $image['size'];
        $imageTmpName = $image['tmp_name'];
        $imageFolder = '../assets/images/'.uniqid().'_'.$imageName;

        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('Query failed');

        if(mysqli_num_rows($select) > 0){
            $message[] = 'User already exists'; 
        } elseif($imageSize > 2000000) {
            $message[] = 'Image size is too large!';
        } else {
            $insert = mysqli_query($conn, "INSERT INTO `user_form` (name, fname, sname, email, contact, password, image) VALUES ('$name', '$fname', '$sname', '$email', '$contact', '$hashedPassword', '$imageFolder')") or die('Query failed');

            if($insert) {
                move_uploaded_file($imageTmpName, $imageFolder);
                $message[] = 'Registered successfully!';
                header('Location: index.php');
                exit;
            } else {
                $message[] = 'Registration failed!';
            }
        }
    }
}
?>



<!doctype html>
<html lang="en">

<?php if(!empty($message)): ?>
<div class="alert alert-danger" role="alert">
    <ul>
    <?php foreach($message as $msg): ?>
        <li><?php echo $msg; ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>vizzie .</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/styles.css">
    <link rel="stylesheet" href="assets/libs/css/styles.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <div class="container">
        
        <form action="" method="post" enctype="multipart/form-data">
                <div class="card-header">
                    <h3 class="mb-1">Registrations Form</h3>
                    <p>Please enter your user information.</p>
                </div>
            <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            }
            ?>
            <div class="card">
                <div class="card-body">
                <div class="form-group">
                        
                        <input type="text" name="name" placeholder="username" class="form-control form-control-lg" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        
                        <input type="text" name="fname" placeholder="first name" class="form-control form-control-lg" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        
                        <input type="text" name="sname" placeholder="second name" class="form-control form-control-lg" required="" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <input type="email" name="email" placeholder="email" class="form-control form-control-lg" required="" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <input type="number" name="contact" placeholder="contact" class="form-control form-control-lg" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="enter password" class="form-control form-control-lg" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="cpassword" placeholder="confirm password" class="form-control form-control-lg" required="">
                    </div>
                    <!-- <label for="">Upload your Profile</label>
                    <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required=""> -->
                    <div class="form-group pt-2">
                        <button class="btn btn-block btn-primary" name="submit" type="submit">Register My Account</button>
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
                        </label>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <p>Already a member? <a href="index.php" class="text-secondary">Login Here.</a></p>
                </div>
            </div>
        </form>
    </div>

</body>

 
</html>