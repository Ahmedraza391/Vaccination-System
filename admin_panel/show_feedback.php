<?php
    include("connection.php");
    $id = $_GET['id'];
    $query = "UPDATE tbl_feedback SET status = 'show' WHERE id = $id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "<script>alert('Feedback Enabled');
        window.location.href = 'feedback.php' </script>";
    }
?>