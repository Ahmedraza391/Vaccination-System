<?php
    include("connection.php");
    $id = $_GET['id'];
    $query = "UPDATE tbl_feedback SET status = 'hide' WHERE id = $id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "<script>alert('Feedback Disabled');window.location.href = 'feedback.php' </script>";
    }
?>