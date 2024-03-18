<?php
include("connection.php");
?>
<?php require("top.php"); ?>
<title>Singup / </title>
<style>
    .header_section{
        background-color: #1fab89 !important;
    }
</style>
    <?php
    require("sidebar.php");
    require("navbar.php");
    ?>

    <!-- Signup Section -->
    <div class="container signup-container">
        <div class="Content">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="leftSide">
                        <h2 class="text-center">Patient Registration</h2>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="text" placeholder="Enter Your Name" class="form-control" name="p_name" required><br>
                            <input type="email" placeholder="Enter Email" class="form-control" name="p_email" required><br>
                            <input type="password" placeholder="Enter Password" class="form-control" name="p_password" required><br>
                            <input type="submit" value="Register Patient" name="register_btn" class="success">
                        </form>
                        <?php
                            if(isset($_POST['register_btn'])){
                                $name = $_POST['p_name'];
                                $email = $_POST['p_email'];
                                $password = $_POST['p_password'];
                                $path = "..//admin_panel//assets//img//patients//$email//";
                                if(!file_exists($path)){
                                    mkdir($path,0777,true);
                                }
                                $insert_query = "INSERT INTO tbl_patient (name,email,password)VALUES('$name','$email','$password')";
                                $insert_result = mysqli_query($connection,$insert_query);
                                if($insert_result){
                                    echo "<script>alert('Patient Register Successfully');window.location.href = 'login.php';</script>";
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <!-- Signup Section -->
<?php require("bottom.php"); ?> 