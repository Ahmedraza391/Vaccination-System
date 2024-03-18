<!-- header section strats -->
<header class="header_section green_section" id="header">
  <div class="container p-0 d-flex align-items-center justify-content-between">
    <div class='list-unstyled d-flex align-items-center justify-content-around '>
      <button class='btn text-white sidebar_btn mx-md-5'><i class='fas fs-4  fa-bars'></i></button>
      <a class="navbar-brand" href="index.php">
        <span>
          Orthoc
        </span>
      </a>
    </div>
    <nav class="navbar custom_nav-container">
      <div class="d-flex align-items-center justify-content-center ">
        <ul class="m-0 p-0 d-flex align-items-center justify-content-left">
          <?php
          if (isset($_SESSION['login'])) {
            echo "<li class='nav-item list-unstyled d-md-block d-none'>
              <a class='btn text-white ' title='Profile' href='profile.php'><i class='fa fa-user-circle fs-4' aria-hidden='true'></i></a>
              <a class='btn text-white ' title='Logout'  href='logout.php'>
                <i class='fas fa-sign-out-alt  fs-4'></i>
              </a>
            </li>";
          } else {
            echo "<li class='nav-item d-flex '>
              <a class='btn btn-green mx-2 ' title='Login'  href='login.php'>Login</a>
              <a class='btn btn-green ' title='Singup'  href='register.php'>Sign up</a>
            </li>
            ";
          }
          ?>
        </ul>
      </div>
    </nav>
  </div>
</header>
<style>
  
</style>
<!-- end header section -->