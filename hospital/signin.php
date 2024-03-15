<?php
    session_start();
    include('connection.php');
?>
<?php 
    require("top.php");
?>
    <title>Hospital Login / </title>
    <div class="container-fluid d-flex p-0">    
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-8">
                    <div class="bg-green rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="../orthoc/index.php" class="text-white text-decoration-underline fs-3 ">/  Back</a>
                            <a href="index.php" class="text-white text-decoration-none ">
                                <h3><i class="fa fa-user-edit me-2"></i>Hospital Login </h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input type="email" name="txtemail" class="form-control" id="email" placeholder="name@example.com" required>
                                <label for="email">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="txtpassword" class="form-control" id="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                            <input type="submit" class="btn btn-white py-3 w-100 mb-4" value="Sign In" name="signin" >
                        </form>
                        <?php
                            if(isset($_POST['signin'])){
                                $email = $_POST['txtemail'];
                                $password = $_POST['txtpassword'];
                                $query = "SELECT * FROM tbl_hospital WHERE email = '$email' and password= '$password'";
                                $result = mysqli_num_rows(mysqli_query($connection,$query));
                                if($result>0){
                                    $check_result = mysqli_fetch_assoc(mysqli_query($connection,$query));
                                    if($check_result['status']=='activate')
                                    {
                                        $_SESSION['hospital'] = $check_result;
                                        $_SESSION['hospital_id'] = $check_result['id'];
                                        echo "<script>window.location.href = 'index.php'</script>";
                                    }
                                    else
                                    {
                                        echo "<script>alert('Wait for Approval')</script>";
                                    }
                                    
                                }
                                else{
                                    echo "<script>alert('Incorrect Email and Password')</script>";
                                }
                            }
                        ?>
                        <p class="text-center mb-0">Don't have an Account? <a href="signup.php" class="text-white">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>
<?php include("bottom.php"); ?>