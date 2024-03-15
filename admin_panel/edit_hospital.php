<?php
session_start();
include("connection.php");
?>
<?php include("top.php") ?>
    <title>Edit / Update Hospital</title>
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
                                <a href="hospital.php" class="btn btn-white position-absolute mb-1"><i class="fas fa-long-arrow-alt-left"></i></a>
                                <h3 class="text-white ms-5"></i>Edit / Update Hospital</h3>
                            </div>
                            <?php
                                $fetch_image_query = "SELECT * FROM tbl_hospital WHERE id = $_GET[id]";
                                $fetch_image_result = mysqli_query($connection,$fetch_image_query);
                                $fetch_assoc = mysqli_fetch_assoc($fetch_image_result);
                            ?>  
                            <div class="image mb-2 ">
                                <img src="<?php echo $fetch_assoc['image']; ?>" width="100%" height="370px" alt="">
                            </div>
                            <form method="POST" enctype="multipart/form-data" class="mb-4">
                                <input type="file" class="form-control" name="hospital_image" required>
                                <input type="submit" class="btn btn-white mt-2" value="Update Image" name="btn_image">
                            </form>
                            <?php
                            if (isset($_POST['btn_image'])) {
                                $hemail = $fetch_assoc['email'];
                                $img = $_FILES['hospital_image']['name'];
                                $tmp_name = $_FILES['hospital_image']['tmp_name'];
                                $path = "../orthoc/assets/images/hospital-images/$hemail/$img";
                                move_uploaded_file($tmp_name,$path);
                                $insert_image_query = "UPDATE tbl_hospital SET image = '$path' WHERE id = $_GET[id]";
                                $insert_image_result = mysqli_query($connection, $insert_image_query);
                                if ($insert_image_result) {
                                    echo "<script>alert('Image Updated Successfully');window.location.href = 'hospital.php'</script>";
                                }
                            }
                            ?>
                            <?php
                            $query = "SELECT * FROM tbl_hospital WHERE id = $_GET[id]";
                            $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
                            ?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="<?php echo $result['name'] ?>" name="h_name" id="hname" placeholder="abc" required>
                                    <label for="hname">Hospital Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" value="<?php echo $result['email'] ?>" name="h_email" id="hemail" placeholder="name@example.com" required>
                                    <label for="hemail">Hospital Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="<?php echo $result['password'] ?>" name="h_password" id="hpassword" placeholder="abc123#@#$" required>
                                    <label for="hpassword">Hospital Password</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" value="<?php echo $result['contact'] ?>" name="h_contact" id="hcontact" placeholder="contact no" required>
                                    <label for="hcontact">Hospital Contact No</label>
                                </div>
                                <select name="h_city" class="form-select mb-3">
                                    <?php
                                    $query = "SELECT * FROM tbl_city";
                                    $run_q = mysqli_query($connection, $query);
                                    foreach ($run_q as $row) {
                                        echo "<option value='$row[id]'";
                                        if($result['cid']==$row['id']){echo "selected";}
                                        echo">"."$row[city]</option>";
                                    }
                                    ?>
                                </select>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" value="<?php echo $result['address'] ?>" name="h_address" id="haddress" placeholder="Password" required>
                                    <label for="haddress">Hospital Address</label>
                                </div>
                                <select name="h_status" class="form-select mb-3">
                                    <option hidden>---------Select Any Status-----------</option>
                                    <?php
                                        // for selected status
                                        $status_selected = mysqli_query($connection,"SELECT * FROM tbl_hospital");
                                        $fetch_selected = mysqli_fetch_assoc($status_selected);
                                        if($fetch_selected['status']=='activate'){
                                            echo "<option value='activate' selected>Activate</option>";
                                            echo "<option value='deactivate'>Deactivate</option>";
                                        }else if($fetch_selected['status']=='activate'){
                                            echo "<option value='activate'>Activate</option>";
                                            echo "<option value='deactivate' selected>Deactivate</option>"; 
                                        }
                                    ?>
                                </select>
                                <input type="submit" value="Update Hospital" class="btn btn-white" name="h_update_btn">
                            </form>
                            <?php
                            if (isset($_POST['h_update_btn'])) {
                                $name = $_POST['h_name'];
                                $email = $_POST['h_email'];
                                $password = $_POST['h_password'];
                                $contact = $_POST['h_contact'];
                                $city = $_POST['h_city'];
                                $address = $_POST['h_address'];
                                $status = $_POST['h_status'];
                                $insert_query = "UPDATE tbl_hospital SET name = '$name',email ='$email', password = '$password', contact = '$contact', cid = '$city', address = '$address', status = '$status' WHERE id = $result[id]";
                                $success = mysqli_query($connection, $insert_query);
                                if ($success) {
                                    echo "<script>alert('Hospital Updated Successfully');window.location.href ='hospital.php'</script>";
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
<?php include("bottom.php") ?>