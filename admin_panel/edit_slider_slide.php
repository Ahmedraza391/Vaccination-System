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
                            <h3 class="text-white ms-5">Edit Slider Slide</h3>
                        </div>
                        <?php 
                            $id = $_GET['id'];
                            $fetch_query = mysqli_query($connection,"SELECT * FROM tbl_slider WHERE id = $id");
                            $assoc = mysqli_fetch_assoc($fetch_query);
                            $option_1 = "";
                            $option_2 = "";
                            $option_3 = "";
                            $option_4 = "";
                            if($assoc['btn_src']=='../orthoc//appointment.php'){
                                $option_1 = "selected";
                            }
                            else if($assoc['btn_src']=='../orthoc//covid-test.php'){
                                $option_2 = "selected";
                            }
                            else if($assoc['btn_src']=='..//hospital/signup.php'){
                                $option_3 = "selected";
                            }
                            else if($assoc['btn_src']=='..//orthoc/feedback.php'){
                                $option_4 = "selected";
                            }
                        ?>
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="s_heading" value="<?php echo $assoc['heading']; ?>" id="heading" placeholder="abc" required>
                                <label for="heading">Slider Heading</label>
                            </div>
                            <div class="form-floating mb-3">
                            <textarea class="form-control" name="s_massage" value="" id="massage" placeholder="abc" style="min-height: 150px;" required><?php echo $assoc['para']; ?></textarea>
                                <label for="massage">Slider Message</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="s_btn" value="<?php echo $assoc['btn_name']; ?>" id="btn_text" placeholder="abc" required>
                                <label for="btn_text">Slider Button Name</label>
                            </div>
                            <select name="s_btn_src" class="form-select mb-3" required>
                                <option value="" hidden >Select Page</option>
                                <option value="../orthoc//appointment.php" <?php echo $option_1; ?> >Appointment Page</option>
                                <option value="../orthoc//covid-test.php" <?php echo $option_2; ?> >Covid-Test Page</option>
                                <option value="..//hospital/signup.php" <?php echo $option_3; ?> >Hospital Register Page</option>
                                <option value="..//orthoc/feedback.php" <?php echo $option_4; ?> >Feedback Page</option>
                            </select>
                            <input type="submit" value="Update Slide" class="btn btn-white" name="update_slide">
                        </form>
                        <?php
                        if (isset($_POST['update_slide'])) {
                            $heading = $_POST['s_heading'];
                            $para = $_POST['s_massage'];
                            $btn_name = $_POST['s_btn'];
                            $btn_src = $_POST['s_btn_src'];
                            $insert_query = "UPDATE tbl_slider SET heading = '$heading' , para = '$para' , btn_name = '$btn_name' , btn_src = '$btn_src' WHERE id = $id";
                            $success = mysqli_query($connection, $insert_query);
                            if ($success) {
                                echo "<script>alert('Slider Slide Updated Successfully');window.location.href  = 'post_slider.php'</script>";
                            }
                        }
                        // if (isset($_POST['update_slide'])) {
                        //     $heading = $_POST['s_heading'];
                        //     $para = $_POST['s_massage'];
                        //     $btn_name = $_POST['s_btn'];
                        //     $btn_src = $_POST['s_btn_src'];
                            
                        //     // Prepare the statement
                        //     $stmt = $connection->prepare("UPDATE tbl_slider SET heading=?, para=?, btn_name=?, btn_src=? WHERE id=?");
                        
                        //     // Bind parameters
                        //     $stmt->bind_param("ssssi", $heading, $para, $btn_name, $btn_src, $id);
                        
                        //     // Execute the statement
                        //     $success = $stmt->execute();
                        
                        //     if ($success) {
                        //         echo "<script>alert('Slider Slide Updated Successfully');window.location.href  = 'post_slider.php'</script>";
                        //     } else {
                        //         echo "Error updating record: " . $connection->error;
                        //     }
                        
                        //     // Close statement
                        //     $stmt->close();
                        // }                        
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