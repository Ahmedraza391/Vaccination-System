<?php
session_start();
if (!isset($_SESSION['hospital'])) {
    header('location:signin.php');
}
$page = "home";
include("connection.php");
?>
<?php require("top.php"); ?>
    <title>Home</title>
    <div class="container-fluid position-relative d-flex p-0">
        <?php
        include('sidebar.php');
        ?>
        <div class="content">
            <?php
            include('navbar.php');
            ?>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-green rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <?php
                                    $query = "SELECT * FROM tbl_appointment WHERE hid = $_SESSION[hospital_id]";
                                    $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
                                    $fetch = mysqli_num_rows(mysqli_query($connection, $query));
                                ?>
                                <p class="mb-2 text-white fw-bold fs-6">Total Appointments</p>
                                <h6 class="mb-0"><?php echo $fetch; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-green rounded d-flex align-items-center justify-content-between p-4">
                            <div class="ms-3">
                                <?php
                                    $query = "SELECT * FROM tbl_test WHERE hid = $_SESSION[hospital_id]";
                                    $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
                                    $fetch = mysqli_num_rows(mysqli_query($connection, $query));
                                    if(empty($fetch)){
                                        $fetch = 0;
                                    }
                                ?>
                                <p class="mb-2 text-white fw-bold fs-6">Total Covid-Tests</p>
                                <h6 class="mb-0"><?php echo $fetch ; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require("bottom.php"); ?>