<?php
    session_start();
    unset($_SESSION['hospital']);
    header("location:signin.php");
?>