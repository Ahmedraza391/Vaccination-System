<?php
    include("connection.php");
?>
<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-white navbar-dark sticky-top px-4 py-0">
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <button class="nav-link btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                    $session = $_SESSION['hospital']['id'];
                    $query = "SELECT * FROM tbl_hospital WHERE id = $session";
                    $result = mysqli_fetch_assoc(mysqli_query($connection,$query));
                ?>
                <img class="rounded-circle me-lg-2" src="<?php echo $result['image'];?>" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex"><?php echo $result['name'];?></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <a href="hospital_profile.php" class="dropdown-item">My Profile</a>
                <a href="signout.php" class="dropdown-item">Log Out</a>
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar End -->