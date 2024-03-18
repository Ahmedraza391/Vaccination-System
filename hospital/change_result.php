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
                
                $id = $_GET['id'];
                $f_query = mysqli_query($connection,"SELECT * FROM tbl_test WHERE id = $id");
                $assoc = mysqli_fetch_assoc($f_query);
                $positive = "";
                $negative = "";
                $process = "";
                if($assoc['result']=='positive'){
                    $positive = "selected";
                }elseif($assoc['result']=='negative'){
                    $negative = "selected";
                }else{
                    $process = "selected";
                }
            ?>
            <!-- Main Content Start -->
            <div class="container px-md-5 py-3">
                <div class="row m-0 p-3 bg-green">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                    <a href="covid_test.php" class="btn btn-white btn-sm my-2 ">/ Back</a>
                    <h2>Update Covid Test Result : </h2>
                    <form method="POST">
                        <select class="form-select mb-3" name="res" required>
                            <option value="" hidden>Select Status </option>
                            <option value="positive" <?php echo $positive; ?> >Positive</option>
                            <option value="negative" <?php echo $negative; ?> >Negative</option>
                            <option value="process" <?php echo $process; ?> >Process</option>
                        </select>
                        <input type="submit" class="btn btn-white " value="Update Result" name="udpate">
                    </form>
                    <?php
                        if (isset($_POST['udpate'])) {
                            $id = $_GET['id'];
                            $f_query = mysqli_query($connection,"SELECT * FROM tbl_test WHERE id = $id");
                            $assoc = mysqli_fetch_assoc($f_query);
                            $res = $_POST['res'];
                            $check = mysqli_query($connection,"SELECT * FROM tbl_test WHERE id = $id and date != '' ");
                            if(mysqli_num_rows($check) > 0 ){
                                $query = "UPDATE tbl_test SET result = '$res' WHERE id='$id'";
                                $result = mysqli_query($connection, $query);
                                if ($result) {
                                    echo "
                                    <script>
                                        alert('Result Updated Successfully');
                                        window.location.href = 'covid_test.php';
                                    </script>";
                                }
                            }else{
                                echo "
                                <script>
                                    alert('Please Give Date to Patient then change results');
                                </script>";
                            }
                        }
                    ?>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <!-- Main Content End -->
        </div>
    </div>
<?php require("bottom.php"); ?>