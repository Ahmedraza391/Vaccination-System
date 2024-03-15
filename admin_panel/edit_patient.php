<?php
session_start();
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hospital Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo $_SESSION['sign_in']['image'] ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="./assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="./assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php
        include("sidebar.php");
        ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
            include("navbar.php");
            ?>
            <!-- Navbar End -->

            <!-- Hospital Form -->
            <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center">

                    <div class="col-md-10 col-sm-12 col-lg-10">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center position-relative  justify-content-between mb-3">
                                <a href="patients.php" class="btn btn-danger position-absolute mb-1"><i class="fas fa-long-arrow-alt-left"></i></a>
                                <h3 class="text-primary ms-2 "><i class="fa fa-user-edit me-2"></i>Update Patient</h3>
                            </div>
                            <div class="col-md-12 mx-auto my-2 d-flex align-items-center border border-danger p-2 justify-content-start ">
                                <?php
                                $id = $_GET['id'];
                                $image_query = "SELECT * FROM tbl_patient WHERE id = '$id'";
                                $run = mysqli_fetch_assoc(mysqli_query($connection, $image_query));
                                ?>
                                <div class="col-md-5">
                                    <img src="<?php echo $run['image']; ?>" class="me-2 rounded " style="width: 100%; height: 200px; border: 1px solid red; ">
                                </div>
                                <div class="col-md-7 px-2">
                                    <form method="POST" enctype="multipart/form-data" class="my-3">
                                        <input type="file" name="p_image" class="form-control mb-2" required>
                                        <input type="submit" value="Update image" name="btn_image" class="btn btn-danger">
                                    </form>
                                <?php
                                    if (isset($_POST['btn_image'])) {
                                        $pemail = $run['email'];
                                        $img = $_FILES['p_image']['name'];
                                        $tmp_name = $_FILES['p_image']['tmp_name'];
                                        $path = "../orthoc//assets//images//patient-images//$pemail/$img";
                                        move_uploaded_file($tmp_name,$path);
                                        $insert_image_query = "UPDATE tbl_patient SET image = '$path' WHERE id = $_GET[id]";
                                        $insert_image_result = mysqli_query($connection, $insert_image_query);
                                        if ($insert_image_result) {
                                            echo "<script>alert('Image Updated Successfully');window.location.href = 'patients.php'</script>";
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="form">
                                <?php
                                $query = "SELECT * FROM tbl_patient WHERE id = $_GET[id]";
                                $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
                                ?>
                                <form method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="<?php echo $result['name'] ?>" name="p_name" id="pname" placeholder="abc" required>
                                        <label for="pname">Patient Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" value="<?php echo $result['email'] ?>" name="p_email" id="pemail" placeholder="name@example.com" required>
                                        <label for="pemail">Patient Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="<?php echo $result['password'] ?>" name="p_password" id="ppassword" placeholder="abc123#@#$" required>
                                        <label for="ppassword">Patient Password</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" value="<?php echo $result['contact'] ?>" name="p_contact" id="pcontact" placeholder="contact no" required>
                                        <label for="pcontact">Patient Contact No</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" value="<?php echo $result['address'] ?>" name="p_address" id="paddress" placeholder="Password" required>
                                        <label for="paddress">Patient Address</label>
                                    </div>
                                    <select name="p_city" class="form-select mb-3">
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
                                    <div class="mb-2">
                                        <?php 
                                            $check_query = "SELECT * FROM tbl_patient";
                                            $check = mysqli_fetch_assoc(mysqli_query($connection, $check_query));
                                        ?>
                                        <span>Activate :</span>
                                        <input type="radio" value="activate" name="p_status" <?php if ($check['status'] == "activate") {echo "checked";} ?>>
                                        <span>Deactivate :</span>
                                        <input type="radio" value="deactivate" name="p_status" <?php if ($check['status'] == "deactivate") {echo "checked";} ?>>
                                    </div>
                                    <input type="submit" value="Update Patient" class="btn btn-danger" name="p_update_btn">
                                </form>
                                <?php
                                if (isset($_POST['p_update_btn'])) {
                                    $name = $_POST['p_name'];
                                    $email = $_POST['p_email'];
                                    $password = $_POST['p_password'];
                                    $contact = $_POST['p_contact'];
                                    $address = $_POST['p_address'];
                                    $city = $_POST['p_city'];
                                    $status = $_POST['p_status'];
                                    $insert_query = "UPDATE tbl_patient SET name = '$name',email ='$email', password = '$password', contact = '$contact', cid = '$city', address = '$address', status = '$status' WHERE id = $result[id]";
                                    $success = mysqli_query($connection, $insert_query);
                                    if ($success) {
                                        echo "<script>alert('Patient Updated Successfully');window.location.href ='patients.php'</script>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hospital Form -->
        </div>
        <!-- Content End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/lib/chart/chart.min.js"></script>
    <script src="./assets/lib/easing/easing.min.js"></script>
    <script src="./assets/lib/waypoints/waypoints.min.js"></script>
    <script src="./assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="./assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="./assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="./assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="./assets/js/main.js"></script>
</body>

</html>