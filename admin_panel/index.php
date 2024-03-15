<?php
session_start();
if (!isset($_SESSION['sign_in'])) {
    header('location:signin.php');
}
$page = "home";
include("connection.php");
?>
<?php include('top.php'); ?>
    <title>Home </title>
    <div class="container-fluid position-relative d-flex p-0">
        <?php
            include('sidebar.php');
        ?>
        <!-- Content Start -->
        <div class="content">
            <?php
            include('navbar.php');
            ?>
            
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-green rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <?php
                                    $query = "SELECT * FROM tbl_patient";
                                    $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
                                    $fetch = mysqli_num_rows(mysqli_query($connection, $query));
                                ?>
                                <p class="mb-2 fw-bold fs-6">Total Patients</p>
                                <h6 class="mb-0"><?php echo $fetch ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-green rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <?php
                                    $query = "SELECT * FROM tbl_hospital";
                                    $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
                                    $fetch = mysqli_num_rows(mysqli_query($connection, $query));
                                ?>
                                <p class="mb-2 fw-bold fs-6">Total Hospitals</p>
                                <h6 class="mb-0"><?php echo $fetch ?></h6>
                            </div>
                        </div>
                    </div>

                        <!-- next kamm ha ky jo index wala page is par covid test approved walay alag karna aur baqi alag -->

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-green rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <?php
                                    $query = "SELECT * FROM tbl_appointment";
                                    $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
                                    $fetch = mysqli_num_rows(mysqli_query($connection, $query));
                                ?>
                                <p class="mb-2 fw-bold fs-6">Total Appointments</p>
                                <h6 class="mb-0"><?php echo $fetch ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-green rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <?php
                                    $query = "SELECT * FROM tbl_test";
                                    $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
                                    $fetch = mysqli_num_rows(mysqli_query($connection, $query));
                                ?>
                                <p class="mb-2 fw-bold fs-6">Total Covid-Tests</p>
                                <h6 class="mb-0"><?php echo $fetch ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->
    </div>
<?php include("bottom.php"); ?>