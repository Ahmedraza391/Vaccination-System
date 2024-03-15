<?php
    session_start();
    include("connection.php");
    $page = "appointment";
?>
<?php require("top.php"); ?>
    <title>Appointments</title>
    <div class="container-fluid position-relative d-flex p-0">
        <?php
        include("sidebar.php");
        ?>
        <div class="content">
            <?php
            include("navbar.php");
            ?>
            <!-- Main Content Start -->
            <div class="container px-md-5 py-3">
                <div class="row m-0 p-3 bg-green">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h2>List of Appointments</h2>
                        <div class="overflow">
                            <table class="table table-bordered border-white text-white text-center">
                                <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Vaccine Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $insert_query = "SELECT tbl_appointment.*,tbl_patient.name as 'pname',tbl_hospital.name as 'hname',tbl_vaccine.name as 'vname' FROM tbl_appointment INNER JOIN tbl_patient ON tbl_appointment.pid = tbl_patient.id INNER JOIN tbl_hospital ON tbl_appointment.hid = tbl_hospital.id INNER JOIN tbl_vaccine ON tbl_appointment.vid = tbl_vaccine.id WHERE hid = $_SESSION[hospital_id]";
                                        $check_result = mysqli_query($connection, $insert_query);
                                        foreach ($check_result as $row) {
                                            echo "<tr>";
                                            echo "<td>$row[pname]</td>";
                                            echo "<td>$row[date]</td>";
                                            echo "<td>$row[time]</td>";
                                            echo "<td>$row[vname]</td>";
                                            echo "<td>$row[status]</td>";
                                            echo "<td>";
                                                if($row['status']=='cancelled'){
                                                    echo"<a href='book_appointment.php?id=$row[id]'>
                                                        <button class='btn btn-success'>Book</button>
                                                    </a>";
                                                }elseif($row['status']=='booked'){
                                                    echo"<a href='cancel_appointment.php?id=$row[id]'>
                                                        <button class='btn btn-danger'>Cancel</button>
                                                    </a>";
                                                }else{
                                                    echo"<a href='cancel_appointment.php?id=$row[id]'>
                                                        <button class='btn btn-danger'>Cancel</button>
                                                    </a>";
                                                    echo"<a href='book_appointment.php?id=$row[id]'>
                                                        <button class='btn btn-success'>Book</button>
                                                    </a>";
                                                }
                                            echo "</td>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <!-- Main Content End -->
        </div>
    </div>
<?php require("bottom.php") ?>