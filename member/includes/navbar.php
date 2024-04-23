<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include __DIR__ . '/../web/config.php';
$conn = mysqli_connect('localhost','root','','user_db') or die('connection failed');
@session_start();

// Check if the user is not logged in, redirect to login page
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header('location: /web/index.php');
    exit; // Ensure script stops executing after redirection
}

// Fetch user information based on the user ID stored in the session
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user_form WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$fetch = mysqli_fetch_assoc($result);

if(isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('location: /vizzie_system/web/index.php');
    exit; // Ensure script stops executing after redirection
}
?>


<!-- ============================================================== -->
<!-- navbar -->
<!-- ============================================================== -->
<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">Vizzie .</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                <li class="nav-item">
                    <div id="custom-search" class="top-search-bar">
                        <input class="form-control" type="text" placeholder="Search..">
                    </div>
                </li>
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if(isset($fetch['image']) && !empty($fetch['image'])): ?>
                        <img src="../assets/images/default-avatar.png" alt="Default Profile Picture" class="user-avatar-md rounded-circle">
                        <!-- <img src="<?php echo $fetch['image']; ?>" alt="User Profile Picture" class="user-avatar-md rounded-circle"> -->
                    <?php else: ?>
                        <!-- Default profile picture or placeholder -->
                        <img src="../assets/images/default-avatar.png" alt="Default Profile Picture" class="user-avatar-md rounded-circle">
                    <?php endif; ?>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                        <h5 class="mb-0 text-white nav-user-name"><?php echo $fetch['fname'] . ' ' . $fetch['sname']; ?></h5>

                            <span class="status"></span><span class="ml-2">Member</span>
                        </div>
                        <a class="dropdown-item" href="/vizzie_system/web/member/profile.php"><i class="fas fa-user mr-2"></i>Account</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                        <a class="dropdown-item" href="/vizzie_system/web/home.php?logout=<?php echo $user_id; ?>"><i class="fas fa-power-off mr-2"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- end navbar -->
