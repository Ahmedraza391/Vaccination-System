<?php
    session_start();
    include("connection.php");
?>
<?php include("top.php") ?>
    <title>Add Hospital /</title>
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
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                        <div class="bg-green rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3 position-relative ">
                                <a href="hospital.php" class="btn btn-white position-absolute start-0 mb-1 "><i class="fas fa-long-arrow-alt-left"></i></a>
                                <h3 class="text-white ms-5"></i>Register Hospital</h3>
                            </div>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="h_name" id="hname" placeholder="abc" required>
                                    <label for="hname">Hospital Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="h_email" id="hemail" placeholder="name@example.com" required>
                                    <label for="hemail">Hospital Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="h_password" id="hpassword" placeholder="abc123#@#$" required>
                                    <label for="hpassword">Hospital Password</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="h_contact" id="hcontact" placeholder="contact no" required>
                                    <label for="hcontact">Hospital Contact No</label>
                                </div>
                                <select name="h_city" class="form-select mb-3">
                                    <option hidden >------Select Any City-------</option>
                                    <?php
                                        $query = "SELECT * FROM tbl_city";
                                        $run_q = mysqli_query($connection,$query);
                                        foreach($run_q as $var){
                                            echo "<option value='$var[id]'>$var[city]</option>";
                                        }

                                    ?>
                                </select>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="h_address" id="haddress" placeholder="Password" required>
                                    <label for="haddress">Hospital Address</label>
                                </div>
                                <select name="h_status" class="form-select mb-4">
                                    <option hidden>---------Select Any Status---------</option>
                                    <option value="activate">Activate</option>
                                    <option value="deactivate">Deactivate</option>
                                </select>
                                <input type="file" class="form-control mb-3" name="h_image">
                                <input type="submit" value="Register Hospital" class="btn btn-white" name="h_register_btn">
                            </form>
                            <?php
                                if(isset($_POST['h_register_btn'])){
                                    $name = $_POST['h_name'];
                                    $email = $_POST['h_email'];
                                    $password = $_POST['h_password'];
                                    $contact = $_POST['h_contact'];
                                    $city = $_POST['h_city'];
                                    $address = $_POST['h_address'];
                                    $status = $_POST['h_status'];
                                    $image_name = $_FILES['h_image']['name'];
                                    $tmp_name = $_FILES['h_image']['tmp_name'];
                                    $folder = "../orthoc/assets/images/hospital-images/$email/";
                                    if(!file_exists($email)){    
                                        mkdir($folder,0777,true);
                                        $path = $folder .= "/"."$image_name";
                                        move_uploaded_file($tmp_name,$path);
                                    }
                                    $insert_query = "INSERT INTO tbl_hospital(name,email,password,contact,cid,image,address,status)VALUES('$name','$email','$password','$contact','$city','$path','$address','$status')";
                                    $success = mysqli_query($connection,$insert_query);
                                    if($success){
                                        echo "<script>alert('Hospital Inserted Successfully')</script>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hospital Form -->
            <?php
                include('footer.php');
            ?> 
        </div>
        <!-- Content End -->
    </div>
<?php include("bottom.php") ?>