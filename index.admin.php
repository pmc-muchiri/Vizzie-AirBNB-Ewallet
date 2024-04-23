<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

session_start();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password using bcrypt
    $pass = password_hash($password, PASSWORD_DEFAULT);

    $select = mysqli_prepare($conn, "SELECT id, password FROM user_form WHERE email = ?");
    mysqli_stmt_bind_param($select, "s", $email);
    mysqli_stmt_execute($select);
    mysqli_stmt_store_result($select);
    mysqli_stmt_bind_result($select, $user_id, $hashed_password);
    mysqli_stmt_fetch($select);

    if(mysqli_stmt_num_rows($select) > 0 && password_verify($password, $hashed_password)){
        $_SESSION['user_id'] = $user_id;
        header('location: admin');
        exit;
    } else {
        $message = array(); // Initialize $message as an array
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
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
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
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

        .splash-container {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 10px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .remember-forgot {
            margin-bottom: 20px;
        }

        .btn {
            width: 100%;
        }

        .login-register {
            margin-top: 20px;
            text-align: center;
        }

        .register-link {
            color: #007bff;
        }
    </style>
</head>

<body>
    <!-- login page -->
    <div class="splash-container">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <h3 class="mb-1">Login Form</h3>
                        <p>Please enter your Admin information.</p>
                    </div>
                    <?php
                    if (isset($message)) {
                        foreach ($message as $msg) {
                            echo '<div class="alert alert-info" role="alert">' . $msg . '</div>';
                        }
                    }
                    ?>
                    <div class="form-group">
                        <input type="email" name="email" id="username" placeholder="Email" class="form-control form-control-lg" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="password" id="password" type="password" placeholder="Password" required>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox"> Remember Me</label>
                        <a href="#" class="">Forgot Password?</a>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Login as Member</button>
                    <div class="login-register">
                        <p>Don't have an account?<a href="register.php" class="register-link"> Register</a></p>
                        <p><a href="index.php" class="register-link">user</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end login page -->

    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>