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
    <title>Covid-Test /</title>
    <style>
        .green_section {
            background-color: #1fab89 !important;
        }
    </style>
    <?php require("sidebar.php"); ?>
    <?php require("navbar.php");  ?>
    <section class="covid-section layout_margin-top" id="main_sec">
        <div class="container p-5 my-3 profile_form">
            <div class="row m-0">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="sec_heading">
                        <h2>Request Your Covid-Test</h2>
                    </div>
                    <?php
                    $session = $_SESSION['login']['id'];
                    // for fetch patients information
                    $query = "SELECT * FROM tbl_patient WHERE id = $session";
                    $result = mysqli_query($connection, $query);
                    $check = mysqli_fetch_assoc($result);
                    // for result process validation
                    $v_query = "SELECT * FROM tbl_test WHERE pid = $session";
                    $v_result = mysqli_query($connection, $v_query);
                    $v_check = mysqli_fetch_assoc($v_result);
                    $input = "";
                    $msg = "";
                    $array = true;
                    // for if table is null or empty
                    $if_table_null = mysqli_query($connection, "SELECT * FROM tbl_test WHERE pid = $session");
                    if (mysqli_num_rows($if_table_null) > 0) {
                        if ($v_check['result'] != "process") {
                            $input = "";
                        } else {
                            $input = "disabled";
                            $msg = "Please Wait More Your Request is in Under Process";
                        }
                    } else {
                        $input = "";
                    }
                    ?>
                    <form method="POST">
                        <input type="hidden" class="form-control" name="pid" value="<?php echo $check['id']; ?>">
                        <div class="form-floating mb-3">
                            <input type="text" readonly id="txtname" class="form-control" name="name" value="<?php echo $check['name']; ?>" <?php echo $input; ?>>
                            <label for="txtname">Enter Name</label>
                        </div>
                        <select class="form-select mb-3" name="hid" <?php echo $input; ?> required>
                            <option value="" hidden>Select Any Hospital </option>
                            <?php
                            $query = "SELECT * FROM tbl_hospital WHERE status = 'activate'";
                            $result = mysqli_query($connection, $query);
                            foreach ($result as $row) {
                                echo "<option value='$row[id]' class='form-control '>$row[name]</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" class="btn btn-outline-success my-2" value="Send Request" name="bk_appointment" <?php echo $input; ?>>
                        <span class="d-block"><?php echo $msg; ?></span>
                    </form>
                    <?php
                    if (isset($_POST['bk_appointment'])) {
                        $pid = $_POST['pid'];
                        $hid = $_POST['hid'];
                        $query = "INSERT INTO tbl_test(pid,hid) VALUES ('$pid','$hid')";
                        $result = mysqli_query($connection, $query);
                        if ($result) {
                            echo "
                                <script>
                                    alert('Request Sent Successfully');
                                    window.location.href = 'covid-test.php';
                                </script>";
                        }
                    }
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row m-0 ">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="sec_heading">
                        <h2>Check Your Test Result</h2>
                    </div>
                    <div class="overflow">
                        <table class="table w-100 border border-1 border-success">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Hospital Name</th>
                                    <th>Date</th>
                                    <th>Result</th>
                                    <?php
                                    $query = "SELECT * FROM tbl_test WHERE pid = $session";
                                    $result = mysqli_query($connection, $query);
                                    $c_result = mysqli_fetch_assoc($result);
                                    if (mysqli_num_rows($result) > 0) {
                                        if ($c_result["result"] == "positive" or $c_result["result"] == "negative") {
                                            echo "<th>Action</th>";
                                        } elseif ($c_result["result"] == "process") {
                                            echo "";
                                        } else {
                                            echo "";
                                        }
                                    }
                                    ?>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT tbl_test.*,tbl_patient.name as 'pname', tbl_hospital.name as 'hname' FROM tbl_test INNER JOIN tbl_patient ON tbl_test.pid = tbl_patient.id INNER JOIN tbl_hospital ON tbl_test.hid = tbl_hospital.id WHERE tbl_patient.id = $session";
                                $result = mysqli_query($connection, $query);
                                // continue on notifications
                                foreach ($result as $row) {
                                    echo "<tr>";
                                        echo "<td>$row[pname]</td>";
                                        echo "<td>$row[hname]</td>";
                                        echo "<td>";
                                        if($row["date"]==""){
                                            echo "Wait for Date";
                                        }else{
                                            echo $row["date"];
                                        }
                                        echo "</td>";
                                        echo "<td>$row[result]</td>";
                                        if ($row['result'] == "positive" or $row['result'] == 'negative') {
                                            echo "<td>
                                                    <button type='button' class='btn btn-white' id='report_btn'>Download Report</button>
                                                </td>";
                                        } else {
                                            echo "";
                                        }
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>
    <section class="report_section" id="report_box">
        <div class="container">
            <div class="main_report_content">
                <div class="content">
                    <?php
                    $id = $_SESSION['login_id'];
                    $query = "SELECT tbl_test.*,tbl_patient.*,tbl_hospital.name as 'hname' FROM tbl_test INNER JOIN tbl_patient ON tbl_test.pid = tbl_patient.id
                    INNER JOIN tbl_hospital ON tbl_test.hid = tbl_hospital.id WHERE pid=$id";
                    $res = mysqli_query($connection, $query);
                    $fetch = mysqli_fetch_assoc($res);
                    ?>
                    <div class="report_header">
                        <h2><?php echo $fetch['name'] ?></h2>
                        <div class="box d-flex ">
                            <h6 class="date">Date : <?php echo $fetch['date'] ?></h6>
                        </div>
                    </div>
                    <hr>
                    <div class="patient_info">
                        <div class="left">
                            <h6 class="my-2">Patient Name</h6>
                            <h6>Patient Gender</h6>
                            <h6>Hospital Name</h6>
                            <h6>City</h6>
                            <h6>Patient Address</h6>
                            <h6>Covid-Result</h6>
                        </div>
                        <div class="right">
                            <h6><?php echo $fetch['name']; ?></h6>
                            <h6><?php echo $fetch['gender']; ?></h6>
                            <h6><?php echo $fetch['hname']; ?></h6>
                            <h6><?php echo $fetch['cid']; ?></h6>
                            <h6><?php echo $fetch['address']; ?></h6>
                            <h6><?php echo $fetch['result']; ?></h6>
                        </div>
                    </div>
                    <div class="watermark">
                        <h1><?php echo $fetch['hname']; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    require("footer.php");
    ?>
<?php require("bottom.php"); ?>