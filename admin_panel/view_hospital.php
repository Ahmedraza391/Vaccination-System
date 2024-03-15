<?php
session_start();
include("connection.php");
?>
<?php include("top.php"); ?>
<title>Hospital's Information</title>
<style>
    @media screen and (max-width:330px) {
        .d-small-none{
            padding: 7px !important;
            font-size: 10px;
            margin-top: 6px !important;
        }
        
    }
</style>
<div class="container-fluid position-relative d-flex p-0">
    <?php
    include("sidebar.php");
    ?>
    <!-- Content Start -->
    <div class="content">
        <?php
        include("navbar.php");
        ?>

        <?php
            $id = $_GET['id'];
            $insert_query = "SELECT tbl_hospital.*,tbl_city.city FROM tbl_hospital INNER JOIN tbl_city ON tbl_hospital.cid = tbl_city.id WHERE tbl_hospital.id = $id";
            $check_result = mysqli_fetch_assoc(mysqli_query($connection, $insert_query));
        ?>
        <div class="container position-relative ">
            <div class="row m-0 mt-3">
                <div class="col-sm-12 col-md-2">
                    <a href="hospital.php" class="btn btn-green d-small-none position-absolute mt-1 me-1 ms-md-3"><i class="fas fa-long-arrow-alt-left"></i></a>
                </div>
                <div class="col-sm-12 col-md-10 p-0 w-100 ">
                    <h2 class="text-center bg-white green fs-2 rounded-2 py-2"><?php echo $check_result['name'] ?></h2>
                </div>
            </div>
            <div class="row m-0 bg-green p-md-5 p-2">
                <div class="col-sm-12 col-md-4 p-0">
                    <div class="image h-100 ">
                        <img src="<?php echo $check_result['image']; ?>" class="w-100 h-100 rounded border border-white border-2 " alt="">
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 p-0">
                    <div class="info">
                        <ul class="list-group w-100 h-100 ">
                            <li class="list-group-item">Name : <?php echo $check_result['name'] ?></li>
                            <li class="list-group-item">Email : <?php echo $check_result['email'] ?></li>
                            <li class="list-group-item">Password : <?php echo $check_result['password'] ?></li>
                            <li class="list-group-item">Contact : <?php echo $check_result['contact'] ?></li>
                            <li class="list-group-item">City : <?php echo $check_result['city'] ?></li>
                            <li class="list-group-item">Address : <?php echo $check_result['address'] ?></li>
                            <li class="list-group-item">Status : <?php echo $check_result['status'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Content End -->
</div>
<?php include("bottom.php"); ?>