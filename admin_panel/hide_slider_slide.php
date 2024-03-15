<?php 
    include("connection.php");
    $id = $_GET['id'];
    $query = "UPDATE tbl_slider SET status = 'hide' WHERE id = $id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "<script>alert('Slider Slide Disabled Successfully');window.location.href = 'post_slider.php'</script>";
    }
?>