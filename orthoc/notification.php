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

        .notification_section {
            margin-top: 100px !important;
        }
    </style>
    <?php require("sidebar.php");  ?>
    <?php include("navbar.php");  ?>
    <section class="notification_section">
        <div class="container p-5 my-3 sec_form_bg min_height">
            <div class="row ">
                <div class="col-md-1"></div>
                <?php
                $session = $_SESSION['login']['id'];
                // $query = "SELECT * FROM tbl_patient WHERE id = $session";
                // $result = mysqli_query($connection, $query);
                // $check = mysqli_fetch_assoc($result);
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
                                    <th>Notifications</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT tbl_notification.notification as'noti',tbl_notification.t_result as'result',tbl_hospital.name as 'hname' FROM tbl_notification INNER JOIN tbl_hospital ON tbl_notification.h_id = tbl_hospital.id INNER JOIN tbl_patient ON tbl_notification.p_id = tbl_patient.id WHERE tbl_notification.status != '' AND tbl_notification.p_id = '$session';
                                ";
                                $res = mysqli_query($connection, $query);
                                foreach ($res as $row) {
                                    echo
                                    "
                                        <tr>
                                            <td>Your Hospital Name is : $row[hname]</td>
                                            <td>Your Covid-test Date is : $row[noti]</td>
                                        </tr>
                                    ";
                                    if($row['result'] != "" AND $row['result']=="positive" OR $row['result']=="negative"){
                                        echo
                                        "
                                            <tr>
                                                <td>Your Hospital Name is : $row[hname]</td>
                                                <td>Your Covid-test Result is : $row[result]</td>
                                            </tr>
                                        ";
                                    }else{
                                        echo ""; 
                                    }
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
    include("footer.php");
    ?>
<?php require("bottom.php"); ?>