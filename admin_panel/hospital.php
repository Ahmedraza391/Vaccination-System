<?php
session_start();
include("connection.php");
$fileName = basename($_SERVER['PHP_SELF']);
$page = "hospital";
?>
<?php include("top.php") ?>
    <title>Hospitals</title>
    <div class="container-fluid position-relative d-flex p-0">
        <?php
        include("sidebar.php");
        ?>
        <!-- Content Start -->
        <div class="content">
            <?php
            include("navbar.php");
            ?>
            <div class="container my-2">
                <div class="row m-0 p-md-5 bg-green">
                    <div class="col-md-12">
                        <h2>List of Hospitals</h2>
                        <a href="add_new_hospital.php" class="btn btn-white my-2 ">Add New Hospital</a>
                        <div class="overflow">
                            <table class="table table-bordered color table-color text-center text-white">
                                <thead>
                                    <tr class="table_row bg-white border border-success">
                                        <th class="green">Hospital Name</th>
                                        <th class="green">Hospital Email</th>
                                        <th class="green">Hospital Phone no</th>
                                        <th class="green">Hospital Status</th>
                                        <th class="green">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $insert_query = "SELECT * FROM tbl_hospital";
                                    $check_result = mysqli_query($connection, $insert_query);
                                    foreach ($check_result as $row) {
                                        echo "<tr>";
                                        echo "<td>$row[name]</td>";
                                        echo "<td>$row[email]</td>";
                                        echo "<td>$row[contact]</td>";
                                        echo "<td>$row[status]</td>";
                                        echo "<td>
                                                    <a href='view_hospital.php?id=$row[id]' class='btn btn-white btn-sm '>View Details</a>
                                                    <a href='edit_hospital.php?id=$row[id]' class='btn btn-success btn-sm'>Edit Details</a>";
                                        if ($row['status'] == "deactivate") {
                                            echo "<a href='hospital_activate.php?id=$row[id]' class='btn btn-success btn-sm mx-1'onclick='return activate()'>Activate</a>";
                                        } else {
                                            echo "<a href='hospital_deactivate.php?id=$row[id]' class='btn btn-danger btn-sm mx-1'onclick='return deactivate()'>Deactivate</a>";
                                        }
                                        "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->
        </div>
        <!-- Content End -->
    </div>
<?php include("bottom.php"); ?>