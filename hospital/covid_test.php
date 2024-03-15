<?php
    session_start();
    include("connection.php");
    $page = "test";
?>
<?php require("top.php"); ?>
    <title>Covid-tests</title>
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
                    <h2>List of Covid Tests : </h2>
                        <div class="overflow">
                            <table class="table text-white table-bordered border-white text-center">
                                <thead>
                                    <tr class="table_row">
                                        <th>Patient Name</th>
                                        <th>Hospital Name</th>
                                        <th>Date</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $insert_query = "SELECT tbl_test.*,tbl_test.id as 'id',tbl_patient.name as 'pname',tbl_hospital.name as 'hname' FROM tbl_test INNER JOIN tbl_patient ON tbl_test.pid = tbl_patient.id INNER JOIN tbl_hospital ON tbl_test.hid = tbl_hospital.id WHERE tbl_hospital.id = $_SESSION[hospital_id]";
                                    $check_result = mysqli_query($connection, $insert_query);
                                    foreach ($check_result as $row) {
                                        echo "<tr class='table_row'>";
                                        echo "<td>$row[pname]</td>";
                                        echo "<td>$row[hname]</td>";
                                        echo "<td>"
                                        ;if($row['date']=="")
                                        {
                                            echo "<a href='add_date.php?id=$row[id]' class='btn btn-white btn-sm'>Give Date</a>";
                                        }elseif($row['date']!=""){
                                            echo "<a href='update_date.php?id=$row[id]' class='btn btn-white btn-sm mx-2 '>Update Date </a>";
                                            echo $row['date'] ;
                                        }
                                        else{
                                            echo $row['date'] ;
                                        }
                                        "</td>";
                                        echo "<td>
                                            <a href='change_result.php?id=$row[id]' class='btn btn-white btn-sm '>Change</a>
                                            $row[result]
                                        </td>";
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
            <!-- Main Content End -->
        </div>
    </div>
<?php require("bottom.php"); ?>