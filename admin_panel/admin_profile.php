<?php
    include('connection.php');
    session_start();
?>
<?php include("top.php"); ?>
    <title>Admin Profile</title>
    <div class="container-fluid position-relative d-flex p-0">
        <?php
            include('sidebar.php');
        ?>
        <!-- Content Start -->
        <div class="content">
            <?php
                include('navbar.php');
            ?>
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center bg-white rounded py-1 green fs-1 ">Admin Profile</h1>
                    </div>
                </div>
                <div class="row m-0 bg-green rounded py-3">
                    <div class="col-md-4">
                        <div class="image_div">
                            <div class="image ms-md-2 ">
                                <img src="<?php echo $result['image'] ?>" alt="" class="mx-auto w-100 rounded " style="height: 380px;" >
                            </div>
                            <form class="d-flex flex-column" method="POST" enctype="multipart/form-data" >
                                <input type="file" name="image" class="form-control w-75 bg-secondary mx-auto my-2 " required>
                                <input type="submit" name="upload_image" class="btn btn-sm w-75 mx-auto btn-white " value="Update Image" >
                            </form>
                            <?php
                                if(isset($_POST['upload_image'])){
                                    $image_name = $_FILES['image']['name'];
                                    $tmp_name = $_FILES['image']['tmp_name'];
                                    $path = "assets/imgs/admin_images/.$image_name";
                                    move_uploaded_file($tmp_name,$path);
                                    $query = "UPDATE tbl_admin SET image = '$path' WHERE id = $result[id]";
                                    $image_update = mysqli_query($connection,$query);
                                    if($image_update){
                                        echo "
                                        <script>
                                            alert('Image Updated');
                                            window.location.href = 'index.php';
                                        </script>";
                                    }
                                }
                                // if(isset($_POST['update_image'])){
                                //     $users_image = $_FILES['txtimage']['name'];
                                //     $tmp_name = $_FILES['txtimage']['tmp_name'];
                                //     $uname = $_SESSION['login']['users_username'];
                                //     $folder = "website_images/$uname/".$users_image ;
                                //     move_uploaded_file($tmp_name,$folder);
                                //     $image_query = "UPDATE tbl_users SET users_image = '$folder' WHERE users_username = '$uname'";
                                //     $image_result = mysqli_query($connection,$image_query);
                                //     if($image_result){
                                //         echo "<script>alert('Image Uploaded please Relogin to View Your New Profile Image');</script>";
                                //     }   
                                // }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form">
                            <?php
                                $session = $_SESSION['sign_in']['id'];
                                $query = "SELECT * FROM tbl_admin WHERE id = $session";
                                $result = mysqli_fetch_assoc(mysqli_query($connection,$query));
                            ?>
                            <form class="d-flex justify-content-center flex-column " method="POST">
                                <div class="form-floating my-3">
                                    <!-- <span>Name</span> -->
                                    <input type="text" class="form-control " value="<?php echo $result['name'];?>" placeholder="ABC" name="txtname" required>
                                    <label for="name">Full Name</label>
                                </div>
                                <div class="form-floating my-3">
                                    <!-- <span>Name</span> -->
                                    <input type="email" class="form-control " value="<?php echo $result['email']?>"  placeholder="Like : abd@gmail.com" name="txtemail" required>
                                    <label for="name">Email</label>
                                </div>
                                <div class="form-floating my-3">
                                    <!-- <span>Name</span> -->
                                    <input type="text" class="form-control " value="<?php echo $result['password']?>" placeholder="Like : 122abd#$" name="txtpassword" required>
                                    <label for="name">Password</label>
                                </div>
                                <div class="form-floating mx-auto">
                                    <input type="submit" value="Update Profile" class="btn btn-white mb-2 " name="update_profile">
                                </div>
                            </form>
                            <?php
                                if(isset($_POST['update_profile'])){
                                    $name = $_POST['txtname'];
                                    $email = $_POST['txtemail'];
                                    $password = $_POST['txtpassword'];
                                    $query = "UPDATE tbl_admin SET name='$name',email='$email',password='$password' WHERE id = $result[id] ";
                                    $update_query=mysqli_query($connection,$query);
                                    if($update_query){
                                        echo 
                                        "<script>
                                            alert('Profile Updated Successfully');
                                            window.location.href = 'admin_profile.php'
                                        </script>";
                                    }
                                }
                            
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->
    </div>
<?php include("bottom.php"); ?>