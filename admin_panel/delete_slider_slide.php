<?php 
    include("connection.php");
    $id = $_GET['id'];
    $query = "DELETE FROM tbl_slider WHERE id = $id";
    $res = mysqli_query($connection,$query);
    if($res){
        echo "<script>alert('Slider Slide Deleted Successfully');window.location.href = 'post_slider.php'</script>";
    }
?>