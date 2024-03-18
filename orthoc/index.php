<?php
include("connection.php");
session_start();
?>
<?php require("top.php"); ?>
  <title>Home</title>
  <?php require("sidebar.php"); ?>
  <div class="main" id="main">
    <div class="hero_area">
      <div class="hero_bg_box">
        <img src="../orthoc//assets//images//web-images//hero-bg.png" alt="">
      </div>

      <?php require("navbar.php"); ?>
      <!-- Swiper -->
      <section class="slider_section">
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
            <?php 
              $fetch_query = mysqli_query($connection,"SELECT * FROM tbl_slider WHERE status = 'show'");
              foreach($fetch_query as $fetch ){
                echo "<div class='swiper-slide'>";
                  echo "<div class='text text-white '>";
                    echo "<h3>$fetch[heading]</h3>";
                    echo "<p>$fetch[para]</p>";
                    echo "<div class='button'>";
                    echo "<a href='$fetch[btn_src]' class='btn btn-green'>$fetch[btn_name]</a>";
                    echo "</div>";
                  echo "</div>";
                echo "</div>";
              }
            ?>
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </section>

      <!-- Swiper JS -->
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

      <!-- Initialize Swiper -->

    </div>
    <!-- Appointment Section -->
    <section class="about_section mt-5 ">
      <div class="container  ">
        <div class="row m-0 mb-5">
          <div class="col-md-6 col-sm-12 d-block d-md-none">
            <div class="img-box">
              <img src="..//orthoc//assets//images//web-images//d2.jpg" alt="">
            </div>
          </div>
          <div class="col-md-6 col-sm-12 my-2 my-md-0 ">
            <div class="detail-box">
              <div class="heading_container">
                <h2 class="fs-3">
                  Take Your <span>Appointment</span>
                </h2>
              </div>
              <p>
                Meet's with your doctors and checkup your body. Each minute we spend worrying about the future and regretting the past is a minute we miss in our appointment with life – a missed opportunity to engage life and to see that each moment gives us the chance to change for the better, to experience peace and joy. So take appointment first and live life happy
              </p>
              <a href="appointment.php">Take Appointment</a>
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="img-box">
              <img src="..//orthoc//assets//images//web-images//d2.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Appointment Section -->


    <!-- about section -->
    <section class="about_section" id="aboutus">
      <div class="container  ">
        <div class="row">
          <div class="col-md-6">
            <div class="img-box">
              <img src="..//orthoc//assets//images//web-images//about-img.jpg" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="detail-box">
              <div class="heading_container">
                <h2>
                  About <span>Us</span>
                </h2>
              </div>
              <p class="m-0 my-lg-2">
                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
                in some form, by injected humour, or randomised words which don't look even slightly believable. If you
                are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
                the middle of text. All
              </p>
              <a href="" class="btn m-0 mt-lg-2">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- end about section -->


    <!-- Hospital section -->
    <section class="hospital_section p-5" id="department">
      <div class="hospital_container">
        <div class="container ">
          <div class="heading_container heading_center">
            <h2>
              Our Hospitals
            </h2>
            <p>
              Asperiores sunt consectetur impedit nulla molestiae delectus repellat laborum dolores doloremque accusantium
            </p>
          </div>
          <div class="row my-2 ">
            <?php
            $hospital_fetch_query = "SELECT * FROM tbl_hospital ORDER BY name ASC LIMIT 3 ";
            $hospital_fetch_result = mysqli_query($connection, $hospital_fetch_query);
            // $hospital_fetch_assoc = mysqli_fetch_assoc($hospital_fetch_result);
            foreach ($hospital_fetch_result as $row) {
              echo "
                  <div class='col-sm-12 my-2 col-md-4'>
                  <div class='image'>
                    <img src='$row[image]' class='rounded' width='100%' height='250px' alt=''>
                  </div>
                    
                  </div>
                  ";
            }
            ?>
          </div>
        </div>
      </div>
    </section>
    <!-- Hospital section -->

    <!-- feedback section -->
    <?php
    if (isset($_SESSION['login_id'])) {
      $query = "SELECT * FROM tbl_patient WHERE id = '$_SESSION[login_id]'";
      $result = mysqli_fetch_assoc(mysqli_query($connection, $query));
    }
    ?>
    <style>
      .section_hide {
        display: none;
      }
    </style>
    <section id="feedback" class="feedback_section layout_padding <?php if (!isset($_SESSION['login'])) {echo "section_hide";} ?>">
      <div class="container">
        <div class="heading_container">
          <h2>
            Get In Touch
          </h2>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form_container feedback-form">
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
    <?php
      $query = "SELECT tbl_feedback.*,tbl_patient.* FROM tbl_feedback INNER JOIN tbl_patient ON tbl_feedback.pid = tbl_patient.id WHERE tbl_feedback.status != 'show'";
      $result = mysqli_query($connection, $query);
      $query_count = mysqli_num_rows($result);
      if($query_count>0){
        $show = "d-none";
      }
    ?>
    <!-- client section -->
    <section class="client_section layout_padding-bottom <?php echo $show; ?>">
      <div class="container">
        <div class="heading_container heading_center ">
          <h2>
            Testimonial
          </h2>
        </div>
        <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php
            $query = "SELECT tbl_feedback.*,tbl_patient.* FROM tbl_feedback INNER JOIN tbl_patient ON tbl_feedback.pid = tbl_patient.id WHERE tbl_feedback.status = 'show'";
            $result = mysqli_query($connection, $query);
            $firstfeedback = true;
            foreach ($result as $row) {
              $val = $firstfeedback ? 'active' : '';
              echo "
                  <div class='carousel-item $val'>
                    <div class='row'>
                      <div class='col-md-11 col-lg-10 mx-auto'>
                        <div class='box'>
                          <div class='img-box'>
                            <img src='$row[image]' class='border border-success' alt='Image Not Found' />
                          </div>
                          <div class='detail-box'>
                            <div class='name'>
                              <h6>$row[name]</h6>
                            </div>
                            <p>$row[message]</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  ";
              $firstfeedback = false;
            }
            ?>
        </div>
      </div>
    </section>

    <!-- end client section -->
    <?php
    include("footer.php");
    ?>
    <!-- Swiper js  -->
    <script type="text/javascript" src="../admin_panel//assets//swiper js//swiper-bundle.min.js"></script>
    <script>
      // for swiper slider 
      var swiper = new Swiper(".mySwiper", {
          pagination: {
            el: ".swiper-pagination",
            dynamicBullets: true,
            clickable: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          autoplay: {
            delay: 2500,
            disableOnInteraction: false
          },
      });
    </script>
  </div>
<?php include("bottom.php"); ?>