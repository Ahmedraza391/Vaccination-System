<?php
session_start();
include("connection.php");
?>
<?php require("top.php"); ?>
<title>Profile /</title>
<style>
    .header_section {
        background-color: #1fab89 !important;
    }
    .profile_section {
        margin-top: 100px !important;
    }
    .profile_photo img{
        width: 100%;
        height: 100%;
    }
</style>
    <?php require("sidebar.php");  ?>
    <?php require("navbar.php");  ?>
    <!-- profile -->
    <section class="profile_section">
        <div class="container p-4 p-md-5 my-3 sec_form_bg">
            <div class="sec_heading">
                <h2>Update Your Profile</h2>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <form method="POST" enctype="multipart/form-data" class="p-2">
                        <div class="profile_photo">
                            <?php
                                $session = $_SESSION['login']['id'];
                                $fetch_image_query = "SELECT * FROM tbl_patient WHERE id = $session ";
                                $fetch_image_result = mysqli_query($connection,$fetch_image_query);
                                $image = mysqli_fetch_assoc($fetch_image_result);
                                echo "<img src='$image[image]' />";
                            ?>
                        </div>
                        <input type="file" name="profile_image" class="form-control mb-2" required>
                        <input type="submit" class="profile_btn" value="Upload Image" name="update_image">
                    </form>
                    <?php
                        if(isset($_POST['update_image'])){
                            $fetch_tbl_for_image = "SELECT * FROM tbl_patient WHERE id = $session";
                            $fetch_tbl_result = mysqli_query($connection,$fetch_tbl_for_image);
                            $fetch_assoc = mysqli_fetch_assoc($fetch_tbl_result);
                            $image = $_FILES['profile_image']['name'];
                            $tmp_name = $_FILES['profile_image']['tmp_name'];
                            $path = "..//admin_panel//assets//img//patients//$email//$image";
                            move_uploaded_file($tmp_name,$path);
                            $image_query = "UPDATE tbl_patient SET image = '$path' WHERE id = $session";
                            $image_query_result = mysqli_query($connection,$image_query);
                            if($image_query_result){
                                echo "<script>alert('Profile Image Updated Sucessfully');window.location.href = 'profile.php'</script>";
                            }
                        }
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                        $fetch_query = "SELECT * FROM tbl_patient WHERE id = $session ";
                        $result = mysqli_query($connection,$fetch_query);
                        $fetch_result = mysqli_fetch_assoc($result);
                    ?>
                    <form method="POST" class="p-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="p_name" value="<?php echo $fetch_result['name']; ?>" id="pname" placeholder="Name">
                            <label for="pname">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="p_email" value="<?php echo $fetch_result['email']; ?>" id="pemail" placeholder="email@gmail.com">
                            <label for="pemail">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="p_password" value="<?php echo $fetch_result['password']; ?>" id="ppassword" placeholder="123xyz#@^$%">
                            <label for="ppassword">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="p_contact" value="<?php echo $fetch_result['contact']; ?>" id="pcontact" placeholder="111-222-333">
                            <label for="pcontact">Contact</label>
                        </div>
                        Male : <input type="radio" class="form-check-input me-2 " name="p_gender"<?php if($fetch_result['gender']=='male'){echo "checked";}else ?> value="male" id="pgender" placeholder="email@gmail.com">

                        Female : <input type="radio" class="form-check-input" name="p_gender" <?php if($fetch_result['gender']=='female'){echo "checked";} ?> value="female" id="pgender" placeholder="email@gmail.com">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="p_address" value="<?php echo $fetch_result['address']; ?>" id="paddress" placeholder="111-222-333">
                            <label for="paddress">Address</label>
                        </div>
                        <select class="form-select mb-3" name="p_city" >
                            <?php 
                                $fetch_city = "SELECT * FROM tbl_city";
                                $fetch_city_result = mysqli_query($connection,$fetch_city);
                                foreach($fetch_city_result as $row){
                                    echo "<option value='$row[id]'";if($fetch_result['cid']==$row['id']){echo "selected";}echo">"."$row[city]</option>";
                                }

                            ?>
                        </select>
                        <input type="submit" class="profile_btn" value="Update Profile" name="update_profile">
                    </form>
                   <?php
                        if(isset($_POST['update_profile'])){
                            $name = $_POST['p_name'];
                            $email = $_POST['p_email'];
                            $password = $_POST['p_password'];
                            $contact = $_POST['p_contact'];
                            $gender = $_POST['p_gender'];
                            $address = $_POST['p_address'];
                            $city = $_POST['p_city'];
                            $update_patient = "UPDATE tbl_patient SET name = '$name',email = '$email',password = '$password',contact='$contact',gender='$gender',address='$address',cid='$city' WHERE id = $session";
                            $update_query = mysqli_query($connection,$update_patient);
                            if($update_query){
                                echo "<script>alert('Profile Updated Sucessfully');window.location.href = 'profile.php'</script>";
                            }
                        }
                   ?>
                </div>
            </div>
        </div>
    </section>
    <!-- profile -->
    <?php
    require("footer.php");
    ?>
<?php require("bottom.php"); ?>