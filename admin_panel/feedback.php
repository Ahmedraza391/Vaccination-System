<?php
session_start();
include("connection.php");
$page = "feedback";
?>
<?php include("top.php"); ?>
<title>Feedbacks</title>
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
                        <h2 class="mb-2">List of Feedbacks :</h2>
                        <div class="overflow">
                            <table class="table text-white table-bordered border-white text-center">
                                <thead>
                                    <tr class="table_row bg-white border border-success">
                                        <th class="green">Patient ID</th>
                                        <th class="green">Patient Name</th>
                                        <th class="green">Massage</th>
                                        <th class="green">Status</th>
                                        <th class="green">View Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $insert_query = "SELECT tbl_feedback.*, tbl_feedback.id as 'fid', tbl_feedback.status as 'f_status', tbl_patient.*, tbl_patient.id as 'pid', tbl_patient.name as 'pname' FROM tbl_feedback INNER JOIN tbl_patient ON tbl_feedback.pid = tbl_patient.id";
                                    $check_result = mysqli_query($connection, $insert_query);
                                    foreach ($check_result as $row) {
                                        echo "<tr class='table_row'>";
                                        echo "<td>" . $row['fid'] . "</td>";
                                        echo "<td>" . $row['pname'] . "</td>";
                                        echo "<td>" . $row['message'] . "</td>";
                                        echo "<td>" . $row['f_status'] . "</td>";
                                        echo "<td>";
                                        if ($row['f_status'] == 'show') {
                                            echo "<a href='hide_feedback.php?id=" . $row['fid'] . "' class='btn btn-danger'>Hide</a>";
                                        } else {
                                            echo "<a href='show_feedback.php?id=" . $row['fid'] . "' class='btn btn-success'>Show</a>";
                                        }
                                        echo "</td>";
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
<?php include("bottom.php"); ?>