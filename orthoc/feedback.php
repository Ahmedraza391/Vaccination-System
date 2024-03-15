<?php 
  session_start();
  include("connection.php");
  if(!isset($_SESSION['login']) OR !isset($_SESSION['login_id']) ){
    header("location:login.php");
  }
?>
<?php require("top.php"); ?>
  <title>Feedback / </title>
  <style>
    .green_section{
    background-color: #1fab89 !important;
    }
  </style>
  <?php require("sidebar.php"); ?>
  <?php 
    require("navbar.php");
  ?>
  <!-- feedback section -->
  <section class="feedback_section layout_padding">
    <div class="container ">
      <div class="heading_container">
        <h2>
          Get In Touch
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container feedback-form">
            <?php
            if (isset($_SESSION['login_id'])) {
              $query = "SELECT * FROM tbl_patient WHERE id = '$_SESSION[login_id]'";
              $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
            }
            ?>
            <form method="POST">
              <div class="form-floating mb-3">
                <input type="hidden" value="<?php echo $result['id'] ?>" name="txtid">
                <input type="text" class="form-control" readonly value="<?php echo $result['name'] ?>" id="name" placeholder="">
                <label for="name">Name</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" readonly value="<?php echo $result['email'] ?>" id="floatingInput" placeholder="">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3 ">
                <input type="number" class="form-control" readonly value="<?php echo $result['contact'] ?>" id="phone" placeholder="">
                <label for="phone">Contact No</label>
              </div>
              <div class="form-floating mb-3 ">
                <textarea class="form-control" placeholder="Leave a comment here" name="txtmassage" id="massage" required></textarea>
                <label for="massage">Massage</label>
              </div>
              <div class="button">
                <input type="submit" value="SEND" name="btn_send">
              </div>
            </form>
            <?php
            if (isset($_POST['btn_send'])) {
              $pid = $_POST['txtid'];
              $massage = $_POST['txtmassage'];
              $query = "INSERT INTO tbl_feedback(pid,message) VALUES ('$pid','$massage')";
              $result = mysqli_query($connection, $query);
              if ($result) {
                echo "<script>alert('Feedback Submit Successfully')</script>";
              }
            }
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container">
            <div class="map">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end feedback section -->
  <?php require("footer.php"); ?>
<?php require("bottom.php"); ?> 