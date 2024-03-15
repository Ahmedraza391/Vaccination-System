<?php
include("connection.php");
session_start();
?>
<?php require("top.php"); ?>
<title>Login / </title>
    <style>
        .green_section{
            background-color: #1fab89 !important;
        }
    </style>
    <?php
        require("sidebar.php");
        require("navbar.php");
    ?>

    <!-- Login Section -->
    <div class="container login-container">
        <div class="Content">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="leftSide">
                        <h2 class="text-center">Login Patient</h2>
                        <form method="POST" >
                            <input type="email" placeholder="Enter Email" class="form-control" name="p_email" required><br>
                            <input type="password" placeholder="Enter Password" class="form-control" name="p_password" required><br>
                            <input type="submit" value="Login" name="login_btn" class="success">
                        </form>
                        <?php
                            if(isset($_POST['login_btn'])){
                                $email = $_POST['p_email'];
                                $password = $_POST['p_password'];
                                $query = "SELECT * FROM tbl_patient WHERE email = '$email' and password = '$password'";
                                $result = mysqli_num_rows(mysqli_query($connection,$query));
                                if($result){
                                    $check_result = mysqli_fetch_assoc(mysqli_query($connection,$query));
                                    $_SESSION['login']= $check_result;
                                    $_SESSION['login_id']=$check_result['id'];
                                    echo "<script>window.location.href = 'index.php'</script>";
                                }else{
                                    echo "<script>alert('Incorect Username or Password');</script>";
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
    <!-- Login Section -->
<?php require("bottom.php"); ?>