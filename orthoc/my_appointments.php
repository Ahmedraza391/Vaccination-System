<?php
include("connection.php");
session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>window.location.href='login.php';</script>";
}
?>
<?php require("top.php"); ?>
    <title>Appointments</title>
    <style>
        .header_section {
            background-color: #1fab89 !important;
        }

        .btn-green {
            width: 90px;
        }
        .appointment_section {
            margin-top: 100px !important;
        }
    </style>
    <?php require("sidebar.php"); ?>
    <?php require("navbar.php");  ?>
    <section class="appointment_section layout_margin-top">
        <div class="container p-5 my-3 sec_form_bg min_height">
            <div class="row ">
                <div class="col-md-1"></div>
                <?php
                $session = $_SESSION['login']['id'];
                $query = "SELECT * FROM tbl_patient WHERE id = $session";
                $result = mysqli_query($connection, $query);
                $check = mysqli_fetch_assoc($result);
                ?>
                <div class="col-md-10">
                    <div class="sec_heading">
                        <h2>My Appointments</h2>
                    </div>
                    <div class="overflow">
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
                                $result = mysqli_query($connection, $query);
                                foreach ($result as $row) {
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
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>
    <?php
    require("footer.php");
    ?>
<?php require("bottom.php"); ?>