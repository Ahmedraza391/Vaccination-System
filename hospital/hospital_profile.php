<?php
    include('connection.php');
    session_start();
?>
<?php require("top.php"); ?>
    <title>Hospital Profile</title>
    <div class="container-fluid position-relative d-flex p-0">
            <?php
                include('sidebar.php');
            ?>
        <div class="content">
            <?php
                include('navbar.php');
            ?>
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center bg-green rounded py-1">Hospital Profile</h1>
                    </div>
                </div>
                <div class="row m-0 bg-green rounded py-3">
                    <div class="col-md-4">
                        <div class="image_div">
                            <div class="image ms-md-2 ">
                                <img src="<?php echo $result['image'] ?>" alt="Image Not Found" class="mx-auto image-radius" >
                            </div>
                            <form class="d-flex flex-column" method="POST" enctype="multipart/form-data" >
                                <input type="file" name="image" class="form-control w-75 bg-secondary mx-auto my-2 " required>
                                <input type="submit" name="upload_image" class="btn btn-sm w-75 mx-auto  btn-white" value="Update Image" >
                            </form>
                            <?php
                                $h_Query = "SELECT * FROM tbl_hospital WHERE id = $session";
                                $result= mysqli_query($connection,$h_Query);
                                $check = mysqli_fetch_assoc($result);
                                if(isset($_POST['upload_image'])){
                                    $image_name = $_FILES['image']['name'];
                                    $tmp_name = $_FILES['image']['tmp_name'];
                                    $path = "..//admin_panel//assets//img//hospital//$check[name]//$image_name";
                                    move_uploaded_file($tmp_name,$path);
                                    $query = "UPDATE tbl_hospital SET image = '$path' WHERE id = $check[id]";
                                    $image_update = mysqli_query($connection,$query);
                                    if($image_update){
                                        echo "
                                        <script>
                                            alert('Image Updated');
                                            window.location.href = 'index.php';
                                        </script>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form">
                            <?php
                                $session = $_SESSION['hospital']['id'];
                                $query = "SELECT * FROM tbl_hospital WHERE id = $session";
                                $result = mysqli_fetch_assoc(mysqli_query($connection,$query));
                            ?>
                            <form class="d-flex justify-content-center flex-column " method="POST">
                                <div class="form-floating my-3">
                                    <!-- <span>Name</span> -->
                                    <input type="text" class="form-control " value="<?php echo $result['name'];?>" placeholder="ABC" name="txtname" required>
                                    <label for="name">Hosiptal Name</label>
                                </div>
                                <div class="form-floating my-3">
                                    <!-- <span>Name</span> -->
                                    <input type="email" class="form-control " value="<?php echo $result['email']?>"  placeholder="Like : abd@gmail.com" name="txtemail" required>
                                    <label for="name">Hosiptal Email</label>
                                </div>
                                <div class="form-floating my-3">
                                    <!-- <span>Name</span> -->
                                    <input type="text" class="form-control " value="<?php echo $result['password']?>" placeholder="Like : 122abd#$" name="txtpassword" required>
                                    <label for="name">Hospital Password</label>
                                </div>
                                <div class="form-floating mx-auto">
                                    <input type="submit" value="Update Profile" class="btn btn-white" name="update_profile">
                                </div>
                            </form>
                            <?php
                                if(isset($_POST['update_profile'])){
                                    $name = $_POST['txtname'];
                                    $email = $_POST['txtemail'];
                                    $password = $_POST['txtpassword'];
                                    $query = "UPDATE tbl_hospital SET name='$name',email='$email',password='$password' WHERE id = $result[id] ";
                                    $update_query=mysqli_query($connection,$query);
                                    if($update_query){
                                        echo 
                                        "<script>
                                            alert('Profile Updated Successfully');
                                            window.location.href = 'hospital_profile.php'
                                        </script>";
                                    }
                                }
                            
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require("bottom.php"); ?>