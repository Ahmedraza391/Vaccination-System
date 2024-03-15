<?php
session_start();
include("connection.php");
$page = "appointment";
?>
<?php include("top.php"); ?>
    <title>Appointments</title>
    <div class="container-fluid position-relative d-flex p-0">
        <?php
        include("sidebar.php");
        ?>
        <!-- Content Start -->
        <div class="content">
            <?php
            include("navbar.php");
            ?>
            <div class="container p-md-5">
                <div class="row m-0 bg-green ">
                    <div class="col-md-12">
                        <div class=" p-md-5">
                            <h2>List of Appointments</h2>
                            <div class="overflow">
                                <table class="table table-bordered border-white text-white text-center">
                                    <thead>
                                        <tr class="table_row bg-white border border-success">
                                            <th class="green">Patient Name</th>
                                            <th class="green">Hospital Name</th>
                                            <th class="green">Date</th>
                                            <th class="green">Time</th>
                                            <th class="green">Vaccine Name</th>
                                            <th class="green">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $insert_query = "SELECT tbl_appointment.*,tbl_patient.name as 'pname',tbl_hospital.name as 'hname',tbl_vaccine.name as 'vname' FROM tbl_appointment INNER JOIN tbl_patient ON tbl_appointment.pid = tbl_patient.id INNER JOIN tbl_hospital ON tbl_appointment.hid = tbl_hospital.id INNER JOIN tbl_vaccine ON tbl_appointment.vid = tbl_vaccine.id";
                                        $check_result = mysqli_query($connection, $insert_query);
                                        foreach ($check_result as $row) {
                                            echo "<tr>";
                                            echo "<td>$row[pname]</td>";
                                            echo "<td>$row[hname]</td>";
                                            echo "<td>$row[date]</td>";
                                            echo "<td>$row[time]</td>";
                                            echo "<td>$row[vname]</td>";
                                            echo "<td>$row[status]</td>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->
    </div>
<?php include("bottom.php"); ?>