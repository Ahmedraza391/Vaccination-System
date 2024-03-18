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
                            <input type="date" value="<?php echo $assoc['date'] ?>" class="form-control" id="datePicker"  name="date" required>
                            <input type="submit" class="btn btn-white my-2 " value=" Add Date" name="btn_add">
                        </form>
                        <?php
                            if(isset($_POST['btn_add'])){
                                $date = $_POST['date'];
                                $insert_query = "UPDATE tbl_test SET date='$date' WHERE id = $id";
                                $insert_res = mysqli_query($connection,$insert_query);
                                if($insert_res){
                                    echo "<script>
                                        alert('Date Updated Successfully');
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // for previous date disabled
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth() + 1; // Month is zero-based
            var year = date.getFullYear();

            // Prefix single digit days and months with a '0'
            if (day < 10) {
                day = '0' + day;
            }
            if (month < 10) {
                month = '0' + month;
            }

            var pattern = year + '-' + month + '-' + day;
            var datePicker = document.getElementById("datePicker");
            datePicker.setAttribute('min', pattern);
        });
    </script>
<?php require("bottom.php"); ?>






<!-- continue on web js not working in hospital directory -->