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
        <ul class="navbar-nav navbar_ul ms-auto mx-md-3">
          <?php
            if (isset($_SESSION['login'])) {
              $c_id = $_SESSION['login_id'];
              // first query is for notification
              $f_query = "SELECT tbl_notification.notification as'noti',tbl_notification.*,tbl_test.pid ,tbl_hospital.name as 'hname'
              FROM tbl_notification
              INNER JOIN tbl_test ON tbl_notification.t_id = tbl_test.id
              INNER JOIN tbl_hospital ON tbl_notification.h_id = tbl_hospital.id
              INNER JOIN tbl_patient ON tbl_test.pid = tbl_patient.id   
              WHERE tbl_notification.p_id = '$c_id' LIMIT 1";
              $res = mysqli_query($connection, $f_query);
              // and second one is for number badge
              $msg = "";
              $s_query = mysqli_query($connection,"SELECT * FROM tbl_notification WHERE status = 'unseen' AND p_id = $c_id");
              $count  = mysqli_num_rows($s_query);
              $check_result = mysqli_query($connection,"SELECT * FROM tbl_notification WHERE p_id = $c_id AND status = 'unseen' AND t_result = 'positive' OR t_result = 'negative'");
              $row  = mysqli_num_rows($check_result);
              if($count > 0){
                if($row > 0){
                  $row = $count;
                  $msg = $row; 
                }else{
                  $msg = $count; 
                }
              }else{
                $msg = "0";
              }
              echo "
              <li class='nav-item'>
                <div class='btn-group dropdown'>
                  <a href='notification.php' class='btn btn-white bg-white '>
                    <i class='fas fa-bell text-dark'></i>  
                  </a>
                  <button class='btn dropdown-toggle bg-success' id='notification_dropdown' type='button' data-bs-toggle='dropdown' value='$c_id' aria-expanded='false'>
                    <span class='badge rounded-pill badge-notification bg-white text-dark ' id='noti_badge'>$msg</span>
                  </button>
                  <ul class='dropdown-menu navbar_dropdown_menu p-2' aria-labelledby='dropdown_men'> ";
                    foreach($res as $row){
                      echo "
                      <li class='notification_menu fw-bold' id='notification_menu'>";
                      if($row['t_result'] != "" AND $row['t_result']=="positive" OR $row['t_result']=="negative")
                      {
                        echo "$row[hname] : Your test result is $row[t_result]";
                      }else{
                        echo "$row[hname] : Your test result have arrived on $row[noti]";
                      }
                      "</li>";
                    }
                  echo "</ul>
                </div>
              </li>";
            } else {
              echo "";
            }
          ?>
        </ul>
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