<?php
include("connection.php");
session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>window.location.href='login.php';</script>";
}
?>
<?php require("top.php"); ?>
    <title>Book Appointment /</title>
    <style>
        .green_section {
            background-color: #1fab89 !important;
        }
    </style>
    <?php require("sidebar.php"); ?>
    <?php include("navbar.php");  ?>
    <section class="appointment_section layout_margin-top">
        <div class="container p-5 my-3 sec_form_bg min_height">
            <div class="sec_heading">
                <h2>Book Appointment</h2>
            </div>
            <div class="row mt-4">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <?php
                    // for checking patient needs vaccine or not
                    $session = $_SESSION['login']['id'];
                    $massage = "";
                    // for user dosent exists in test table
                    $user_not_exists = mysqli_query($connection,"SELECT * FROM tbl_test WHERE pid = $session");
                    $user_count = mysqli_num_rows($user_not_exists); 
                    // for check the user take covid test first or not
                    $check_result = mysqli_query($connection, "SELECT * FROM tbl_test WHERE pid = $session AND result != 'positive' ");
                    $check_count = mysqli_num_rows($check_result);
                    // for check appointment booked or cancelled in his first time
                    $validate_appointment = mysqli_query($connection,"SELECT * FROM tbl_appointment WHERE pid = $session AND status = 'booked'");
                    $validate_count = mysqli_num_rows($validate_appointment);
                    // for check if appointment status is pending 
                    $if_status_pending_appointment = mysqli_query($connection,"SELECT * FROM tbl_appointment WHERE pid = $session AND status = 'pending'");
                    $status_count = mysqli_num_rows($if_status_pending_appointment);
                    if($user_count > 0){
                        if($check_count > 0){
                            $massage = "disabled";
                        }else{
                            $massage = "";
                            if($validate_count > 0){
                                $massage = "disabled";
                            }else{
                                $massage = "";
                                if($status_count > 0){
                                    $massage = "disabled";
                                }else{
                                    $massage = "";
                                }
                            }
                        }
                    }
                    // for fetching data 
                    $fetch_query = mysqli_query($connection,"SELECT * FROM tbl_patient WHERE id = $session");
                    $check = mysqli_fetch_assoc($fetch_query);
                    $dis =  "disabled";
                    ?>
                    <form method="POST">
                        <input type="hidden" class="form-control" <?php echo $massage; ?>  name="pid" value="<?php echo $check['id']; ?>">
                        <div class="form-floating mb-3">
                            <input type="text" readonly id="txtname" <?php echo $massage;?>  class="form-control" name="name" value="<?php echo $check['name']; ?>">
                            <label for="txtname">Enter Name</label>
                        </div>
                        <select class="form-select mb-3" name="hid" <?php echo $massage; ?> required>
                            <option value="" hidden >Select Any Hospital  </option>
                            <?php 
                                $query = "SELECT * FROM tbl_hospital WHERE status = 'activate'";
                                $result = mysqli_query($connection,$query);
                                foreach($result as $row){
                                    echo "<option value='$row[id]' class='form-control '>$row[name]</option>";
                                }
                            ?>
                        </select>
                        <div class="form-floating mb-3">
                            <input type="date" id="datePicker" class="form-control" name="date" <?php echo $massage; ?> >
                            <label for="datePicker">Enter Date</label>
                        </div>
                        <select name="time" class="form-select mb-3" <?php echo $massage; ?> required>
                            <option value="" hidden>Select Any Time</option>
                            <option>10-12</option>
                            <option>12-2</option>
                            <option>2-4</option>
                            <option>4-6</option>
                        </select>
                        <select class="form-select mb-3" name="vid" <?php echo $massage; ?> required>
                            <option value="" hidden>Select Vaccine</option>
                            <?php 
                                $query = "SELECT * FROM tbl_vaccine WHERE status = 'available'";
                                $result = mysqli_query($connection,$query);
                                foreach($result as $row){
                                    echo "<option value='$row[id]' class='form-control '>$row[name]</option>";
                                }
                            ?>
                        </select>
                        <input type="submit" class="btn btn-outline-success " value="Book Appointment" name="bk_appointment" <?php echo $massage; ?> >
                    </form>
                    <?php
                    if(isset($_POST['bk_appointment'])){
                        $pid = $_POST['pid'];
                        $hid = $_POST['hid'];
                        $date = $_POST['date'];
                        $time = $_POST['time'];
                        $vid = $_POST['vid'];
                        // if appointment already exists
                        $exists_appointment = mysqli_query($connection,"SELECT * FROM tbl_appointment WHERE pid = $pid AND hid = $hid AND date='$date' AND time='$time' AND vid=$vid AND status = 'pending' OR status = 'booked'");
                        $exists_count = mysqli_num_rows($exists_appointment);
                        if($exists_count > 0){
                            $massage = "Appointment Already Exists";
                        }else{
                            $insert_query = mysqli_query($connection,"INSERT INTO tbl_appointment(pid,hid,date,time,vid)VALUES($pid,$hid,'$date','$time',$vid)");
                            if($insert_query){
                                echo "<script>alert('Appointment Booked Successfully')</script>";
                            }
                        }
                        // continue on appointment page
                    }
                    ?>
                    <div class="massage">    
                       <span class="text-danger d-block fw-bold"><?php if(isset($_POST['bk_appointment'])){echo $massage;}else{echo "";} ?></span>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>
    <?php
    include("footer.php");
    ?>
<?php require("bottom.php"); ?>