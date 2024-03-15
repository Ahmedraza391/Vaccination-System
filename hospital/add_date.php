<?php
    session_start();
    include("connection.php");
    $page = "test";
    $id = $_GET['id'];
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
                        <form method="POST">
                            <input type="date" class="form-control" name="date" required>
                            <input type="submit" class="btn btn-white my-2 " value=" Add Date" name="btn_add">
                        </form>
                        <?php
                            $f_query = mysqli_query($connection,"SELECT * FROM tbl_test WHERE id = $id");
                            $assoc = mysqli_fetch_assoc($f_query);
                            if(isset($_POST['btn_add'])){
                                $date = $_POST['date'];
                                $insert_query = mysqli_query($connection,"INSERT INTO tbl_notification(notification,p_id,t_id,h_id)VALUES('$date',$assoc[pid],$assoc[id],$assoc[hid])");
                                $up_query = "UPDATE tbl_test SET date = '$date' WHERE id = $assoc[id]";
                                $res = mysqli_query($connection,$up_query);
                                if($res and $insert_query){
                                    echo "<script>
                                        alert('Date Added Successfully');
                                        window.location.href = 'covid_test.php';
                                    </script>";
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