<?php
    // session_start();
    include("connection.php");
    $fileName = basename($_SERVER['PHP_SELF']);
?>
<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-green navbar-dark">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-white"><i class="fa fa-user-edit me-2"></i>Hospital</h3>
        </a>

        <div class=" ms-4 mb-4">
            <a href="hospital_profile.php" class="d-flex align-items-center text-decoration-none ">
                <div class="position-relative">
                    <?php
                        $session = $_SESSION['hospital']['id'];
                        $query = "SELECT * FROM tbl_hospital WHERE id = $session";
                        $result = mysqli_fetch_assoc(mysqli_query($connection,$query));
                    ?>
                    <img class="rounded-circle" src="<?php echo $result['image'];?>" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white "><?php echo $result['name'];?></h6>
                </div>
            </a>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link p-3 <?php if($page == "home"){echo "active";} ?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="appointment.php" class="nav-item nav-link p-3 <?php if($page == "appointment"){echo "active";} ?>"><i class="fas fa-calendar-check me-2 "></i>Appointments</a>
            <a href="covid_test.php" class="nav-item nav-link p-3 <?php if($page == "test"){echo "active";} ?>"><i class="fas fa-vial me-2 "></i>Covid Test</a>
            <a href="../orthoc/" class="nav-item nav-link p-3 "><i class="fas fa-globe me-2 "></i>Back To Website</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->