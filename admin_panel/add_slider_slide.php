<?php
session_start();
include("connection.php");
$page = "post_slider";
?>
<?php include("top.php"); ?>
<title>Add Vaccine</title>
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
            <div class="row h-100 justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                    <div class="bg-green rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3 position-relative ">
                            <a href="post_slider.php" class="btn btn-white position-absolute start-0 mb-1 "><i class="fas fa-long-arrow-alt-left"></i></a>
                            <h3 class="text-white ms-5">Add New Slider Slide</h3>
                        </div>
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="s_heading" id="heading" placeholder="abc" required>
                                <label for="heading">Slider Heading</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="s_massage" id="massage" placeholder="abc" required>
                                <label for="massage">Slider Message</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="s_btn" id="btn_text" placeholder="abc" required>
                                <label for="btn_text">Slider Button Name</label>
                            </div>
                            <select name="s_btn_src" class="form-select mb-3" required>
                                <option value="" hidden >Select Page</option>
                                <option value="../orthoc//appointment.php">Appointment Page</option>
                                <option value="../orthoc//covid-test.php">Covid-Test Page</option>
                                <option value="..//hospital/signup.php">Hospital Register Page</option>
                                <option value="..//orthoc/feedback.php">Feedback Page</option>
                            </select>
                            <input type="submit" value="Add Slide" class="btn btn-white" name="add_slide">
                        </form>
                        <?php
                        // if (isset($_POST['add_slide'])) {
                        //     $heading = $_POST['s_heading'];
                        //     $para = $_POST['s_massage'];
                        //     $btn_name = $_POST['s_btn'];
                        //     $btn_src = $_POST['s_btn_src'];
                        //     $insert_query = "INSERT INTO tbl_slider(heading,para,btn_name,btn_src)VALUES('$heading','$para','$btn_name','$btn_src')";
                        //     $success = mysqli_query($connection, $insert_query);
                        //     if ($success) {
                        //         echo "<script>alert('Slider Slide Inserted Successfully');window.location.href  = 'post_slider.php'</script>";
                        //     }
                        // }
                        ?>
                        <?php
                        if (isset($_POST['add_slide'])) {
                            $heading = $_POST['s_heading'];
                            $para = $_POST['s_massage'];
                            $btn_name = $_POST['s_btn'];
                            $btn_src = $_POST['s_btn_src'];

                            // Prepare the SQL statement using a parameterized query
                            $insert_query = "INSERT INTO tbl_slider(heading, para, btn_name, btn_src) VALUES (?, ?, ?, ?)";

                            // Prepare and bind parameters
                            $stmt = mysqli_prepare($connection, $insert_query);
                            mysqli_stmt_bind_param($stmt, "ssss", $heading, $para, $btn_name, $btn_src);

                            // Execute the statement
                            $success = mysqli_stmt_execute($stmt);

                            if ($success) {
                                echo "<script>alert('Slider Slide Inserted Successfully');window.location.href  = 'post_slider.php'</script>";
                            } else {
                                echo "Error: " . mysqli_error($connection); // Display error if query fails
                            }

                            // Close statement
                            mysqli_stmt_close($stmt);
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