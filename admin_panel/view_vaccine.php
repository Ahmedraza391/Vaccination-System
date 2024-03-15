<?php
session_start();
include("connection.php");
$page = "vaccine";
?>
<?php include("top.php"); ?>
    <title>Vaccines</title>
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
                <div class="row m-0 bg-green">
                    <div class="col-md-12">
                        <div class="p-md-5">
                            <a href="add_new_vaccine.php" class="btn btn-white my-2">Add Vaccine</a>
                            <h2 class="mb-2">List of Vaccines :</h2>
                            <div class="overflow">
                                <table class="table table-bordered text-white border-white text-center">
                                    <thead>
                                        <tr class="table_row bg-white border border-success">
                                            <th class="green">Vaccine Name</th>
                                            <th class="green">Vaccine Status</th>
                                            <th class="green">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $insert_query = "SELECT * FROM tbl_vaccine";
                                        $check_result = mysqli_query($connection, $insert_query);
                                        foreach ($check_result as $row) {
                                            echo "<tr class='table_row'>";
                                            echo "<td>$row[name]</td>";
                                            echo "<td>";
                                            if ($row['status'] == "unavailable") {
                                                echo "<a href='vaccine_activate.php?id=$row[id]' class='btn btn-success btn-sm mx-1'onclick='return available()'>Available</a>";
                                            } else {
                                                echo "<a href='vaccine_deactivate.php?id=$row[id]' class='btn btn-danger btn-sm mx-1'onclick='return unavailb()'>Unavailable</a>";
                                            }
                                            "</td>";
                                            echo "<td><a href='edit_vaccine.php?id=$row[id]' class='btn btn-success btn-sm' >Edit Vaccine</a></td>";
                                            echo "</tr>";
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
    <script>
        function available() {
            return confirm('Are You Sure You Have This Vaccine');
        }

        function unavailb() {
            return confirm('Are You Sure You Have Not This Vaccine');
        }
    </script>
<?php include("bottom.php"); ?>