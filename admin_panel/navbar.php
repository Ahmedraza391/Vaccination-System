<?php
    include("connection.php");
?>
<!-- Navbar Start -->
<nav class="navbar navbar-expand navbar-dark bg-white sticky-top px-4 py-0 shadow">
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <?php
                    $session = $_SESSION['sign_in']['id'];
                    $query = "SELECT * FROM tbl_admin WHERE id = $session";
                    $result = mysqli_fetch_assoc(mysqli_query($connection,$query));
                ?>
                <img class="rounded-circle border border-1 border-success me-lg-2" src="<?php echo $result['image'];?>" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex"><?php echo $result['name'];?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0">
                <a href="admin_profile.php" class="dropdown-item">My Profile</a>
                <a href="logout.php" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->