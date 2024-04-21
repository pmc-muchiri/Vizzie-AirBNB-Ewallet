 <?php
 include ('config.php');
 if(isset($_POST['submit'])){
    
    // $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img'/.$image;

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $message[] = 'User already exist'
    }else{
        if($password != $cpassword)
        $message[] = 'Confirm password not matched';
    }elseif($image_size > 2000000){
        $message[] = 'Image size too large!';
    }else{
        $insert = mysqli_query($conn, "INSERT INTO `users`(username, email, password, address, phone) VALUES ($username, $email, $password, $address, $phone)") or die('query failed');

        if ($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registration successful!';
            header('location:login.php');
        }else{
            $message[] = 'registration failed!';
        }
    }
 }
 ?>
 
 <!-- register section -->
 <div class="form-box register">
    <h2>Register</h2>
    <form method="post" action="connect.php">
        <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message">'.$message.'</div>';
            }
        }
        ?>
        <div class="input-grid">
            <!-- Row 1 -->
            <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <!-- Row 2 -->
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="cpassword" required>
                <label>Confirm Password</label>
            </div>
            <!-- <div class="input-box">
                <span class="icon">  <ion-icon name="calendar"></ion-icon></span> 
                <input type="date" name="" required>
                <label>Birthdate</label>
            </div> -->
            <div class="input-box">
                <span class="icon"><ion-icon name="location"></ion-icon></span>
                <input type="text" name="address" required>
                <label>Address</label>
            </div>
            <!-- Row 3 -->
            <div class="input-box">
                <span class="icon"><ion-icon name="phone-portrait"></ion-icon></span>
                <input type="tel" name="phone" required>
                <label>Phone</label>
            </div>
            <div class="input-box">
                <input type="file" class="box" acc>
            </div>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox" required> Agree to the terms & conditions</label>
        </div>
        <button class="btn" name="submit" type="submit">Register</button>
        <div class="login-register">
            <p>Already have an account? <a href="#" class="login-link"> Login</a></p>
        </div>
    </form>
</div>