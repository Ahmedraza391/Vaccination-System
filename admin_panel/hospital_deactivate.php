<?php
    include('connection.php');
    $id = $_GET['id'];
    $query = "UPDATE tbl_hospital SET status = 'deactivate' WHERE id = $id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "<script>alert('Deactivate Successfully');window.location.href = 'hospital.php'</script>";
    }
?>