<?php
    session_start();
    include("connection.php");
?>
<?php include("top.php"); ?>
    <title>Add Patient /</title>
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
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                        <div class="bg-green rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3 position-relative ">
                                <a href="patients.php" class="btn btn-white position-absolute start-0 mb-1 "><i class="fas fa-long-arrow-alt-left"></i></a>
                                    <h3 class="text-white ms-5">Register New Patient</h3>
                            </div>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="p_name" id="pname" placeholder="abc" required>
                                    <label for="pname">Patient Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="p_email" id="pemail" placeholder="name@example.com" required>
                                    <label for="pemail">Patient Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="p_password" id="ppassword" placeholder="abc123#@#$" required>
                                    <label for="ppassword">Patient Password</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="p_contact" id="pcontact" placeholder="contact no" required>
                                    <label for="pcontact">Patient Contact No</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="p_address" id="paddress" placeholder="Password" required>
                                    <label for="paddress">Patient Address</label>
                                </div>
                                <select name="p_city" class="form-select mb-3">
                                    <option hidden >------Select City-------</option>
                                    <?php
                                        $query = "SELECT * FROM tbl_city";
                                        $run_q = mysqli_query($connection,$query);
                                        foreach($run_q as $var){
                                            echo "<option value='$var[id]'>$var[city]</option>";
                                        }

                                    ?>
                                </select>
                                <select name="p_status" class="form-select mb-4">
                                    <option hidden>---------Select Status---------</option>
                                    <option value="activate">Activate</option>
                                    <option value="deactivate">Deactivate</option>
                                </select>
                                <select name="p_gender" class="form-select mb-4">
                                    <option hidden>---------Select Gender---------</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <input type="file" class="form-control mb-3" name="p_image">
                                <input type="submit" value="Register Patient" class="btn btn-white" name="p_register_btn">
                            </form>
                            <?php
                                if(isset($_POST['p_register_btn'])){
                                    $name = $_POST['p_name'];
                                    $email = $_POST['p_email'];
                                    $password = $_POST['p_password'];
                                    $contact = $_POST['p_contact'];
                                    $address = $_POST['p_address'];
                                    $city = $_POST['p_city'];
                                    $status = $_POST['p_status'];
                                    $gender = $_POST['p_gender'];
                                    $image_name = $_FILES['p_image']['name'];
                                    $tmp_name = $_FILES['p_image']['tmp_name'];
                                    $folder = "../admin_panel/assets/img/patient/$name";
                                    if(!file_exists($name)){    
                                        mkdir($folder,0777,true);
                                        $path = $folder .= "/"."$image_name";
                                        move_uploaded_file($tmp_name,$path);
                                    }
                                    $insert_query = "INSERT INTO tbl_patient(name,email,password,contact,cid,image,address,gender,status)VALUES('$name','$email','$password','$contact','$city','$path','$address','$gender','$status')";
                                    $success = mysqli_query($connection,$insert_query);
                                    if($success){
                                        echo "<script>alert('Patient Inserted Successfully')</script>";
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