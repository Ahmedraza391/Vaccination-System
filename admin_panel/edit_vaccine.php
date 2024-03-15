<?php
session_start();
include("connection.php");
?>
<?php include("top.php"); ?>
    <title>Edit / Vaccine</title>
    <div class="container-fluid position-relative d-flex p-0">
        <?php
        include("sidebar.php");
        ?>
        <!-- Content Start -->
        <div class="content">
            <?php
            include("navbar.php");
            ?>
            <!-- Hospital Form -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-sm-12 col-md-10 ">
                        <div class="bg-green rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center position-relative  justify-content-between mb-3">
                                <a href="view_vaccine.php" class="btn btn-white position-absolute mb-1"><i class="fas fa-long-arrow-alt-left"></i></a>
                                <h3 class="text-white ms-5">Edit / Update Vaccine</h3>
                            </div>
                            <?php
                                $query = "SELECT * FROM tbl_vaccine WHERE id = $_GET[id]";
                                $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
                            ?>
                            <form method="POST">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="<?php echo $result['name'] ?>" name="v_name" id="vname" placeholder="abc" required>
                                    <label for="vname">Vaccine Name</label>
                                </div>
                                <input type="submit" value="Update Hospital" class="btn btn-white" name="v_update_btn">
                            </form>
                            <?php
                            if (isset($_POST['v_update_btn'])) {
                                $name = $_POST['v_name'];
                                $insert_query = "UPDATE tbl_vaccine SET name = '$name' WHERE id = $result[id]";
                                $success = mysqli_query($connection, $insert_query);
                                if ($success) {
                                    echo "<script>alert('Vaccine Updated Successfully');window.location.href ='view_vaccine.php'</script>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hospital Form -->
        </div>
        <!-- Content End -->
    </div>
<?php include("bottom.php"); ?>