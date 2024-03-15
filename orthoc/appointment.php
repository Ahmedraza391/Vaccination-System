<!DOCTYPE html>
<html>
<?php
include("connection.php");
session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>window.location.href='login.php';</script>";
}
?>
<?php require("top.php"); ?>
    <style>
        .green_section {
            background-color: #1fab89 !important;
        }
    </style>
    <?php require("sidebar.php"); ?>
    <?php require("navbar.php");  ?>
    <section class="appointment_section">
        <div class="container p-5 my-3 sec_form_bg">
            <div class="sec_heading">
                <h2>Book Appointment</h2>
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <?php
                    $session = $_SESSION['login']['id'];
                    $query = "SELECT * FROM tbl_patient WHERE id = $session";
                    $result = mysqli_query($connection, $query);
                    $check = mysqli_fetch_assoc($result);
                    ?>
                    <form method="POST">
                        <input type="hidden" class="form-control" name="pid" value="<?php echo $check['id']; ?>">
                        <div class="form-floating mb-3">
                            <input type="text" readonly id="txtname" class="form-control" name="name" value="<?php echo $check['name']; ?>">
                            <label for="txtname">Enter Name</label>
                        </div>
                        <select class="form-select mb-3" name="hid">
                            <option hidden >Select Any Hospital  </option>
                            <?php 
                                $query = "SELECT * FROM tbl_hospital WHERE status = 'activate'";
                                $result = mysqli_query($connection,$query);
                                foreach($result as $row){
                                    echo "<option value='$row[id]' class='form-control '>$row[name]</option>";
                                }
                            ?>
                        </select>
                        <div class="form-floating mb-3">
                            <input type="date" id="txtdate" class="form-control" name="date">
                            <label for="txtdate">Enter Date</label>
                        </div>
                        <select name="time" class="form-select mb-3">
                            <option hidden>Select Any Time</option>
                            <option>10-12</option>
                            <option>12-2</option>
                            <option>2-4</option>
                            <option>4-6</option>
                        </select>
                        <select class="form-select mb-3" name="vid">
                            <option hidden>Select Vaccine</option>
                            <?php 
                                $query = "SELECT * FROM tbl_vaccine WHERE status = 'available'";
                                $result = mysqli_query($connection,$query);
                                foreach($result as $row){
                                    echo "<option value='$row[id]' class='form-control '>$row[name]</option>";
                                }
                            ?>
                        </select>
                        <input type="submit" class="btn btn-outline-success " value="Book Appointment" name="bk_appointment">
                    </form>
                    <?php
                    if(isset($_POST['bk_appointment'])){
                        $pid = $_POST['pid'];
                        $hid = $_POST['hid'];
                        $date = $_POST['date'];
                        $time = $_POST['time'];
                        $vid = $_POST['vid'];
                        // this query is for validate patient for appointment already exists
                        $exsisting_query = "SELECT * FROM tbl_appointment WHERE pid = '$pid' and hid = '$hid' and date = '$date' and time = '$time'";
                        $exsisting_result = mysqli_query($connection,$exsisting_query);
                        $exsisting_numm = mysqli_num_rows($exsisting_result);
                        if($exsisting_numm > 0){
                            echo "
                            <script>
                                alert('Appointment Already Exists')
                                window.location.href = 'appointment.php';    
                            </script>";
                        }
                        else{
                            // this query is for check vaccine
                            $check_vaccine = "SELECT * FROM tbl_appointment WHERE vid = '$vid' and pid = $pid";
                            $exsisting_vaccine = mysqli_query($connection,$check_vaccine);
                            $exsisting_vaccine_numm = mysqli_num_rows($exsisting_vaccine);
                            if(empty($exsisting_vaccine_numm)|| $exsisting_vaccine_numm > 0){
                                // this query is for patient appointment result
                                $check_status = mysqli_query($connection,"SELECT * FROM tbl_appointment ORDER BY id DESC");
                                $check_result = mysqli_fetch_assoc($check_status);
                                if($check_result['status'] != 'pending'){
                                    $insert_query = "INSERT INTO tbl_appointment(pid,hid,date,time,vid)VALUES('$pid','$hid','$date','$time','$vid')";
                                    $insert_result = mysqli_query($connection,$insert_query); 
                                    if($insert_result){
                                        echo "<script>alert('Appointment Booked Successfully');window.location.href = 'appointment.php'</script>";
                                    }
                                }
                                // continue from tbl_appointment mai pendig wala kam
                                else{
                                    echo "
                                    <script>
                                        alert('Please Wait More Your Request Is In Under Process ')
                                        window.location.href = 'appointment.php';    
                                    </script>";    
                                }
                            }else{
                                echo "
                                <script>
                                    alert('Please Select Same Vaccine')
                                    window.location.href = 'appointment.php';    
                                </script>";
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-md-6">
                    <table class="table w-100 border border-1 border-success">
                        <thead>
                            <tr>
                                <th>Hospital Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Vaccine Name</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT tbl_appointment.* ,tbl_patient.name as 'pname',tbl_vaccine.name as 'vname', tbl_hospital.name as 'hname' FROM tbl_appointment INNER JOIN tbl_patient ON tbl_appointment.pid = tbl_patient.id INNER JOIN tbl_hospital ON tbl_appointment.hid = tbl_hospital.id INNER JOIN tbl_vaccine ON tbl_appointment.vid= tbl_vaccine.id  WHERE tbl_patient.id = $session";
                                $result = mysqli_query($connection,$query);
                                foreach($result as $row){
                                    echo
                                    "
                                        <tr>
                                            <td>$row[hname]</td>
                                            <td>$row[date]</td>
                                            <td>$row[time]</td>
                                            <td>$row[vname]</td>
                                            <td>$row[status]</td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </section>
    <?php
    require("footer.php");
    ?>
<?php require("bottom.php"); ?>