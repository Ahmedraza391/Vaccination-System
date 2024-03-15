<div class="sidebar" id="sidebar">
  <div class="d-flex align-items-center justify-content-left">
    <button class='btn text-white sidebar_btn'><i class='fas fs-4  fa-bars'></i></button>
    <div class="logo mx-3">
      <a href="index.php" class="navbar-brand"><span>Orthoc</span></a>
    </div>
  </div>
  <ul class="sidebar_ul">
    <hr class="border border-bottom border-white">
    <li class="my-4">
      <a href="my_appointments.php" class="btn_sidebar">My Appointments</a>
    </li>
    <li class="my-4">
      <a href="book_appointment.php" class="btn_sidebar">Book Appointments</a>
    </li>
    <hr class="border border-bottom border-white">
    <li class="my-4">
      <a href="covid-test.php" class="btn_sidebar">Covid-tests</a>
    </li>
    <hr class="border border-bottom border-white">
    <li class="my-4">
      <a href="feedback.php" class="btn_sidebar">Feedback</a>
    </li>
    <li class="my-4">
      <a href="notification.php" class="btn_sidebar">Notifications</a>
    </li>
    <hr class="border border-bottom border-white">
    <li class="my-4">
      <a href="../hospital/signin.php" class="btn_sidebar">Hospital Login</a>
    </li>
    <li class="my-4">
      <a href="../hospital/signup.php" class="btn_sidebar">Hospital Signup</a>
    </li>
    <hr class="border border-bottom border-white">
    <?php
      if (isset($_SESSION['login'])) {
        echo "<li class='my-4'>
          <a class='btn text-white title d-flex align-items-center justify-content-left' data-title='Profile' href='profile.php'><i class='fa fa-user-circle fs-4 mx-2' aria-hidden='true'></i> Profile</a>
        </li>
        <li class='my-4'>
          <a class='btn text-white title d-flex align-items-center justify-content-left' data-title='Logout'  href='logout.php'>
          <i class='fas fa-sign-out-alt fs-4 mx-2'></i>Logout
          </a>
        </li>";
      } else {
        echo "<li class='nav-item d-flex '>
          <a class='btn btn-green mx-2 title' data-title='Login'  href='login.php'>Login</a>
          <a class='btn btn-green ' data-title='Singup'  href='register.php'>Sign up</a>
        </li>
        ";
      }
    ?>
  </ul>
</div>