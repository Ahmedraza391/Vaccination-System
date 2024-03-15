<?php
    session_start();
    include("connection.php");
?>
<?php include("top.php"); ?>
    <title>Add Vaccine</title>
    <div class="container-fluid position-relative d-flex p-0"> 
        <?php
            include("sidebar.php");
        ?>
        <!-- Content Start -->
        <div class="content">
            <?php
                include("navbar.php");
            ?>
            <!-- Patient Form -->
            <div class="container-fluid">
                <div class="row h-100 justify-content-center">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                        <div class="bg-green rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3 position-relative ">
                                <a href="view_vaccine.php" class="btn btn-white position-absolute start-0 mb-1 "><i class="fas fa-long-arrow-alt-left"></i></a>
                                    <h3 class="text-white ms-5">Add New Vaccine</h3>
                            </div>
                            <form method="POST">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="v_name" id="pname" placeholder="abc" required>
                                    <label for="pname">Vaccine Name</label>
                                </div>
                                <input type="submit" value="Add Vaccine" class="btn btn-white" name="p_register_btn">
                            </form>
                            <?php
                                if(isset($_POST['p_register_btn'])){
                                    $name = $_POST['v_name'];
                                    $insert_query = "INSERT INTO tbl_vaccine(name,status)VALUES('$name','available')";
                                    $success = mysqli_query($connection,$insert_query);
                                    if($success){
                                        echo "<script>alert('Vaccine Inserted Successfully');window.location.href  = 'view_vaccine.php'</script>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Patient Form -->
        </div>
        <!-- Content End -->
    </div>
<?php include("bottom.php"); ?>