<?php
    // session_start();
    include("connection.php");
?>
<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar navbar-dark">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3><i class="fa fa-user-edit me-2"></i>Admin Panel</h3>
        </a>

        <div class=" ms-4 mb-4">
            <a href="admin_profile.php" class="d-flex text-decoration-none text-white align-items-center">
                <div class="position-relative">
                    <?php
                        $session = $_SESSION['sign_in']['id'];
                        $query = "SELECT * FROM tbl_admin WHERE id = $session";
                        $result = mysqli_fetch_assoc(mysqli_query($connection,$query));
                    ?>
                    <img class="rounded-circle" src="<?php echo $result['image'];?>" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0"><?php echo $result['name'];?></h6>
                    <span>Admin</span>
                </div>
            </a>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link <?php if($page == "home"){echo "active";} ?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="hospital.php" class="nav-item nav-link <?php if($page == "hospital"){echo "active";} ?>"><i class="fa-solid fa-hospital me-2"></i>Hospitals</a>
            <a href="patients.php" class="nav-item nav-link <?php if($page == "patient"){echo "active";} ?>"><i class="fas fa-hospital-user me-2"></i>Patients</a>
            <a href="appointment.php" class="nav-item nav-link <?php if($page == "appointment"){echo "active";} ?>"><i class="fas fa-calendar-check me-2 "></i>Appointments</a>
            <a href="covid_test.php" class="nav-item nav-link <?php if($page == "test"){echo "active";} ?>"><i class="fas fa-vial me-2 "></i>Covid Test</a>
            <a href="view_vaccine.php" class="nav-item nav-link <?php if($page == "vaccine"){echo "active";} ?>"><i class="fas fa-syringe me-2 "></i>Vaccines</a>
            <a href="post_slider.php" class="nav-item nav-link <?php if($page == "post_slider"){echo "active";} ?>"><i class="fas fa-comments me-2 "></i>Add Slider</a>
            <a href="feedback.php" class="nav-item nav-link <?php if($page == "feedback"){echo "active";} ?>"><i class="fas fa-comments me-2 "></i>Feedback</a>
            <a href="#" class="nav-item nav-link "><i class="fas fa-globe me-2 "></i>Website</a>
            <div class="nav-item dropdown">
                <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>More Options</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="signin.php" class="dropdown-item">Sign In</a>
                    <a href="signup.php" class="dropdown-item">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->