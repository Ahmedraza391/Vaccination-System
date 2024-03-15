<?php
    session_start();
    unset($_SESSION['sign_in']);
    header("location:signin.php");
?>