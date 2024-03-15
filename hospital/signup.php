<?php 
    include("connection.php");
    require("top.php"); 
?>
    <title>Hospital Singup / </title>
    <div class="container-fluid d-flex p-0">
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                    <div class="bg-green rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="../orthoc/index.php" class="text-white text-decoration-underline fs-3 ">/  Back</a>
                            <a href="index.html" class="text-decoration-none ">
                                <h3 class="text-white"><i class="fa fa-user-edit me-2"></i>Hospital Signup</h3>
                            </a>
                            <h3>Sign UP</h3>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="fname" name="hname" placeholder="">
                                <label for="fname">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="hemail" placeholder="">
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" name="hpassword" placeholder="">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="contact" name="hcontact" placeholder="">
                                <label for="contact">Contact No</label>
                            </div>
                            <select name="h_city" class="form-select mb-3">
                                <option hidden>Select Any City</option>
                                <?php
                                    $query = "SELECT * FROM tbl_city";
                                    $result = mysqli_query($connection,$query);
                                    foreach($result as $row){
                                        echo "<option value='$row[id]'>$row[city]</option>";
                                    }
                                ?>
                            </select>
                            <input type="file" class="form-control" name="himage" required><br>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="address" name="haddress" placeholder="">
                                <label for="address">Hospital Address</label>
                            </div>
                            <button type="submit" name="btn_add" class="btn btn-white py-3 w-100 mb-4">Sign Up</button>
                        </form>
                        <?php
                            if(isset($_POST['btn_add'])){
                                $name = $_POST['hname'];
                                $email = $_POST['hemail'];
                                $password = $_POST['hpassword'];
                                $contact = $_POST['hcontact'];
                                $image = $_FILES['himage']['name'];
                                $image_tmp_name = $_FILES['himage']['tmp_name'];
                                $path = "..//admin_panel//assets//img//hospital//$name//";
                                if(!file_exists($path)){
                                    mkdir($path,0777,true);
                                    $path .= $image;
                                    move_uploaded_file($image_tmp_name,$path);
                                }
                                $city = $_POST['h_city'];
                                $address = $_POST['haddress'];
                                // query for if hospital exists in table
                                $check_query = mysqli_query($connection,"SELECT * FROM tbl_hospital WHERE name = '$name' AND email = '$email' AND contact = '$contact'");
                                $fetch_query = mysqli_num_rows($check_query);
                                if($fetch_query>0){
                                    echo "<script>alert('Hospital Already Exists');</script>";
                                }else{
                                    $insert_query = "INSERT INTO tbl_hospital (name,email,password,contact,image,cid,address)VALUES('$name','$email','$password','$contact','$path','$city','$address')";
                                    $insert_result = mysqli_query($connection,$insert_query);
                                    if($insert_result){
                                        echo "<script>alert('Hospital Register Successfully & Wait For Activation');</script>";
                                    }
                                }
                            }
                        ?>
                        <p class="text-center mb-0">Do you have an Account? <a href="signin.php" class="text-white">Sign In</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->s
    </div>
<?php require("bottom.php"); ?>