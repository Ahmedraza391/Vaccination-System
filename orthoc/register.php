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
                            <input type="text" placeholder="Enter Contact" class="form-control" name="p_contact" required><br>
                            <input type="text" placeholder="Enter Address" class="form-control" name="p_address" required><br>
                            <input type="file" class="form-control" name="p_image" required><br>
                            <div class="d-flex mb-2">
                                <div class="form-check mx-1 ">
                                    <input class="form-check-input" type="radio" name="p_gender" value="male" id="male" required>
                                    <label class="form-check-label text-dark fw-bold" for="male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check mx-1 ">
                                    <input class="form-check-input" type="radio" name="p_gender" value="female" id="female" required>
                                    <label class="form-check-label text-dark fw-bold" for="female">
                                        Female
                                    </label>
                                </div>
                            </div>
                            <select name="p_city" class="form-select">
                                <option hidden>Select Any City</option>
                                <?php
                                    $query = "SELECT * FROM tbl_city";
                                    $result = mysqli_query($connection,$query);
                                    foreach($result as $row){
                                        echo "<option value='$row[id]'>$row[city]</option>";
                                    }
                                ?>
                            </select>
                            <input type="submit" value="Register Patient" name="register_btn" class="success">
                        </form>
                        <?php
                            if(isset($_POST['register_btn'])){
                                $name = $_POST['p_name'];
                                $email = $_POST['p_email'];
                                $password = $_POST['p_password'];
                                $contact = $_POST['p_contact'];
                                $address = $_POST['p_address'];
                                $gender = $_POST['p_gender'];
                                $image_name = $_FILES['p_image']['name'];
                                $tmp_name = $_FILES['p_image']['tmp_name'];
                                $path = "..//admin_panel//assets//img//patients//$email//";
                                if(!file_exists($path)){
                                    mkdir($path,0777,true);
                                    $path .= "$image_name";
                                    move_uploaded_file($tmp_name,$path);
                                }
                                $city = $_POST['p_city'];
                                $insert_query = "INSERT INTO tbl_patient (name,email,password,contact,image,cid,address,gender)VALUES('$name','$email','$password','$contact','$path','$city','$address','$gender')";
                                $insert_result = mysqli_query($connection,$insert_query);
                                if($insert_result){
                                    echo "<script>alert('Patient Register Successfully');</script>";
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <!-- <div class="col-md-6">
                    <div class="rightSide">
                        <div class="image">
                            <img src="../orthoc//images//d2.jpg" class="w-100 rounded " alt="">
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Signup Section -->
<?php require("bottom.php"); ?> 