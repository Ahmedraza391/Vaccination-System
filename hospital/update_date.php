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
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <a href="covid_test.php" class="btn btn-white btn-sm my-2">/ Back</a>
                        <h2>Add Date :</h2>
                        <?php 
                            $id = $_GET['id'];
                            $fetch_query = "SELECT * FROM tbl_test WHERE id = $id";
                            $f_q_r = mysqli_query($connection,$fetch_query);
                            $assoc = mysqli_fetch_assoc($f_q_r);
                        ?>
                        <form method="POST">
                            <input type="date" value="<?php echo $assoc['date'] ?>" class="form-control" name="date" required>
                            <input type="submit" class="btn btn-white my-2 " value=" Add Date" name="btn_add">
                        </form>
                        <?php
                            if(isset($_POST['btn_add'])){
                                $date = $_POST['date'];
                                $insert_query = "UPDATE tbl_test SET date='$date' WHERE id = $id";
                                $check_query = "SELECT * FROM tbl_notification";
                                $count = mysqli_num_rows(mysqli_query($connection,$check_query));
                                if($count > 0){
                                    $i_query = "UPDATE tbl_notification SET notification='$date',status = 'unseen' WHERE id = $id";
                                    $update_noti = mysqli_query($connection,$i_query);
                                    $insert_res = mysqli_query($connection,$insert_query);
                                    if($insert_res AND $update_noti){
                                        echo "<script>
                                            alert('Date Updated Successfully');
                                            window.location.href = 'covid_test.php';
                                        </script>";
                                    }
                                }else{
                                    $i_query = "INSERT INTO tbl_notification(notification,p_id,t_id,h_id) VALUES('$date',$assoc[pid],$assoc[id],$assoc[hid])";
                                    $update_noti = mysqli_query($connection,$i_query);
                                    $insert_res = mysqli_query($connection,$insert_query);
                                    if($insert_res AND $update_noti){
                                        echo "<script>
                                            alert('Date Updated Successfully');
                                            window.location.href = 'covid_test.php';
                                        </script>";
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <!-- Main Content End -->
        </div>
    </div>
<?php require("bottom.php"); ?>