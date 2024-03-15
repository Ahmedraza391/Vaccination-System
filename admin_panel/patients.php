<?php
session_start();
include("connection.php");
$page = "patient";
?>
<?php include("top.php"); ?>
    <title>Patients</title>
    <div class="container-fluid position-relative d-flex p-0">
        <?php
        include("sidebar.php");
        ?>
        <!-- Content Starts -->
        <div class="content">
            <?php
            include("navbar.php");
            ?>
            <div class="row m-0 my-sm-5  my-2">
                <div class="col-md-12">
                    <div class="container p-md-5 bg-green">
                        <h2>List of Patients</h2>
                        <a href="add_new_patient.php" class="btn btn-white my-2 ">Add New Patient</a>
                        <div class="overflow">
                            <table class="table table-bordered border-white text-white  text-center">
                                <thead>
                                    <tr class="table_row bg-white border border-success">
                                        <th class="green">Patient Name</th>
                                        <th class="green">Patient Email</th>
                                        <th class="green">Patient Phone no</th>
                                        <th class="green">Patient Status</th>
                                        <th class="green">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $insert_query = "SELECT * FROM tbl_patient";
                                    $check_result = mysqli_query($connection, $insert_query);
                                    foreach ($check_result as $row) {
                                        echo "<tr class='table_row'>";
                                        echo "<td>$row[name]</td>";
                                        echo "<td>$row[email]</td>";
                                        echo "<td>$row[contact]</td>";
                                        echo "<td>$row[status]</td>";
                                        echo
                                        "<td>
                                    <a href='view_patient.php?id=$row[id]' class='btn btn-white btn-sm '>View Details</a>
                                    <a href='edit_patient.php?id=$row[id]' class='btn btn-success btn-sm'>Edit Details</a>";
                                        if ($row['status'] == "deactivate") {
                                            echo "<a href='patient_activate.php?id=$row[id]' class='btn btn-success btn-sm mx-1' onclick='return activate()'>Activate</a>";
                                        } else {
                                            echo "<a href='patient_deactivate.php?id=$row[id]' class='btn btn-danger btn-sm mx-1' onclick='return deactivate()'>Deactivate</a>";
                                        }
                                        "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    <script>
                                        function activate() {
                                            return confirm('Are You Sure To Activate This Patient');
                                        }

                                        function deactivate() {
                                            return confirm('Are You Sure To Deactivate This Patient');
                                        }
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Content End -->
    </div>
<?php include("bottom.php"); ?>